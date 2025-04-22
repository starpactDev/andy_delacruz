<?php


if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($number) {
        $number = preg_replace('/[^0-9]/', '', $number);
        if (strlen($number) == 10) {
            return '('.substr($number, 0, 3).') '.substr($number, 3, 3).'-'.substr($number, 6);
        }
        return $number;
    }
}
