<?php

namespace App\Helpers;

class NumberToWords
{
    public static function convert($number)
    {
        $ones = array(
            0 => "", 1 => "one", 2 => "two", 3 => "three", 4 => "four",
            5 => "five", 6 => "six", 7 => "seven", 8 => "eight", 9 => "nine"
        );
        
        $tens = array(
            10 => "ten", 11 => "eleven", 12 => "twelve", 13 => "thirteen",
            14 => "fourteen", 15 => "fifteen", 16 => "sixteen",
            17 => "seventeen", 18 => "eighteen", 19 => "nineteen",
            20 => "twenty", 30 => "thirty", 40 => "forty", 50 => "fifty",
            60 => "sixty", 70 => "seventy", 80 => "eighty", 90 => "ninety"
        );

        if ($number == 0) {
            return "zero";
        }

        $words = "";

        if ($number >= 1000000000) {
            $words .= self::convert(floor($number / 1000000000)) . " billion ";
            $number %= 1000000000;
        }

        if ($number >= 1000000) {
            $words .= self::convert(floor($number / 1000000)) . " million ";
            $number %= 1000000;
        }

        if ($number >= 1000) {
            $words .= self::convert(floor($number / 1000)) . " thousand ";
            $number %= 1000;
        }

        if ($number >= 100) {
            $words .= self::convert(floor($number / 100)) . " hundred ";
            $number %= 100;
        }

        if ($number > 0) {
            if ($words != "") {
                $words .= "and ";
            }

            if ($number < 10) {
                $words .= $ones[$number];
            } elseif ($number < 20) {
                $words .= $tens[$number];
            } else {
                $words .= $tens[floor($number / 10) * 10];
                if ($number % 10 > 0) {
                    $words .= "-" . $ones[$number % 10];
                }
            }
        }

        return trim($words);
    }
}