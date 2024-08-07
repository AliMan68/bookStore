<?php
class PDate {

  var $persian_month_names=array(
    '01'=>'&#1601;&#1585;&#1608;&#1585;&#1583;&#1740;&#1606;',
    '02'=>'&#1575;&#1585;&#1583;&#1740;&#1576;&#1607;&#1588;&#1578;',
    '03'=>'&#1582;&#1585;&#1583;&#1575;&#1583;',
    '04'=>'&#1578;&#1740;&#1585;',
    '05'=>'&#1605;&#1585;&#1583;&#1575;&#1583;',
    '06'=>'&#1588;&#1607;&#1585;&#1740;&#1608;&#1585;',
    '07'=>'&#1605;&#1607;&#1585;',
    '08'=>'&#1570;&#1576;&#1575;&#1606;',
    '09'=>'&#1570;&#1584;&#1585;',
    '10'=>'&#1583;&#1740;',
    '11'=>'&#1576;&#1607;&#1605;&#1606;',
    '12'=>'&#1575;&#1587;&#1601;&#1606;&#1583;'
  );

  var $persian_day_names=array(
    '6'=>'&#1588;&#1606;&#1576;&#1607;',
    '0'=>'&#1740;&#1705;&#1588;&#1606;&#1576;&#1607;',
    '1'=>'&#1583;&#1608;&#1588;&#1606;&#1576;&#1607;',
    '2'=>'&#1587;&#1607; &#1588;&#1606;&#1576;&#1607;',
    '3'=>'&#1670;&#1607;&#1575;&#1585;&#1588;&#1606;&#1576;&#1607;',
    '4'=>'&#1662;&#1606;&#1580;&#1588;&#1606;&#1576;&#1607;',
    '5'=>'&#1570;&#1583;&#1740;&#1606;&#1607;'
  );

  function div($a,$b)
  {
    return (int) ($a / $b);
  }

  function gregorian_to_persian($g_y, $g_m, $g_d)
  {
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
    $gy = $g_y-1600;
    $gm = $g_m-1;
    $gd = $g_d-1;
    $g_day_no = 365*$gy+$this->div($gy+3,4)-$this->div($gy+99,100)+$this->div($gy+399,400);
    for ($i=0; $i < $gm; ++$i)
      $g_day_no += $g_days_in_month[$i];
    if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
      /* leap and after Feb */
      $g_day_no++;
    $g_day_no += $gd;
    $j_day_no = $g_day_no-79;
    $j_np = $this->div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
    $j_day_no = $j_day_no % 12053;
    $jy = 979+33*$j_np+4*$this->div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */
    $j_day_no %= 1461;
    if ($j_day_no >= 366)
    {
      $jy += $this->div($j_day_no-1, 365);
      $j_day_no = ($j_day_no-1)%365;
    }
    for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
      $j_day_no -= $j_days_in_month[$i];
    $jm = $i+1;
    $jd = $j_day_no+1;
    if(strlen($jm)==1) $jm='0'.$jm;
    if(strlen($jd)==1) $jd='0'.$jd;
    return array($jy,$jm, $jd);
  }

  function persian_to_gregorian($j_y, $j_m, $j_d)
  {
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
    $jy = $j_y-979;
    $jm = $j_m-1;
    $jd = $j_d-1;
    $j_day_no = 365*$jy + $this->div($jy, 33)*8 + $this->div($jy%33+3, 4);
    for ($i=0; $i < $jm; ++$i)
      $j_day_no += $j_days_in_month[$i];
    $j_day_no += $jd;
    $g_day_no = $j_day_no+79;
    $gy = 1600 + 400*$this->div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
    $g_day_no = $g_day_no % 146097;
    $leap = true;
    if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */
    {
      $g_day_no--;
      $gy += 100*$this->div($g_day_no, 36524); /* 36524 = 365*100 + 100/4 - 100/100 */
      $g_day_no = $g_day_no % 36524;
      if ($g_day_no >= 365)
        $g_day_no++;
      else
        $leap = false;
    }
    $gy += 4*$this->div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
    $g_day_no %= 1461;
    if ($g_day_no >= 366)
    {
      $leap = false;
      $g_day_no--;
      $gy += $this->div($g_day_no, 365);
      $g_day_no = $g_day_no % 365;
    }
    for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
      $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
    $gm = $i+1;
    $gd = $g_day_no+1;
    if(strlen($gm)==1) $gm='0'.$gm;
    if(strlen($gd)==1) $gd='0'.$gd;
    return array($gy,$gm,$gd);
  }

  function toPersian($g_date, $input)
  {
    $g_date=str_replace('-','',$g_date);
    $g_date=str_replace('/','',$g_date);

    $g_year=substr($g_date,0,4);
    $g_month=substr($g_date,4,2);
    $g_day=substr($g_date,6,2);
    $persian_date=$this->gregorian_to_persian($g_year,$g_month,$g_day);
    if($input=='Y') return $persian_date[0];
    if($input=='y') return substr($persian_date[0],-2);
    if($input=='M') return $this->persian_month_names[$persian_date[1]];
    if($input=='m') return $persian_date[1];
    if($input=='D') return $this->persian_day_names[date('w')];
    if($input=='d') return $persian_date[2];
    if($input=='j')
    {
      $persian_d=$persian_date[2];
      if($persian_d[0]=='0') $persian_d=substr($persian_d,1);
      return $persian_d;
    }
    if($input=='n')
    {
      $persian_n=$persian_date[1];
      if($persian_n[0]=='0') $persian_n=substr($persian_n,1);
      return $persian_n;
    }

    if($input=='Y/m/d') return $persian_date[0].'/'.$persian_date[1].'/'.$persian_date[2];
    if($input=='Ymd') return $persian_date[0].$persian_date[1].$persian_date[2];

    if($input=='y/m/d') return substr($persian_date[0],-2).'/'.$persian_date[1].'/'.$persian_date[2];
    if($input=='ymd') return substr($persian_date[0],-2).$persian_date[1].$persian_date[2];

    if($input=='Y-m-d') return $persian_date[0].'-'.$persian_date[1].'-'.$persian_date[2];
    if($input=='y-m-d') return substr($persian_date[0],-2).'-'.$persian_date[1].'-'.$persian_date[2];


    if($input=='compelete')
    {
      $persian_d=$persian_date[2];
      if($persian_d[0]=='0') $persian_d=substr($persian_d,1);
      return $this->persian_day_names[date('w')].' '.$persian_d.' '.$this->persian_month_names[$persian_date[1]].' '.$persian_date[0];
    }
  }

  function date($input)
  {
    return $this->toPersian(date('Y').date('m').date('d'),$input);
  }

  public function toGregorian($j_date)
  {
    $j_date=str_replace('/','',$j_date);
    $j_date=str_replace('-','',$j_date);
    $j_year=substr($j_date,0,4);
    $j_month=substr($j_date,4,2);
    $j_day=substr($j_date,6,2);
    $gregorian_date=$this->persian_to_gregorian($j_year,$j_month,$j_day);
    return $gregorian_date[0].'-'.$gregorian_date[1].'-'.$gregorian_date[2];
  }

  function sec_to_day($sec)
  {
    $day[s]=bcmod($sec-time(),60);
    if(strlen($day[s])==1) $day[s]='0'.$day[s];
    $day[m]=bcmod(bcdiv($sec-time(),60),60);
    if(strlen($day[m])==1) $day[m]='0'.$day[m];
    $day[h]=bcmod(bcdiv(bcdiv($sec-time(),60),60),24);
    if(strlen($day[h])==1) $day[h]='0'.$day[h];
    $day[d]=bcdiv(bcdiv(bcdiv($sec-time(),60),60),24);
    return $day;
  }


}





function toPersianDate($date, $format = 'Y/m/d'){
  if(strlen($date) < 5)  return null ;
  $d = new PDate();
  try {
    return $d->toPersian($date, $format);
  }catch (Exception $e){
    return null;
  }
}

function toPersianDateTime($date_time, $format = 'Y/m/d'){
  if(strlen($date_time) < 5)  return null ;
  $d = new PDate();
  try {
    $str = explode(' ', $date_time);
    $str[0] = $d->toPersian($str[0], $format);
    return $str[1] . ' - ' . $str[0];
  }catch (Exception $e){
    return null;
  }
}

function toGeorgianDate($persian_date){
  if(strlen($persian_date) < 5)  return null ;
  $d = new PDate();
  try {
    $date = $d->toGregorian(toLatinNumber($persian_date));
  }catch (Exception $e){
    $date = null;
  }
  return $date;
}


function getFullDate(){
  $date = date('Y-m-d');
  $persian_date = toPersianDate($date);
  $dates = explode('/', $persian_date);

  $month = [
    '1' => 'فروردین',
    '2' => 'اردیبهشت',
    '3' => 'خرداد',
    '4' => 'تیر',
    '5' => 'مرداد',
    '6' => 'شهریور',
    '7' => 'مهر',
    '8' => 'آبان',
    '9' => 'آذر',
    '10' => 'دی',
    '11' => 'بهمن',
    '12' => 'اسفند',
  ];

  $week_day = [
    '0' => 'یکشنبه',
    '1' => 'دوشنبه',
    '2' => 'سه شنبه',
    '3' => 'چهارشبه',
    '4' => 'پنج سنبه',
    '5' => 'جمعه',
    '6' => 'شنبه',
  ];
  $day_of_week = date("w", strtotime($date));
  $text = '';
  $text .= " $week_day[$day_of_week] ";
  $text .= " $dates[2] ";
  $m = $month[(int)$dates[1]];
  $text .= " $m ";
  $text .= " $dates[0] ";

  return $text;
}


function getPersianTimeDiff($time){
  date_default_timezone_set('Asia/Tehran');
  $now = strtotime(date("Y-m-d H:i:s"));
  $time = strtotime($time);

  $year = round(abs($now - $time) / (60*60*24*30*12));
  if ($year>0) return "$year سال قبل";
  $month = round(abs($now - $time) / (60*60*24*30));
  if ($month>0) return "$month ماه قبل";
  $week = round(abs($now - $time) / (60*60*24*7));
  if($week>0)  return "$week هفته قبل";
  $day = round(abs($now - $time) / (60*60*24));
  if($day>0)  return "$day روز قبل";
  $hour = round(abs($now - $time) / (60*60));
  if($hour>0)  return "$hour ساعت قبل";
  $minute = round(abs($now - $time) / (60));
  if($minute>0)  return "$minute دقیقه قبل";
  return 'چند لحظه قبل';
}

function getEnglishTimeDiff($time){
  date_default_timezone_set('Asia/Tehran');
  $now = strtotime(date("Y-m-d H:i:s"));
  $time = strtotime($time);

  $year = round(abs($now - $time) / (60*60*24*30*12));
  if ($year>0) return "$year years ago";
  $month = round(abs($now - $time) / (60*60*24*30));
  if ($month>0) return "$month months ago";
  $week = round(abs($now - $time) / (60*60*24*7));
  if($week>0)  return "$week weeks ago";
  $day = round(abs($now - $time) / (60*60*24));
  if($day>0)  return "$day days ago";
  $hour = round(abs($now - $time) / (60*60));
  if($hour>0)  return "$hour hours ago";
  $minute = round(abs($now - $time) / (60));
  if($minute>0)  return "$minute minutes ago";
  return 'now';
}
