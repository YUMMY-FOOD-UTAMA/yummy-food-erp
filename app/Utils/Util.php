<?php

namespace App\Utils;

use Illuminate\Support\Str;

class Util
{
    public static function roundAmount($amount)
    {
        $whole = floor($amount);
        $fraction = $amount - $whole;

        $cents = round($fraction * 100);

        if ($cents <= 50) {
            return $whole;
        } else {
            return $whole + 1;
        }
    }


    public static function rupiah($amount, $notRound = false)
    {
        if ($notRound) {
            return 'Rp' . number_format($amount, 2, ',', '.');
        }
        return 'Rp' . number_format(self::roundAmount($amount), 0, ',', '.');
    }

    public static function amountToIndonesia($amount)
    {
        $amount = self::roundAmount($amount);
        $amount = abs($amount);
        $bilangan = [
            '', 'satu', 'dua', 'tiga', 'empat', 'lima',
            'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'
        ];

        if ($amount < 12) {
            return ' ' . $bilangan[$amount];
        } elseif ($amount < 20) {
            return self::amountToIndonesia($amount - 10) . ' belas';
        } elseif ($amount < 100) {
            return self::amountToIndonesia($amount / 10) . ' puluh' . self::amountToIndonesia($amount % 10);
        } elseif ($amount < 200) {
            return ' seratus' . self::amountToIndonesia($amount - 100);
        } elseif ($amount < 1000) {
            return self::amountToIndonesia($amount / 100) . ' ratus' . self::amountToIndonesia($amount % 100);
        } elseif ($amount < 2000) {
            return ' seribu' . self::amountToIndonesia($amount - 1000);
        } elseif ($amount < 1000000) {
            return self::amountToIndonesia($amount / 1000) . ' ribu' . self::amountToIndonesia($amount % 1000);
        } elseif ($amount < 1000000000) {
            return self::amountToIndonesia($amount / 1000000) . ' juta' . self::amountToIndonesia($amount % 1000000);
        } elseif ($amount < 1000000000000) {
            return self::amountToIndonesia($amount / 1000000000) . ' milyar' . self::amountToIndonesia($amount % 1000000000);
        } elseif ($amount < 1000000000000000) {
            return self::amountToIndonesia($amount / 1000000000000) . ' triliun' . self::amountToIndonesia($amount % 1000000000000);
        } else {
            return 'Angka terlalu besar';
        }
    }

    public static function splitText($text, $maxLength, $spacing = "<br>", $delimiter = ' ')
    {
        $words = explode($delimiter, $text);
        $lines = [];
        $currentLine = '';
        $totalLine = 0;

        foreach ($words as $word) {
            if (Str::length($currentLine . $delimiter . $word) > $maxLength) {
                $lines[] = trim($currentLine);
                $currentLine = $word;
            } else {
                $currentLine .= ($currentLine === '') ? $word : $delimiter . $word;
            }
            $totalLine += 1;
        }

        if (!empty($currentLine)) {
            $lines[] = trim($currentLine);
        }

        $line = "";
        foreach ($lines as $line) {
            echo $line . "\n";
        }
        return [
            'lines' => $lines,
            'line' => $line,
            'total_line' => $totalLine
        ];
    }
}
