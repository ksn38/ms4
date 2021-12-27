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


engine = create_engine('postgresql://ksn38:1@127.0.0.1:5432/djdb')
Base = declarative_base()


class mybl_lang(Base):
    __tablename__ = 'mybl_lang'
    id = Column(Integer, primary_key=True, unique=True, autoincrement=True)
    name = Column(String)
    val = Column(Integer)
    val_noexp = Column(Integer)
    res_vac = Column(Float)
    date_added = Column(Date)

    def __init__(self, name, val, val_noexp, res_vac, date_added):
        self.name = name
        self.val = val
        self.val_noexp = val_noexp
        self.res_vac = res_vac
        self.date_added = date_added


def apivac(expir):
    vac = {}

    for i in ['Python', 'C%23', 'c%2B%2B', 'Java', 'Javascript', 'php', 'Ruby', 'Golang', '1c', 'Data scientist', 'Scala', 'iOS', 'Frontend', 'DevOps', 'ABAP', 'Android']:
        url = 'https://api.hh.ru/vacancies?&' + expir + 'search_field=name&text=' + i
        response = requests.get(url)
        val = json.loads(response.content.decode("utf-8"))
        vac[i] = val['found']
        #print(i, val['found'])

    return vac


def parservac():
    res = {}

    for i in ['Python', 'C%23', 'c%2B%2B', 'Java', 'Javascript', 'php', 'Ruby', 'Golang', '1c', 'Data scientist', 'Scala', 'iOS', 'Frontend', 'DevOps', 'ABAP', 'Android']:
        url = 'https://hh.ru/search/resume?clusters=true&exp_period=all_time&logic=normal&no_magic=false&order_by=relevance&pos=position&text=' + i
        headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36'}
        response = requests.get(url, headers=headers).text
        parsed_html = bs(response, 'lxml')
        bloko = parsed_html.find('h1', {'class': 'bloko-header-1'}).text.split(' ')[-1].split('\xa0')
        if len(bloko) == 3:
            bloko = ''.join(map(str, bloko[:2]))
        else:
            bloko = ''.join(map(str, bloko[:1]))
        res[i] = int(bloko)
        #print(i, bloko)

    return res


with engine.connect() as conn:
    stmt = select(Column('date_added')).select_from(mybl_lang).order_by(desc('id')).limit(1)
    result = conn.execute(stmt).fetchone()
    #pprint(result[0])

    if result[0] != date.today():
        noexp = 'experience=noExperience&'
        vacs = apivac('')
        vacs_noexp = apivac(noexp)
        res = parservac()

        for k, k2 in zip(vacs.keys(), res.keys()):
            res[k2] = round(res[k2] / vacs[k], 1)
            vacs_noexp[k] = round(vacs_noexp[k] * 100 / vacs[k])

        Session = sessionmaker(bind=engine)
        session = Session()

        for k, v, vne, vrv in zip(vacs.keys(), vacs.values(), vacs_noexp.values(), res.values()):
            if k == 'c%2B%2B':
                k = 'cpp'
            new_values = {'name': k, 'val': v, 'val_noexp': vne, 'res_vac': vrv}
            #print(new_values)
            session.add_all([mybl_lang(k, v, vne, vrv, date.today())])

        session.commit()
        session.close()

