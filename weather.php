<?php
$weather = new Weather();

// メール送信
mb_language("Japanese");
mb_internal_encoding("UTF-8");
require_once("./email.php");
$to = receive_email();
$subject = $weather->todayWeather();
$message = $weather->todayDescription();
$headers = "From: " . send_email();
mb_send_mail($to, $subject, $message); 

// 1回目
$txt = $weather->todayWeather();
exec('/home/pi/jsay.sh '.$txt);
$txt = $weather->todayDescription();
exec('/home/pi/jsay.sh '.$txt);
// 2回目
$txt = $weather->todayWeather();
exec('/home/pi/jsay.sh '.$txt);
$txt = $weather->todayDescription();
exec('/home/pi/jsay.sh '.$txt);

class Weather {
    function __construct(){
        echo $_SERVER[ 'HTTP_USER_AGENT' ];
        if(strpos($_SERVER['HTTP_USER_AGENT'],'Macintosh') !== false) {
            require_once("./phpQuery/phpQuery-onefile.php");
        } else {
            require_once("/home/pi/weather/phpQuery/phpQuery-onefile.php");
        }
        $json = file_get_contents("https://weather.tsukumijima.net/api/forecast?city=130010");
        $arr = json_decode($json);
        $this->arr = $arr;
    }

    function todayDescription(){
        // 天気の詳細
        $weather = $this->arr->description->bodyText;
        echo $weather;
    
        return $weather;
    }
    
    function todayWeather(){
        // 今日の天気について
        $date = $this->arr->forecasts[0]->date;
        $date = explode('-', $date);
        $weather = $date[0] . "年" . $date[1] . "月" . $date[2] . "日";
        $weather .= "の";
    
        $title = $this->arr->title;
        $title = explode(' ', $title);
        $weather .= $title[0] . "" . $title[1] . "" . $title[2];
        $weather .= "は";
    
        $weather .= $this->arr->forecasts[0]->telop;
        $weather .= "です\n";
    
        echo $weather;
    
        return $weather;
    }
}