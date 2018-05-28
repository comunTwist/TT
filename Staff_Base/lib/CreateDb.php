<?php

class CreateDb
{
    public function recursion($sql, $create, $position, $score)
    {
        global $nextDirector, $count, $limit, $director;
        if ($nextDirector < count($position) && $score < 50) {
            $count = $create->column($sql->countAssociate($position[$nextDirector]));
            if ($count < $limit[$position[$nextDirector]]) {
                $create->column($sql->createAssociate(Random::generateAssociate($position[$nextDirector], $director)));
                if ($nextDirector > 0) {
                    $id = $create->row($sql->selectId($position[$nextDirector - 1]));
                } else {
                    $id = $create->row($sql->selectId($position[$nextDirector]));
                }
                $director = $id[rand(0, count($id) - 1)]['id'];
                $score++;
                $this->recursion($sql, $create, Position::getLevel(), $score, $director);
            } else {
                $nextDirector++;
                $this->recursion($sql, $create, Position::getLevel(), $score, $director);
            }
        }
    }
}