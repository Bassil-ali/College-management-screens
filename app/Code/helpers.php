<?php

use App\Code\Calendar;


if (!function_exists('hindi')) {
    function hindi($value)
    {
        if (!isset($value) || strlen($value) == 0) {
            return '';
        }

        $arabic = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
        $hindi = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        return str_replace($arabic, $hindi, $value);
    }
}

if (!function_exists('arabic')) {
    function arabic($value)
    {
        if (!isset($value) || strlen($value) == 0) {
            return '';
        }

        $arabic = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
        $hindi = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        return str_replace($hindi, $arabic, $value);
    }
}

if (!function_exists('h2g')) {
    function h2g($date, $delimiter = '-')
    {
        return Calendar::HijriToGregorian2($date, $delimiter);
    }
}

if (!function_exists('g2h')) {
    function g2h($date, $format = 'Y/m/d', $tolerance = 0)
    {
        return Calendar::GregorianToHijri2($date, $format, $tolerance).'هـ';
    }
}
