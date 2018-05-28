<?php

class Position
{
    const LEVEL_1 = 'Президент компании';
    const LEVEL_2 = 'Директор филиала';
    const LEVEL_3 = 'Руководитель отдела';
    const LEVEL_4 = 'Менеджер';
    const LEVEL_5 = 'Рабочий';
    const LEVEL_6 = 'Стажёр';
    private static $level = [self::LEVEL_1, self::LEVEL_2, self::LEVEL_3, self::LEVEL_4, self::LEVEL_5, self::LEVEL_6];


    public static function getLevel()
    {
        return self::$level;
    }

}