<?php

namespace Core\Classes;


class Utils {
    public static function nvl($val, $return = 0) {
        return isset($val) ? $val : $return;
    }

    public static function fvl($val, $return = 0) {
        return isset($val) && $val ? $val : $return;
    }

    public static function saveImageFromBase64($data, $target){
        $photo_data = base64_decode($data);
        file_put_contents($target, $photo_data);
        return file_exists($target) ? $target : false;
    }

    public static function getAgeFromDate($date){
        //$calc = ((time()-strtotime($date))/(60*60*24*365.25));
        $date_a = new \DateTime($date);
        $date_b = new \DateTime();
        $interval = $date_b->diff($date_a);
        $result = ($interval->y > 0 ? $interval->format("%y лет") : "") . ($interval->m > 0 ? $interval->format(" %m мес") : "") . ($interval->y == 0 && $interval->m == 0 && $interval->d > 0 ? $interval->format(" %d дней") : "");
        return  $result;
    }
}