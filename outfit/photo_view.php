<div class="PhotoView">

    <div class="Title">
        <?= htmlspecialchars($title_name) ?></span>
    </div>
    <div class="Navigation">
        <a href="<?= $prev_id ?>">Предишна</a>
        ||
        <a href="<?= $next_id ?>">Следваща</a>
    </div>
    <div id="Image">
        <img width="100%" src="<?= htmlspecialchars($img_lnk) ?>"/>
    </div>
        
    <div id="Options">
    <p>Описание: <?= htmlspecialchars($description) ?></p>
    <p>Категория: <b><?= htmlspecialchars($category_name) ?></b></p>
    <p>Дата на качване: <b><?= htmlspecialchars($date) ?></b></p>
    
    <form action="delete.php" method="post"
          onSubmit="return confirm('Сигурни ли сте, че искате да изтриете тази снимка?')";>

        <input type="hidden" name="token" value="<?=$token?>">
    Опции: <input type="submit" name="on_delete" value="Изтриване">
    </form>
    </div>
</div>