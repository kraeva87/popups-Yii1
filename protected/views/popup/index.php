<?php
/* @var $this PopupController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Popup List</h1>

<table>
    <tr><th>ID</th><th>Название</th><th>Текст</th><th>Включено</th><th>Количество показов</th><th>Демо</th><th>Скрипт</th><th>Удаление</th></tr>
    <?php foreach ($popups as $popup) :?>
        <tr><td><?= $popup->id ?></td>
            <td><a href="edit?id=<?= $popup->id ?>"><?= $popup->title ?></a></td>
            <td><?= $popup->popup_text ?></td>
            <td><?php echo ($popup->enabled > 0) ? 'да': 'нет'; ?></td>
            <td><?= $popup->count_show ?></td>
            <td><a href="demo?id=<?= $popup->id ?>">демо</a></td>
            <td><a href="getscript?id=<?= $popup->id ?>">скрипт</a></td>
            <td><a href="delete?id=<?= $popup->id ?>">удалить</a></td>
        </tr>
    <?php endforeach; ?>
</table>
