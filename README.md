# Weather-RaspberryPi

Raspberri Pi用の天気予報発信スクリプト

Weather forecast transmission script for Raspberry Pi


# DEMO

以下のようにイヤフォンジャックにスピーカー接続して、Open Jtalkによる天気予報を発信する

Connect the speaker to the earphone jack as shown below and send the weather forecast by Open Jtalk.


<img src="https://user-images.githubusercontent.com/12876144/114270315-a31e6b00-9a46-11eb-9056-de93287d71e5.jpg" height="640" width="320">


# Requirement
* NOOB(Raspberry Pi OS)
* PHP
* Shell Script
* Open Jtalk
* https://weather.tsukumijima.net/ (API)

# Features

* Jsonデータからリクエストしたデータを取得し、天気予報発信用に文字列を加工する。
<br>

* Get the requested data from Json data and process the character string for sending the weather forecast.


# Installation
```bash
apt-get install open_jtalk
apt-get install open-jtalk-mecab-naist-jdic hts-voice-nitech-jp-atr503-m001

# 以下のような記載をする
cat /root/jsay.sh
#!/bin/sh
TMP=/tmp/jsay.wav
cd /usr/share/hts-voice/nitech-jp-atr503-m001
echo "$1" | open_jtalk \
-td tree-dur.inf \
-tf tree-lf0.inf \
-tm tree-mgc.inf \
-md dur.pdf \
-mf lf0.pdf \
-mm mgc.pdf \
-dm mgc.win1 \
-dm mgc.win2 \
-dm mgc.win3 \
-df lf0.win1 \
-df lf0.win2 \
-df lf0.win3 \
-dl lpf.win1 \
-ef tree-gv-lf0.inf \
-em tree-gv-mgc.inf \
-cf gv-lf0.pdf \
-cm gv-mgc.pdf \
-k gv-switch.inf \
-s 16000 \
-a 0.05 \
-u 0.0 \
-jm 1.0 \
-jf 1.0 \
-jl 1.0 \
-x /var/lib/mecab/dic/open-jtalk/naist-jdic \
-ow $TMP &amp;&amp; \
aplay --quiet $TMP
rm -f $TMP

apt-get install ibus-anthy
amixer cset numid=3 1
```


# Reference
https://deviceplus.jp/hobby/raspberrypi_entry_020/


# Author
* Dhiki(Infrastructure engineer & Video contributor)
* https://twitter.com/DHIKI_pico


# License
ご自由に使用いただいて構いません。

Feel free to use it.
