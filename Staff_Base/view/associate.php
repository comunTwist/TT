<div id="logo">
    <a href="/">
        <img src="/public/images/logo.png" title="Перейти на главную" alt="Logo" width="200" height="200">
    </a>
</div>
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
<div id="wrapperAssociate">
    <h1><?php echo $associate[0]['fullName'] ?></h1>
    <table>
        <tr>
            <th>Должность</th>
            <td class="positionAssociate"><?php echo $associate[0]['position'] ?></td>
        </tr>
        <tr>
            <th>Дата ​приема ​на ​работу</th>
            <td><?php echo $associate[0]['employmentDate'] ?></td>
        </tr>
        <tr>
            <th>Размер ​заработной ​платы</th>
            <td><?php echo $associate[0]['salary'] . '$' ?></td>
        </tr>
        <tr>
            <th>Руководитель</th>
            <td><?php if ($director): ?>
                <a href="/?associate=<?php echo $director[0]['id'] ?>"><?php echo $director[0]['fullName'] ?></a>
            </td><?php endif; ?>
        </tr>
    </table>
</div>