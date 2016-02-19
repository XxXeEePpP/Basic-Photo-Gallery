<?php
include_once('config.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'SQL.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'Verification.php');
include_once('classes' . DIRECTORY_SEPARATOR . 'Render.php');
session_start();

Render::header();
Render::menu();

$id = $_GET['id'];
$_SESSION['id'] = $id;
$token = Verification::set_token();
if (!Render::photo_view($id, $token)) {
    echo '404!';
}

Render::footer();