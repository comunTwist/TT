<?php

class Sql
{
    public function createTable()
    {
        return "CREATE TABLE IF NOT EXISTS `associate` (
                `id` INT (10) NOT NULL AUTO_INCREMENT,
                `fullName` VARCHAR (100) NOT NULL,
                `employmentDate` DATE NOT NULL,
                `salary` INT (10) NOT NULL,
                `position` VARCHAR (100) NOT NULL,
                `director` INT (10),
                PRIMARY KEY (`id`)
                ) Engine=InnoDB DEFAULT CHARSET=utf8";
    }

    public function createAssociate($obj)
    {
        $fullName = $obj->getFullName();
        $employmentDate = $obj->getEmploymentDate();
        $salary = $obj->getSalary();
        $position = $obj->getPosition();
        $director = $obj->getDirector();
        $director = $director != NULL ? "'$director'" : "NULL";
        return "INSERT INTO `associate` (          
                `fullName`,
                `employmentDate`,
                `salary`,
                `position`,
                `director`)
                VALUES (
                '$fullName',
                '$employmentDate',
                '$salary',
                '$position',
                $director)";
    }

    public function countAssociate($position = NULL)
    {
        if ($position != NULL) {
            return "SELECT COUNT(*) FROM `associate` WHERE `position` = '$position'";
        } else {
            return "SELECT COUNT(*) FROM `associate`";
        }
    }

    public function selectById($id)
    {
        return "SELECT * FROM `associate` WHERE `id` = $id";
    }

    public function selectId($position)
    {
        return "SELECT `id` FROM `associate` WHERE `position` = '$position'";
    }

    public function selectAll()
    {
        return "SELECT * FROM `associate`";
    }

    public function selectFromTo($start, $num, $sort)
    {
        return "SELECT * FROM `associate` ORDER BY $sort LIMIT $start, $num";
    }

    public function countPattern($where)
    {
        return "SELECT COUNT(*) FROM `associate` $where";
    }

    public function selectPattern($start, $num, $sort, $where)
    {
        return "SELECT * FROM `associate` $where ORDER BY $sort LIMIT $start, $num";
    }
}