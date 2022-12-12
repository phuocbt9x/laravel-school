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
            'Monday' => self::MONDAY,
            'Tuesday' => self::TUESDAY,
            'Wednesday' =>self::WEDNESDAY,
            'Thursday' =>self::THURSDAY,
            'Friday' =>self::FRIDAY,
            'Saturday' =>self::SATURDAY,
            'Sunday' =>self::SUNDAY,
        ];
    }

    public static function getKeyByValue($value):string
    {
        return array_search($value,self::getArrayValue(),true);
    }
    
}
