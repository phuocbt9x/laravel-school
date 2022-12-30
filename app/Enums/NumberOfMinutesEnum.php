<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class NumberOfMinutesEnum extends Enum
{
    public const Minutes45 = 1;
    public const Minutes60 = 2;
    public const Minutes90 = 3;
    public const Minutes120 = 4;
    public static function getArrayValue()
    {
        return [
            '45p' => self::Minutes45,
            '60p' => self::Minutes60,
            '90p' =>self::Minutes90,
            '120p' =>self::Minutes120,
            
        ];
    }
    public static function getKeyByValue($value):string
    {
        return array_search($value,self::getArrayValue(),true);
    }
}
