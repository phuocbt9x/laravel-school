<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DayAssignmentEnum extends Enum
{
    public const MONDAY = 2;
    public const TUESDAY = 3;
    public const WEDNESDAY = 4;
    public const THURSDAY = 5;
    public const FRIDAY = 6;
    public const SATURDAY = 7;
    public const SUNDAY = 8;
    public static function getArrayValue()
    {
        return [
            'Thứ 2' => self::MONDAY,
            'Thứ 3' => self::TUESDAY,
            'Thứ 4' =>self::WEDNESDAY,
            'Thứ 5' =>self::THURSDAY,
            'Thứ 6' =>self::FRIDAY,
            'Thứ 7' =>self::SATURDAY,
            'Chủ nhật' =>self::SUNDAY,
        ];
    }

    public static function getKeyByValue($value):string
    {
        return array_search($value,self::getArrayValue(),true);
    }
    
}
