<?php
include_once('config.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'SQL.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'Verification.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'Render.php');


$title = 'Фото Галерия';
Render::header($title);
Render::menu();

if (isset($_GET['submit'])) {
    $search_string = Verification::verify_string($_GET['search']);

    if ($search_string !== false) {
        Render::list_thumbnails('title_name', 'desc', $search_string);

    } else {
        Render::list_thumbnails();

    }
} else if (isset($_GET['sort'])) {
    if (Verification::verify_sort($_GET['sort'], $_GET['order'])) {
        Render::list_thumbnails($_GET['sort'], $_GET['order']);

    } else {
        echo 'Невалидни данни при сортиране!<br>';
    }
} else {
    Render::list_thumbnails();
}

Render::footer();