<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class LichMuonPhongTietHoc extends Enum
{
    public const Tiet_1 = 1;
    public const Tiet_2 = 2;
    public const Tiet_3 = 3;
    public const Tiet_4 = 4;
    public const Tiet_5 = 5;
    public const Tiet_6 = 6;
    public const Tiet_7 = 7;
    public const Tiet_8 = 8;
    public const Tiet_9 = 9;
    public const Tiet_10 = 10;
    public const Tiet_11 = 11;

    public static function getArrayView()
    {
        return [
            'Tiết 1' => self::Tiet_1,
            'Tiết 2' => self::Tiet_2,
            'Tiết 3' => self::Tiet_3,
            'Tiết 4' => self::Tiet_4,
            'Tiết 5' => self::Tiet_5,
            'Tiết 6' => self::Tiet_6,
            'Tiết 7' => self::Tiet_7,
            'Tiết 8' => self::Tiet_8,
            'Tiết 9' => self::Tiet_9,
            'Tiết 10' => self::Tiet_10,
            'Tiết 11' => self::Tiet_11
        ];
    }

    public static function getKeyByValue($value)
    {
        $stringTietHoc = '';
        foreach($value as $tietHoc){
            $stringTietHoc = $stringTietHoc.','. array_search($tietHoc, self::getArrayView());
        }
        return $stringTietHoc = substr($stringTietHoc, 1);
    }
}
