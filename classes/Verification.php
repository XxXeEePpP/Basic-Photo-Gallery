<?php


class Verification
{
    static function verify_string($string)
    {
        $string = trim($string);
        $correct = true;
        if (mb_strlen($string) < 3) {
            echo 'Моля въведете поне 3 символа! <ve>';
            $correct = false;
        }

        if (mb_strlen($string) > MAX_TITLE_SIZE) {
            echo 'Въведените символи трябва не трябва да са повече от ' . MAX_TITLE_SIZE . ' символа!';
            $correct = false;
        }

        if ($correct) {
            $correct = $string;
        }

        return $correct;
    }

    static function verify_sort($sort_by, $order)
    {
        $correct = true;
        if ($sort_by != 'title_name' && $sort_by != 'date') {
            $correct = false;
        }

        if ($order != 'desc' && $order != 'asc') {
            $correct = false;
        }

        return $correct;
    }

    static function set_token()
    {
        $token = base64_encode(uniqid(rand(), true));
        $_SESSION['token'] = $token;
        return $token;
    }

    static function unset_token()
    {
        unset($_SESSION['token']);
    }

    static function verify_token($token)
    {
        return $_SESSION['token'] === $token;
    }

    static function delete_by_id($id)
    {
        $sql = new SQL();
        $result = $sql->getAllNameWhereId($id);
        $fileImage = IMAGE_DIR . BASE_IMAGE_NAME . $result['id_photo'] . '.' . $result['file_type'];
        $fileThumbnail = IMAGE_DIR . BASE_THUMBNAIL_NAME . $result['id_photo'] . '.' . $result['file_type'];
        if ($sql->idPhotoExists($id)) {
            $result = $sql->deleteByIdPhoto($id);
            if (file_exists($fileImage)) {
                unlink($fileImage);
            }
            if (file_exists($fileThumbnail)) {
                unlink($fileThumbnail);
            }
        } else {
            $result = false;
        }
        return $result;
    }


}