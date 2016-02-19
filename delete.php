<?php
session_start();
include_once('config.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'SQL.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'Verification.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'Render.php');

$title = 'Изтриване';
Render::header($title);
Render::menu();

if (isset($_POST['on_delete']) && isset($_POST['token']) &&
    Verification::verify_token($_POST['token']) && isset($_SESSION['id'])
) {
    Verification::unset_token();
    if (Verification::delete_by_id($_SESSION['id'])) {
        echo 'Успещно изтрихте снимката !';
    } else {
        echo 'Проблем при изтриване !';
    }
    unset($_SESSION['id']);
} else {
    echo 'Грешка!';
}
Render::footer();