import requests
from pprint import pprint
from sqlalchemy import create_engine, select, desc
from sqlalchemy import Column, Integer, String, Float, Date
from sqlalchemy.ext.declarative import declarative_base
from datetime import date
from bs4 import BeautifulSoup as bs
import requests
import json
from sqlalchemy.orm import sessionmaker
from collections import OrderedDict


engine = create_engine('postgresql://ksn38:1@db:5432/djdb')
Base = declarative_base()


class tickers(Base):
    __tablename__ = 'tickers'
    id = Column(Integer, primary_key=True, unique=True, autoincrement=True)
    date_added = Column(Date)
    gspc = Column(Float)
    vix = Column(Float)
    tnx = Column(Float)
    wti = Column(Float)
    gold = Column(Float)
    ixic = Column(Float)
    rut = Column(Float)
    bvsp = Column(Float)
    gdaxi = Column(Float)
    sz = Column(Float)
    wheat = Column(Float)
    ss = Column(Float)
    bsesn = Column(Float)
    cop = Column(Float)
    cop_gold = Column(Float)
    wheat_gold = Column(Float)
    wti_gold = Column(Float)
    

    def __init__(self, date_added, gspc, vix, tnx, gdaxi, ixic, rut, bsesn, ss, sz, bvsp, cop, wheat,gold, wti, wheat_gold, wti_gold, cop_gold):
        self.date_added = date_added
        self.gspc = gspc
        self.vix = vix
        self.tnx = tnx
        self.wti = wti
        self.gold = gold
        self.ixic = ixic
        self.rut = rut
        self.bvsp = bvsp
        self.gdaxi = gdaxi
        self.sz = sz
        self.wheat = wheat
        self.ss = ss
        self.bsesn = bsesn
        self.cop = cop
        self.cop_gold = cop_gold
        self.wheat_gold = wheat_gold
        self.wti_gold = wti_gold

def ticks(*args):
    headers = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36'}
    t_dict = OrderedDict()

    for i in (args):
        if i not in {'wti', 'gold', 'sz', 'wheat', 'ss', 'cop'}:
            url = 'https://finance.yahoo.com/quote/^' + i + '/history'
        else:
            commodities = {'wti': 'CL=F', 'gold': 'GC=F', 'wheat': 'KE=F', 'sz': '399001.SZ', 'ss': '000001.SS', 'cop': 'HG=F'}
            url = 'https://finance.yahoo.com/quote/' + commodities[i] + '/history'
            
        response = requests.get(url, headers=headers).text
        parsed_html = bs(response, 'lxml')
        t = parsed_html.find('fin-streamer', {'class': 'Fw(b) Fz(36px) Mb(-4px) D(ib)'}).text.replace(',', '')
        #print(t)
        t_dict[i] = float(t)
            
    return t_dict
    
with engine.connect() as conn:
    stmt = select(Column('date_added')).select_from(tickers).order_by(desc('id')).limit(1)
    last_date = conn.execute(stmt).fetchone()
    #pprint(last_date[0])
    if last_date[0] != date.today():
        if date.today().weekday() not in {0, 6}:
            t = ticks('gspc')
            stmt = select(Column('gspc')).select_from(tickers).order_by(desc('id')).limit(1)
            result = conn.execute(stmt).fetchone()
            #print(result[0], t['gspc'])
            if result[0] != t['gspc']:
                t.update(ticks('tnx', 'ixic', 'rut', 'gdaxi', 'ss', 'sz', 'bvsp', 'bsesn', 'wheat', 'wti', 'cop', 'gold', 'vix'))
                t['wheat_gold'] = t['wheat']/t['gold']
                t['wti_gold'] = t['wti']/t['gold']
                t['cop_gold'] = (t['cop']*1000)/t['gold']
                t['date_added'] = date.today()

                Session = sessionmaker(bind=engine)
                session = Session()

                session.add_all([tickers(**t)])

                session.commit()
                session.close()