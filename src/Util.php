<?php

namespace Lavoiesl\PhpBenchmark;

class Util
{
    public static function round($number, $significant = 0)
    {
        $order = floor(log($number) / log(10));

        return round($number / pow(10, $order), $significant) * pow(10, $order);
    }

    /**
     * Converts 1024 to 1K, etc.
     *
     * @param  double $number     i.e.: 1280
     * @param  integer $precision i.e.: 1.25 for precision = 2
     *
     * @return string  i.e.: 1.25 KiB
     */
    public static function convertToSI($number, $precision = 2)
    {
        static $sizes = array(
            '0'  => 'B',
            '1'  => 'KiB',
            '2'  => 'MiB',
            '3'  => 'GiB',
            '4'  => 'TiB'
        );

        $scale = $number == 0 ? 0 : floor(log($number, 1024));

        return round($number / pow(1024, $scale), $precision) . ' ' . $sizes[$scale];
    }

    public static function relativePerc($min, $value) {
        if ($min == 0 || $min == $value) {
            return '';
        } else {
            return round(($value - $min) / $min * 100) . ' %';
        }
    }
}
