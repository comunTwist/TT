<?php


abstract class DefaultAssociate
{
    private $fullName;
    private $employmentDate;
    private $salary;

    public function __construct($fullName, $employmentDate, $salary)
    {
        $this->fullName = $fullName;
        $this->employmentDate = $employmentDate;
        $this->salary = $salary;
    }


    public function getFullName()
    {
        return $this->fullName;
    }


    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }


    public function getEmploymentDate()
    {
        return $this->employmentDate;
    }


    public function setEmploymentDate($employmentDate)
    {
        $this->employmentDate = $employmentDate;
    }


    public function getSalary()
    {
        return $this->salary;
    }


    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

}