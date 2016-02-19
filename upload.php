<?php
session_start();
include_once('config.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'Render.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'SQL.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'Verification.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'Image_Upload.php');

$title = 'Качи Снимка';
Render::header($title);
Render::menu();


if (isset($_POST['submit']) && isset($_POST['token']) && Verification::verify_token($_POST['token'])) {
    Verification::unset_token();

    $iu = new Image_Upload($_FILES['imagefile'], $_POST['title_name'],
        $_POST['description'], $_POST['category']);

    if ($iu->verificateData() === true) {
        if ($iu->saveData() === true) {
            echo 'Снимката беше качена успешно!';
        } else {
            echo 'Проблем при качване!';
        }
    } else {
        echo '<a href="javascript:history.go(-1)">Назад</a>';
    }
} else {
    $token = Verification::set_token();
    Render::upload_form($token);
}

Render::footer();