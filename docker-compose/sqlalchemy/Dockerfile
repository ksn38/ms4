FROM python:3.8

ARG user
ARG uid

RUN pip install beautifulsoup4==4.9.3 requests==2.24.0 SQLAlchemy==1.4.29 psycopg2==2.8.6 lxml==4.6.1

# Create system user to run Composer and Artisan Commands
RUN useradd -G root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user && chown -R $user:$user /home/$user

WORKDIR /usr/src/app

USER $user

CMD [ "python", "./parser_langs.py" ]
