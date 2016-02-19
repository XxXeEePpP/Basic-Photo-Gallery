<form action="upload.php" method="POST" enctype="multipart/form-data">
    <p>
        *Изберете снимка:
        <input type="file" name="imagefile" />
    </p>
    <p>
        *Име на снимка:
        <input type="text" name="title_name" />
    </p>
    <p>
        Описание:
        <input type="text" name="description" />
    </p>
    <input type="hidden" name="token" value="<?=$token?>">
    <p>
        Категория:
        <?php Render::category_select(); ?>
    </p>
    <p>
        <input type="submit" name="submit" value="Качи" />
    </p>
</form>