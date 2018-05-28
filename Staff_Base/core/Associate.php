<?php

class Associate extends DefaultAssociate
{
    private $position;
    private $director;

    public function __construct($fullName, $employmentDate, $salary, $position, $director)
    {
        parent::__construct($fullName, $employmentDate, $salary);
        $this->position = $position;
        $this->director = $director;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function setDirector($director)
    {
        $this->director = $director;
    }


}