<div class="PhotoView">

    <p class="Title">
        <?= htmlspecialchars($title_name) ?></span>
    </p>
    <p class="Navigation">
        <a href="<?= $prev_id ?>">Предишна</a>
        ||
        <a href="<?= $next_id ?>">Следваща</a>
    </p>

    <img width="90%" src="<?= htmlspecialchars($img_lnk) ?>"/>

    <p>Описание: <?= htmlspecialchars($description) ?></p>
    <p>Категория: <b><?= htmlspecialchars($category_name) ?></b></p>
    <p>Дата на качване: <b><?= htmlspecialchars($date) ?></b></p>

    <form action="delete.php" method="post"
          onSubmit="return confirm('Сигурни ли сте, че искате да изтриете тази снимка?')";>

        <input type="hidden" name="token" value="<?=$token?>"
    <p>Опции: <input type="submit" name="on_delete" value="Изтриване"></p>
    </form>
</div>