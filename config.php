<?php
//developer mod (1/0)
$developer_mod = 1;
$message = '<p class="error">Системна грешка! Моля свържете се с администраторите!</p>';

//db configuration
$host = 'localhost';
$db_name = 'photo_gallery';
$user = 'root';
$password = '13214';

//default title name
$default_title = 'Фото галерия';

//define costants
define('MIN_TITLE_SIZE', 5);
define('MAX_TITLE_SIZE', 80);
define('MAX_DESCRIPTION_SIZE', 200);

define('IMAGE_DIR', 'images' . DIRECTORY_SEPARATOR);
define('MAX_IMAGE_SIZE', 5242880);
define('BASE_IMAGE_NAME', 'img_');
define('BASE_THUMBNAIL_NAME', 'thb_');
define('THUMBNAIL_WIDTH', 250);

define('DEFAULT_TITLE', $default_title);

define('DB_HOST', $host);
define('DB_NAME', $db_name);
define('DB_USER', $user);
define('DB_PASSWORD', $password);

define('DEVELOPER_MOD', $developer_mod);
define('ERR_MESSAGE', $message);

if ($developer_mod === 0) {
    error_reporting(0);
} else {
    error_reporting(E_ALL);
}