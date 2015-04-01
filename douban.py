# coding: UTF-8
import urllib
import urllib2
import re
from pyquery import PyQuery as pq
from lxml import etree
import json
import sys
import string
reload(sys)
sys.setdefaultencoding("utf-8")
#urllib函数，用于提交http数据
def open(aurl,post='',Referer=''):
    #proxy = 'http://127.0.0.1:8088'
    #opener = urllib2.build_opener( urllib2.ProxyHandler({'http':proxy}) )
    #urllib2.install_opener(opener)
    if post!='':
        test_data_urlencode = urllib.urlencode(post)
        req = urllib2.Request(url=aurl,data = test_data_urlencode)
    else:
        req = urllib2.Request(url=aurl)
    if Referer!='':
        req.add_header('Referer',Referer)
    res_data = urllib2.urlopen(req)
    return res_data
def timedeal(t):
    t=string.atoi(t)
    h=t/60
    m=t-(h*60)
    return "%02d:%2d"%(h,m)
#程序开始
if __name__ == '__main__':
    try:
        moviename=sys.argv[1].decode('utf-8')
        url="http://movie.douban.com/subject_search?search_text="+urllib.quote(moviename.encode("utf8"))
        res = open(url).read().decode('utf8')
        d = pq(res)
        item = d(".item").eq(0)
        title = item(".nbg").attr('title')
        href=item(".nbg").attr('href')
        #print title
        res = open(href).read().decode('utf8')
        d = pq(res)
        info = d('#info').html()
        #info = info.replace("<br/>","\n")
        info = re.sub('<[^>]+>','',info).strip()
        info = info.replace(" ","")
        info = info.replace("\n\n","\n")
        #print info
        indent = d('#link-report')
        intro=indent("span").eq(0).text()
        time = timedeal(re.findall(u"(?<=片长:).*?(?=分钟)",info,re.DOTALL)[0])
        type = re.findall(u"(?<=类型:).*?(?=\n)",info,re.DOTALL)[0].split("/")
        #print intro
        res = open(href+"/photos?type=R").read().decode('utf8')
        d = pq(res)
        poster = d('.poster-col4')
        posterurl = poster('li').eq(0)('div')('a').attr('href')
        posterurl = re.findall(r"(?<=photos/photo/).*?(?=/)",posterurl,re.DOTALL)[0]
        #posterurl = "http://img5.douban.com/view/photo/raw/public/"+posterurl+".jpg"
        #print posterurl
        ele={"title":title,"info":info,"intro":intro,"posterurl":posterurl,"time":time,"type":type}
        ele.update({"status":"ok"})
        print json.dumps(ele,ensure_ascii=False,indent=2)
    except:
        ele={}
        ele.update({"status":"error"})
        print json.dumps(ele,ensure_ascii=False,indent=2)