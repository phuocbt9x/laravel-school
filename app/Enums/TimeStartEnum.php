<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TimeStartEnum extends Enum
{
    public const Shift_1 = 1;
    public const Shift_2 = 2;
    public const Shift_3 = 3;
    public const Shift_4 = 4;
    public const Shift_5 = 5;
    public const Shift_6 = 6;
    public const Shift_7 = 7;   
    public const Shift_8 = 8;   
    public const Shift_9 = 9;   
    public const Shift_10 = 10;   
    public const Shift_11 = 11;   
    public const Shift_12 = 12;      
    public static function getArrayValue()
    {
        return [
            '6:45' => self::Shift_1,
            '7:45' => self::Shift_2,
            '9:00' =>self::Shift_3,
            '9:45' =>self::Shift_4,
            '10:30' =>self::Shift_5,
            '12:00' =>self::Shift_6,
            '12:45' =>self::Shift_7,
            '13:30' =>self::Shift_8,
            '14:15' =>self::Shift_9,
            '15:00' =>self::Shift_10,
            '15:45' =>self::Shift_11,
            '16:30' =>self::Shift_12
            
        ];
    }
    public static function getKeyByValue($value):string
    {
        return array_search($value,self::getArrayValue(),true);
    }
}
