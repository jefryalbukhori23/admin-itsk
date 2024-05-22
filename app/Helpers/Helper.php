<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;
class Helper
{

    public static function hehe($number,$string)
    {
        $hehehe = $string;
        for($i=0;$i<$number;$i++){
            $hehe = Crypt::encryptString($hehehe);
            // $hehe2 = md5($hehe);
            $hehehe = $hehe;
            // $hehe3 = sha1($hehe2);

        }
        return $hehe;
    }

    public static function haha($number,$string){
        $hehehe = $string;
        for($i=0;$i<$number;$i++){
            $hehe = Crypt::decryptString($hehehe);
            // $hehe2 = md5($hehe);
            $hehehe = $hehe;
            // $hehe3 = sha1($hehe2);

        }
        return $hehe;
    }

    public static function D(){
        $number = random_int(1,3);

        return $number;
    }
    public static function yohohoho($string){
        $yohohoho = Crypt::decryptString($string);
        return $yohohoho;
    }
}
