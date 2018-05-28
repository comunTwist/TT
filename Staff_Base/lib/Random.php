<?php


class Random
{
    private static $maleName = ['Никифор', 'Роман', 'Артур', 'Иван', 'Василий', 'Дмитрий', 'Алексей', 'Сергей', 'Анатолий', 'Вячеслав', 'Эдуард', 'Николай', 'Виктор'];
    private static $femaleName = ['Гертруда', 'Анджела', 'Ульяна', 'Мария', 'Таисия', 'Анна', 'Людмила', 'Светлана', 'Елизавета', 'Анастасия', 'Карина', 'Лидия', 'Валентина'];

    private static $malePatronymic = ['Никифорович', 'Романович', 'Артурович', 'Иванович', 'Васильевич', 'Дмитриевич', 'Алексеевич', 'Сергеевич', 'Анатольевич', 'Вячеславович', 'Эдуардович', 'Николаевич', 'Викторович'];
    private static $femalePatronymic = ['Никифоровна', 'Романовна', 'Артуровна', 'Ивановна', 'Васильевна', 'Дмитриевна', 'Алексеевна', 'Сергеевна', 'Анатольевна', 'Вячеславовна', 'Эдуардовна', 'Николаевна', 'Викторовна'];

    private static $surname = ['Амперсант', 'Добробут', 'Альховик', 'Партыко', 'Матрас', 'Кажедуб', 'Иванченко', 'Мороз', 'Фортуна', 'Скрипт', 'Прикол', 'Междометие'];


    public static function generateAssociate($position, $director = NULL)
    {
        if (rand(1, 10) <= 5) {
            $fulName = self::generateName(self::$maleName, self::$malePatronymic);
        } else {
            $fulName = self::generateName(self::$femaleName, self::$femalePatronymic);
        }
        $employmentDate = self::generateDate($position);
        $salary = self::generateSalary($position);
        return new Associate($fulName, $employmentDate, $salary, $position, $director);
    }

    private static function generateName($name, $patronymic)
    {
        return self::$surname[rand(0, count(self::$surname) - 1)] . ' ' . $name[rand(0, count($name) - 1)] . ' ' . $patronymic[rand(0, count($patronymic) - 1)];
    }

    private static function generateDate($position)
    {
        switch ($position) {
            case Position::LEVEL_1:
                $timestamp = rand(strtotime("Jan 01 2007"), strtotime("Dec 31 2008"));
                $date = date("Y-m-d", $timestamp);
                break;
            case Position::LEVEL_2:
                $timestamp = rand(strtotime("Jan 01 2008"), strtotime("Dec 31 2010"));
                $date = date("Y-m-d", $timestamp);
                break;
            case Position::LEVEL_3:
                $timestamp = rand(strtotime("Jan 01 2010"), strtotime("Dec 31 2012"));
                $date = date("Y-m-d", $timestamp);
                break;
            case Position::LEVEL_4:
                $timestamp = rand(strtotime("Jan 01 2012"), strtotime("Dec 31 2014"));
                $date = date("Y-m-d", $timestamp);
                break;
            case Position::LEVEL_5:
                $timestamp = rand(strtotime("Jan 01 2014"), strtotime("Feb 28 2018"));
                $date = date("Y-m-d", $timestamp);
                break;
            case Position::LEVEL_6:
                $timestamp = rand(strtotime("Mar 01 2018"), strtotime("May 01 2018"));
                $date = date("Y-m-d", $timestamp);
                break;
            default:
                $date = date("Y-m-d");
        }
        return $date;
    }

    private static function generateSalary($position)
    {
        switch ($position) {
            case Position::LEVEL_1:
                $salary = rand(70, 150) * 100;
                break;
            case Position::LEVEL_2:
                $salary = rand(35, 50) * 100;
                break;
            case Position::LEVEL_3:
                $salary = rand(100, 150) * 10;
                break;
            case Position::LEVEL_4:
                $salary = rand(80, 100) * 10;
                break;
            case Position::LEVEL_5:
                $salary = rand(60, 90) * 10;
                break;
            case Position::LEVEL_6:
                $salary = rand(10, 30) * 10;
                break;
            default:
                $salary = 0;
        }
        return $salary;
    }
}