<?php
require 'lib/Dev.php';
require 'core/DefaultAssociate.php';
require 'core/Associate.php';
require 'core/Position.php';
require 'core/Db.php';
require 'lib/Sql.php';
require 'lib/Random.php';
require 'lib/CreateDb.php';
require 'core/View.php';
$limit = require 'config/limit.php';

$sql = new Sql();
$create = new Db();
$view = new View();
$createDB = new CreateDb();

$count = $create->column($sql->countAssociate(Position::LEVEL_1));
if (!($count)) {
    $create->column($sql->createTable());
    $count = 0;
    $director = NULL;
} else {
    $director = $create->column($sql->selectId(Position::LEVEL_1));
}

$nextDirector = 0;
$position = Position::getLevel();
while ($nextDirector != count($position) || $count < $limit[Position::LEVEL_6]) {
    $createDB->recursion($sql, $create, $position, 0);
    sleep(1);
}


if (isset($_GET['associate'])) {
    $id = $_GET['associate'];
    $title = 'Сотрудник';
    $action = 'associate';
    $associate = $create->row($sql->selectById($id));
    $director = $create->row($sql->selectById($associate[0]['director']));
    $result = [
        'associate' => $associate,
        'director' => $director
    ];
} else {
    $where = '';
    $title = 'Таблица сотрудников';
    $action = 'table';
    $sort = '`id` DESC';
    $request = '';
    if (isset($_GET['pattern']) && isset($_GET['field'])) {
        $pattern = $_GET['pattern'];
        $field = $_GET['field'];
        $where = 'WHERE `' . $field . '` LIKE \'%' . $pattern . '%\'';
        $request .= 'pattern=' . $pattern . '&field=' . $field;
    }
    $num = 30;
    $start = 0;
    $associatesCount = $create->column($sql->countPattern($where));
    $total = (($associatesCount - 1) / $num) + 1;
    $total = intval($total);
    if ($total <= 1) {
        $page = '';
    } else {
        $page = 1;
    }
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page < 0) {
            $page = 1;
        }
        if ($page > $total) {
            $page = $total;
        }
        $start = $page * $num - $num;
    }
    $sortFullName = sortFullName();
    $sortPosition = sortPosition();
    $sortEmploymentDate = sortEmploymentDate();
    $sortSalary = sortSalary();
    $associates = $create->row($sql->selectPattern($start, $num, $sort, $where));
    $result = [
        'associates' => $associates,
        'page' => $page,
        'total' => $total,
        'sortFullName' => $sortFullName,
        'sortPosition' => $sortPosition,
        'sortEmploymentDate' => $sortEmploymentDate,
        'sortSalary' => $sortSalary,
        'request' => $request
    ];
}

//debug($sql->countPattern($where));
//debug($result);
$view->render($title, $action, $result);


function sortFullName()
{
    global $sort, $request;
    if (isset($_GET['sortFullName'])) {
        $sortFullName = $_GET['sortFullName'];
        $request .= 'sortFullName=' . $sortFullName;
        if ($sortFullName == 'DESC') {
            $sortFullName = 'ASC';
            $sort = '`fullName` DESC';
        } else {
            $sortFullName = 'DESC';
            $sort = '`fullName` ASC';
        }
    } else {
        $sortFullName = 'DESC';
    }
    return $sortFullName;
}

function sortPosition()
{
    global $sort, $request;
    if (isset($_GET['sortPosition'])) {
        $sortPosition = $_GET['sortPosition'];
        $request .= 'sortPosition=' . $sortPosition;
        if ($sortPosition == 'DESC') {
            $sortPosition = 'ASC';
            $sort = '`position` DESC';
        } else {
            $sortPosition = 'DESC';
            $sort = '`position` ASC';
        }
    } else {
        $sortPosition = 'DESC';
    }
    return $sortPosition;
}

function sortEmploymentDate()
{
    global $sort, $request;
    if (isset($_GET['sortEmploymentDate'])) {
        $sortEmploymentDate = $_GET['sortEmploymentDate'];
        $request .= 'sortEmploymentDate=' . $sortEmploymentDate;
        if ($sortEmploymentDate == 'DESC') {
            $sortEmploymentDate = 'ASC';
            $sort = '`employmentDate` DESC';
        } else {
            $sortEmploymentDate = 'DESC';
            $sort = '`employmentDate` ASC';
        }
    } else {
        $sortEmploymentDate = 'DESC';
    }
    return $sortEmploymentDate;
}

function sortSalary()
{
    global $sort, $request;
    if (isset($_GET['sortSalary'])) {
        $sortSalary = $_GET['sortSalary'];
        $request .= 'sortSalary=' . $sortSalary;
        if ($sortSalary == 'DESC') {
            $sortSalary = 'ASC';
            $sort = '`salary` DESC';
        } else {
            $sortSalary = 'DESC';
            $sort = '`salary` ASC';
        }
    } else {
        $sortSalary = 'DESC';
    }
    return $sortSalary;
}