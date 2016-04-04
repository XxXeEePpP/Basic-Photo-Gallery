<div id="UploadForm">
    <form action="upload.php" method="POST" enctype="multipart/form-data">
    <p>
        *Изберете снимка:
        <input class="FormBox" type="file" name="imagefile" />
    </p>
    <p>
        *Име на снимка:
        <input class="FormBox" type="text" name="title_name" />
    </p>
    <p>
        Описание:
        <input class="FormBox" type="text" name="description" />
    </p>
    <input type="hidden" name="token" value="<?=$token?>">
    <p>
        Категория:
        <?php Render::category_select(); ?>
    </p>    
    <input type="submit" name="submit" value="Качи" />
    </form>
</div>