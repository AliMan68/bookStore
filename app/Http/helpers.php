<?php
use \Illuminate\Support\Facades\Route;
if (!function_exists('isActive')){

    function isActive($name,$activeClass = ''){

        if (is_array($name))
            return in_array(Route::currentRouteName(),$name) ? $activeClass : '';
        return Route::currentRouteName() == $name ? $activeClass : '';
    }

}
if (!function_exists('isUrl')){

    function isUrl($url,$activeClass = ''){
        return request()->fullUrlIs($url) ? $activeClass : '';
    }

}

function getRediretRoute(){
    $user = auth()->user();
    $roles = $user->roles;
    foreach ($roles as $role){
        return $role->redirect_route;
    }

    return 'index';
}

function hasRole($role_name, $user = null){
    is_null($user) ? $user = auth()->user() : $user = $user;
    foreach ($user->roles as $role) {
        if ($role->name == $role_name) return true;
    }
    return false;
}

function isRolesIn($roles_id, $user = null){
    is_null($user) ? $user = auth()->user() : $user = $user;
    $roles = $user->roles;
    foreach ($roles_id as $role_id){
        foreach ($roles as $role){
            if ($role_id == $role->id){
                return true;
            }
        }
    }

    return false;
}


function hasJustRole($role_name, $user = null){
    is_null($user) ? $user = auth()->user() : $user = $user;
    foreach ($user->roles as $role) {
        if ($role->name == $role_name && $user->roles()->count() == 1) return true;
    }
    return false;
}

//function getFirstRole($user = null){
//  is_null($user) ? $user = auth()->user() : $user = $user;
//  foreach ($user->roles as $role) {
//    return $role;
//  }
//}

function hasPublicRole($user = null){
    is_null($user) ? $user = auth()->user() : $user = $user;
    foreach ($user->roles as $role) {
        if ($role->type == \App\Models\Role::TYPE_PUBLIC)
            return true;
    }
    return false;
}

function hasPrivateRole($user = null){
    is_null($user) ? $user = auth()->user() : $user = $user;
    foreach ($user->roles as $role) {
        if ($role->type == \App\Models\Role::TYPE_PRIVATE)
            return true;
    }
    return false;
}

//=========================== permissions ================================
function getPermissions($user = null){
    (is_null($user))? $user = auth()->user() : $user = $user;
    $roles = $user->roles;
    $list = array();
    foreach ($roles as $role){
        $permissions = $role->permissions;
        try{
            $permissions = json_decode($permissions);
            $list = array_merge($list, $permissions);
        }catch (Exception $e){}
    }
    return $list;
}

function getSpecialPermissions($user = null){
    (is_null($user))? $user = auth()->user() : $user = $user;
    $roles = $user->roles;
    $list = array();
    foreach ($roles as $role){
        $permissions = $role->special_permissions;
        try{
            $permissions = json_decode($permissions);
            $list = array_merge($list, $permissions);
        }catch (Exception $e){}
    }
    return $list;
}


function hasAccessRoute($route){
    $permissions = getPermissions();
    if (in_array($route, $permissions))
        return true;
    return false;
}

function hasPermission($route, $user = null){
    (is_null($user))? $user = auth()->user() : $user = $user;
    if (hasRole(Role::ADMIN))
        return true;
    $permissions = getPermissions($user);
    if (in_array($route, $permissions))
        return true;
    return false;
}

function hasSpecialPermission($name, $user = null){
    (is_null($user))? $user = auth()->user() : $user = $user;
    if (hasRole(Role::ADMIN))
        return true;
    $permissions = getSpecialPermissions($user);
    if (in_array($name, $permissions))
        return true;
    return false;
}

function roleHasPermission($role, $permission){
    $permissions = $role->permissions;
    try{
        $permissions = json_decode($permissions);
    }catch (Exception $e){
        $permissions = [];
    }
    is_null($permissions) ? $permissions = [] : $permissions = $permissions;
    in_array($permission, $permissions) ? $result = true : $result = false;
    return $result;
}

function roleHasSpecialPermission($role, $permission){
    $permissions = $role->special_permissions;
    try{
        $permissions = json_decode($permissions);
    }catch (Exception $e){
        $permissions = [];
    }
    is_null($permissions) ? $permissions = [] : $permissions = $permissions;
    in_array($permission, $permissions) ? $result = true : $result = false;
    return $result;
}


function rolesAddPermissions($role_names, $new_permissions){
    foreach ($role_names as $name){
        $role = Role::where('name', '=', $name)->first();
        if(is_null($role))
            continue;

        $permissions = $role->permissions;
        try{
            $permissions = json_decode($permissions);
        }catch (Exception $e){
            $permissions = [];
        }
        is_null($permissions) ? $permissions = [] : $permissions = $permissions;
        (!is_array($permissions)) ? $permissions = [] : $permissions = $permissions;

        $permissions = array_merge($permissions, $new_permissions);
        $role->permissions = $permissions;
        $role->save();
    }
}


function roleRemovePermission($role_names, $old_permissions){
    foreach ($role_names as $name){
        $role = Role::where('name', '=', $name)->first();
        if(is_null($role))
            continue;

        $permissions = $role->permissions;
        try{
            $permissions = json_decode($permissions);
        }catch (Exception $e){
            $permissions = [];
        }
        is_null($permissions) ? $permissions = [] : $permissions = $permissions;
        (!is_array($permissions)) ? $permissions = [] : $permissions = $permissions;

        $permissions = array_diff($permissions, $old_permissions);
        $role->permissions = $permissions;
        $role->save();
    }
}



//=========================== files ================================
function uploadFile($file, $options = []){
    if (!is_file($file)) return null;

    if (is_null($file)) return null;

    $valid_extensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpeg', 'jpg', 'png', 'zip', 'rar', 'txt', 'ppt', 'pptx', 'mp4', 'mpeg', 'mpeg'];
    $extension = $file->extension();

    if (!in_array($extension, $valid_extensions) && !in_array($file->getClientOriginalExtension(), $valid_extensions))
        return null;

    try{
        $id = auth()->user()->id;
    }catch (Exception $e){
        $id = '0';
    }


    date_default_timezone_set('Asia/Tehran');
    $year_dir = date('Y', time());
    $month_dir = date('m', time());
    $random = getRandomString(6) . "_";
    $file_dir = 'uploads/files/' . $year_dir . '/' . $month_dir;
    $name = $random . $id . '_' . $file->getClientOriginalName();
    $file->move($file_dir, $name);
    $path = $file_dir .'/'. $name;
    return $path;
}




//=========================== random ================================
function getRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getRandomNumber($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



//=========================== numbers ================================
function toLatinNumber($string){
    $chars = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $latinString = '';

    for ($i = 0 ; $i < strlen($string) ; $i++){
        switch (mb_substr($string, $i, 1, 'utf-8')){
            case  $chars[0] : $latinString .= '0';break;
            case  $chars[1] : $latinString .= '1';break;
            case  $chars[2] : $latinString .= '2';break;
            case  $chars[3] : $latinString .= '3';break;
            case  $chars[4] : $latinString .= '4';break;
            case  $chars[5] : $latinString .= '5';break;
            case  $chars[6] : $latinString .= '6';break;
            case  $chars[7] : $latinString .= '7';break;
            case  $chars[8] : $latinString .= '8';break;
            case  $chars[9] : $latinString .= '9';break;
            default : $latinString .= mb_substr($string, $i, 1, 'utf-8');break;
        }
    }

    return $latinString;
}

function convertRequestDataToEnglishNumbers($string){
    if (request()->hasFile($string)) return $string;
    if (!is_string($string) && !is_array($string)) return $string;
    $string = json_encode($string, JSON_UNESCAPED_UNICODE);
    $persinaDigits1 = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $persinaDigits2 = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨','٩'];
    $allPersianDigits = array_merge($persinaDigits1, $persinaDigits2);
    $replaces = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $string = str_replace($allPersianDigits, $replaces , $string);
    return json_decode($string);
}


function toPersianNumber($string){
    $chars = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $persianString = '';

    for ($i = 0 ; $i < strlen($string) ; $i++){
        switch (mb_substr($string, $i, 1, 'utf-8')){
            case '0' : $persianString .= $chars[0]; break;
            case '1' : $persianString .= $chars[1]; break;
            case '2' : $persianString .= $chars[2]; break;
            case '3' : $persianString .= $chars[3]; break;
            case '4' : $persianString .= $chars[4]; break;
            case '5' : $persianString .= $chars[5]; break;
            case '6' : $persianString .= $chars[6]; break;
            case '7' : $persianString .= $chars[7]; break;
            case '8' : $persianString .= $chars[8]; break;
            case '9' : $persianString .= $chars[9]; break;
            default : $persianString .= mb_substr($string, $i, 1, 'utf-8');break;
        }
    }

    return $persianString;
}

function toNumber($string){
    $int = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
    if (strlen($int) > 0)
        return strval($int);

    return null;
}





function toFloatNumber($string){
    $float = preg_replace("/[^0-9.]/", "", $string);
    if (strlen($float) > 0)
        return strval($float);
    return null;
}




//=========================== user ================================
function getFullName($user = '#', $show_national_code = true){
    ($user == '#') ? $user = auth()->user() : $user = $user;
    try {
        $full_name = $user->first_name . ' ' . $user->last_name;
        if ($show_national_code)
            $full_name .= '(' . $user->national_code . ')';
    }catch (Exception $e) {
        $full_name = '';
    }
    return $full_name;
}

function getRolesPersianName($user = null){
    is_null($user) ? $user = auth()->user() : $user = $user;
    $roles = $user->roles;
    $names = '';
    foreach ($roles as $role){
        $names .= $role->persian_name . ',';
    }
    $names = rtrim($names, ',');
    return $names;
}

function findDuplicateUser($mobile = '#', $email = '#', $national_code = '#'){
    return User::where('email', '=', $email)
        ->orWhere('national_code', '=', $national_code)
        ->orWhere('mobile', '=', '0'. $mobile)
        ->orWhere('mobile', '=', ltrim($mobile, '0'))
        ->orWhere('mobile', '=', $mobile)
        ->first();
}






//=========================== views ================================
function getViewList(){
    $views = Storage::disk('views')->allFiles();
    foreach ($views as $key => $value){
        $views[$key] = str_replace('/','.' ,$value);
    }

    return $views;
}


function handleItemActive($check_route){
    $route = \Illuminate\Support\Facades\Request::route()->getName();
    if ($route == $check_route)
        return ' active ';
    return '';
}

function handleItemEnable($check_route, $user = null){
    (!is_array($check_route)) ? $check_route = [$check_route] : $check_route = $check_route;
    (is_null($user)) ? $user = auth()->user() : $user = $user;

    if (hasRole(Role::ADMIN, $user))
        return '';

    foreach ($check_route as $route){
        if (hasPermission($route, $user))
            return '';
    }

    return ' d-none ';
}

function handleItemEnableActive($check_route, $user = null){
    (!is_array($check_route)) ? $check_route = [$check_route] : $check_route = $check_route;
    $route1 = \Illuminate\Support\Facades\Request::route()->getName();
    if ($route1 == $check_route[0])
        $class =  ' active ';
    else
        $class = '';

    (is_null($user)) ? $user = auth()->user() : $user = $user;
    if (hasRole(Role::ADMIN, $user))
        return $class;
    foreach ($check_route as $route){
        if (hasPermission($route, $user))
            return $class;
    }
    $class .= ' d-none ';
    return $class;
}


//=========================== barcode ================================
function generateUserBarcode($user_id){
    $code = $user_id + 1289789;
    $code *= 2;
    $code = (($user_id % 9) + 1) . $code . ($user_id % 7)  ;
    return $code;
}


function convertBarcodeToUserId($code){
    try {
        $code = (int)filter_var($code, FILTER_SANITIZE_NUMBER_INT);
        $code = substr($code, 1);
        $code = substr($code, 0, -1);
        $code /= 2;
        $user_id = abs($code - 1289789);
    }catch (Exception $e){
        $user_id = 0;
    }
    return $user_id;
}

//=========================== env ================================
function setEnv($envKey, $envValue) {
    Artisan::call("cache:clear");
    Artisan::call("config:clear");
    Artisan::call("route:clear");

    $envFile = app()->environmentFilePath();
    $str = file_get_contents($envFile);
    $str .= "\n"; // In case the searched variable is in the last line without \n
    $keyPosition = strpos($str, "{$envKey}=");
    $endOfLinePosition = strpos($str, "\n", $keyPosition);
    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

    // If key does not exist, add it
    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
        $str .= "{$envKey}={$envValue}\n";
    } else {
        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
    }

    $str = substr($str, 0, -1);
    if (!file_put_contents($envFile, $str))
        return false;
    return true;
}


//=========================== public path ================================\
function getRealPublicPath(){
    try {
        global $my_public_path;
        return $my_public_path;
    }catch (Exception $e){
        return public_path();
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


function getFullDate($date = null){
    (is_null($date)) ? $date = date('Y-m-d') : $date = $date;
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

function dateToPersianWords($persian_date){
    $str = '';
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

    try {
        $parts = explode('/', $persian_date);
        $str .= numberToPersianWords((int)($parts[2])) . 'م ';
        $str .= $month[((int)($parts[1]))] . ' ';
        $str .= ' سال ' . numberToPersianWords((int)($parts[0]));
        return $str;
    }catch (Exception $e){
        return '';
    }
}



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








