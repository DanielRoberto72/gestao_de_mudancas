from tkinter import CENTER
import selenium, os, time, pandas as pd, csv, warnings, shutil, sys, lxml, re, itertools, openpyxl, glob, mysql.connector, smtplib
import pandas as pd, os, paramiko, telegram, emoji, mysql.connector, shutil, pymysql, sys
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from bs4 import BeautifulSoup as BS
from selenium.webdriver import ActionChains
from selenium.webdriver.support import expected_conditions
from selenium.webdriver.support import expected_conditions as EC
from datetime import datetime, timedelta
from bs4 import BeautifulSoup
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
from email.mime.base import MIMEBase
from email import encoders
import win32com.client
import os
import glob
from sqlalchemy import create_engine
warnings.filterwarnings("ignore")
log = ''

#-----------------------------------------------------------------------------------------------
#SETANDO DATAS

tempo = datetime.now() - timedelta()
tempo_15dias = datetime.now() - timedelta(30)
timestamp = tempo.strftime('%d-%m-%Y')
timestamp_envio = tempo.strftime('%d-%m')
timestamp_15dias = tempo_15dias.strftime('%Y-%m-%d')

month_name = tempo.strftime('%B')
month_name = month_name[:3].upper()
#-----------------------------------------------------------------------------------------------


#CRIANDO MÉTODOS DE ACESSOS AO BANCO
def engine_create():

    engine = create_engine("mysql+pymysql://{user}:{pw}@{host}/{db}"
                           .format(user="",
                                   pw='',
                                   host="",
                                   db=""
                                   ))
    return engine

def open_connection_noc():
    password=r""
    conn = mysql.connector.connect(
    host="",
    user="",
    password= password,
    database="",
    auth_plugin='mysql_native_password')
    return conn

def close_connection(x):
    x.close()



#ABRINDO CONEXÕES COM BANCO DE DADOS
connNoc = open_connection_noc()
engine = engine_create()

#QUERY BANCO NOC
query = ''''''

#===============================================================================================================
#ABRINDO CONEXÕES COM BANCO DE DADOS
try:
    connNoc
    engine

except:
    print('Falha na conexão ao Banco de Dados1!!!')
    sys.exit()

#Buscando MODENS A BLOQUEAR no BANCO DO NOC e testando conexão com o Banco
try:
    dfNoc = pd.read_sql(query, con=connNoc).astype(str)
    dfNoc = dfNoc.replace("NaT", "A definir")
    dfNoc = dfNoc.replace("\r\n", " ")
except:
    print('Falha na conexão ao Banco de Dados2!!!')

#---------------ENVIO DO EMAIL PARA OS DESTINATÁRIOS FIXOS---------------------------#
tempo = datetime.now() - timedelta()
timestamp_envio = tempo.strftime('%d/%m/%Y')

if(dfNoc.empty is False):
    try:
        email = ''
        password = '..'
        send_to_email = []
        subject = ': '+timestamp_envio

        html = """\
        <html>
        <head>
        <style> 
        table, th, td {{font-size:12pt; border:4px solid white; border-collapse:collapse; text-center:;}}
        th, td {{padding: 5px; font-family:Calibri,sans-serif  }} th{{background-color:#4472C4;color:white;}} td{{background-color:#D9E1F2;color:black; text-align: center}}
        </style></head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <body>
        <p>Prezados, boa noite!</p>
        <p>Segue relação de GMUD's solicitadas até o momento:</p><br>
            {0}

        <br>
        <strong>Atenciosamente,</strong><br>
        <strong>Gestão de Mudança</strong>
        </body>
        </html>
        """.format(dfNoc.to_html(index=False, border=4, justify=CENTER, col_space=180, classes='mystyle' ))




        msg = MIMEMultipart()
        msg['From'] = email
        msg['To'] = ", ".join(send_to_email)
        msg['Subject'] = subject

        msg.attach(MIMEText(html, 'html'))


        server = smtplib.SMTP('SMTP.office365.com',587)
        server.starttls()
        server.login(email, password)
        text = msg.as_string()
        server.sendmail(email, send_to_email, text)
        server.quit()

        print('Email enviado COM SUCESSO PARA OS DESTINATÁRIOS!')
    except:
        print('Falha ao enviar o Email!')
        the_type, the_value, the_traceback = sys.exc_info()
        print(the_type, ',' ,the_value,',', the_traceback)
        pass

else:
        print('Não existe Gmuds agendadas para os próximos dias')