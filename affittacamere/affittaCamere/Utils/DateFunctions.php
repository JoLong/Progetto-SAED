<?php

namespace Utils;
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 24/10/18
 * Time: 19.19
 */

class DateFunctions
{

    public function __construct(){

    }

    public function setDate($date)
    {
        $month = $this->getMonth(substr($date, 4, 3));
        return substr($date, 11, 4) . '' . $month . '' . substr($date, 8, 2);
    }

    public function getMonth($month)
    {
        $up = null;
        switch ($month) {
            case('Jan'):
                $up = '01';
                break;
            case('Feb'):
                $up = '02';
                break;
            case('Mar'):
                $up = '03';
                break;
            case('Apr'):
                $up = '04';
                break;
            case('May'):
                $up = '05';
                break;
            case('Jun'):
                $up = '06';
                break;
            case('Jul'):
                $up = '07';
                break;
            case('Aug'):
                $up = '08';
                break;
            case('Sep'):
                $up = '09';
                break;
            case('Oct'):
                $up = '10';
                break;
            case('Nov'):
                $up = '11';
                break;
            case('Dec'):
                $up = '12';
                break;
        }

        return $up;
    }
}


