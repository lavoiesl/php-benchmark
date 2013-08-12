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
     * @param  string  $unit      suffix of the unit, may be empty
     * @param  integer $factor    change base to 1000 or 1024
     * @return string  i.e.: 1.25 kB
     */
    public static function convertToSI($number, $precision = 2, $unit = 'B', $factor = 1024)
    {
        static $sizes = array(
            '-3' => 'n',
            '-2' => 'µ',
            '-1' => 'm',
            '0'  => '',
            '1'  => 'k',
            '2'  => 'M',
            '3'  => 'G',
            '4'  => 'T'
        );

        $scale = $number == 0 ? 0 : floor(log($number, $factor));

        return round($number / pow($factor, $scale), $precision) . ' ' . $sizes[$scale] . $unit = 'B';
    }

    public static function relativePerc($min, $value) {
        if ($min == 0 || $min == $value) {
            return '';
        } else {
            return round(($value - $min) / $min * 100) . ' %';
        }
    }
}
