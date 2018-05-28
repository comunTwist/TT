<div id="logo"><a href="/"><img src="/public/images/logo.png" title="Перейти на главную" alt="Logo" width="200" height="200"></a></div>
<div id="wrapper">
    <div id="search">
        <form action="/" method="GET">
            <input type="text" name="pattern">
            <select name="field">
                <option value="fullName">ФИО</option>
                <option value="position">Должность</option>
                <option value="employmentDate">Дата</option>
                <option value="salary">Зарплата</option>
            </select>
            <button>Искать</button>
        </form>
    </div>
    <div id="navbar">
        <div class="cell">
            <div id="listLink">Список</div>
        </div>
        <div class="cell">
            <div id="domLink">Дерево</div>
        </div>
        <div class="cell">

        </div>
    </div>
    <div class="th">
        <div class="fullName">
            <div class="cover">
                <div class="header">ФИО</div>
                <div class="sort">
                    <form action="/" method="GET">
                        <input type="hidden" name="sortFullName" value="<?php echo $sortFullName ?>">
                        <button title="Сотрировать по имени"></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="position">
            <div class="cover">
                <div class="header">Должность</div>
                <div class="sort">
                    <form action="/" method="GET">
                        <input type="hidden" name="sortPosition" value="<?php echo $sortPosition ?>">
                        <button title="Сотрировать по должности"></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="employmentDate">
            <div class="cover">
                <div class="header">Дата ​приема ​на ​работу</div>
                <div class="sort">
                    <form action="/" method="GET">
                        <input type="hidden" name="sortEmploymentDate" value="<?php echo $sortEmploymentDate ?>">
                        <button title="Сотрировать по дате"></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="salary">
            <div class="cover">
                <div class="header">Размер ​заработной ​платы</div>
                <div class="sort">
                    <form action="/" method="GET">
                        <input type="hidden" name="sortSalary" value="<?php echo $sortSalary ?>">
                        <button title="Сотрировать по зарплате"></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">Картотека</div>
    </div>
    <?php foreach ($associates as $key => $val): ?>
        <div class="td">
            <div class="fullName"><?php echo $val['fullName'] ?>    </div>
            <div class="position"><?php echo $val['position'] ?> </div>
            <div class="employmentDate"><?php echo $val['employmentDate'] ?></div>
            <div class="salary"><?php echo $val['salary'] . '$' ?> </div>
            <div class="card"><a href="/?associate=<?php echo $val['id'] ?>">Подробнее</a></div>
        </div>
    <?php endforeach; ?>
</div>
<?php

$sign = '';
$amp = '';
if ($request != '') {
    $sign = '?';
    $amp = '&';
}
if ($page != '') {
    if ($page != 1) $firstPage = '<a href="/' . $sign . $request . '">Первая</a> | <a href="/' . $sign . $request . $amp . 'page=' . ($page - 1) . '">Предыдущая</a> | ';
    if ($page != $total) $nextPage = ' | <a href="/?' . $request . $amp . 'page=' . ($page + 1) . '">Следующая</a> | <a href="/?' . $request . $amp . 'page=' . $total . '">Последняя</a>';
    if ($page - 5 > 0) $page5left = '<a href="/?' . $request . $amp . 'page=' . ($page - 5) . '">' . ($page - 5) . '</a> | ';
    if ($page - 4 > 0) $page4left = '<a href="/?' . $request . $amp . 'page=' . ($page - 4) . '">' . ($page - 4) . '</a> | ';
    if ($page - 3 > 0) $page3left = '<a href="/?' . $request . $amp . 'page=' . ($page - 3) . '">' . ($page - 3) . '</a> | ';
    if ($page - 2 > 0) $page2left = '<a href="/?' . $request . $amp . 'page=' . ($page - 2) . '">' . ($page - 2) . '</a> | ';
    if ($page - 1 > 0) $page1left = '<a href="/?' . $request . $amp . 'page=' . ($page - 1) . '">' . ($page - 1) . '</a> | ';
    if ($page + 5 <= $total) $page5right = ' | <a href="/?' . $request . $amp . 'page=' . ($page + 5) . '">' . ($page + 5) . '</a>';
    if ($page + 4 <= $total) $page4right = ' | <a href="/?' . $request . $amp . 'page=' . ($page + 4) . '">' . ($page + 4) . '</a>';
    if ($page + 3 <= $total) $page3right = ' | <a href="/?' . $request . $amp . 'page=' . ($page + 3) . '">' . ($page + 3) . '</a>';
    if ($page + 2 <= $total) $page2right = ' | <a href="/?' . $request . $amp . 'page=' . ($page + 2) . '">' . ($page + 2) . '</a>';
    if ($page + 1 <= $total) $page1right = ' | <a href="/?' . $request . $amp . 'page=' . ($page + 1) . '">' . ($page + 1) . '</a>';
}
if ($total >= 0) {
    Error_Reporting(E_ALL & ~E_NOTICE);
}

?>
<div id='pageNav'>
    <?php echo $firstPage . $page5left . $page4left . $page3left . $page2left . $page1left . "<span class='bold'>" . $page . "</span>" . $page1right . $page2right . $page3right . $page4right . $page5right . $nextPage; ?>
</div>
