<?php

class Render
{
    static function header($title = DEFAULT_TITLE)
    {
        include_once('outfit' . DIRECTORY_SEPARATOR . 'header.php');
    }

    static function footer()
    {
        include_once('outfit' . DIRECTORY_SEPARATOR . 'footer.php');
    }

    static function menu($selected=0)
    {
        switch ($selected) {
            case 1: $select1 = "Selected"; break;
            case 2: $select2 = "Selected"; break;
        }
        include_once('outfit' . DIRECTORY_SEPARATOR . 'menu.php');
    }

    static function upload_form($token)
    {
        include_once('outfit' . DIRECTORY_SEPARATOR . 'upload_form.php');
    }

    static function category_select()
    {
        $sql = new SQL();
        $result = $sql->getAllCategories();
        echo '<select class="FormBox" name="category">';

        foreach ($result as $row) {
            echo '<option class="FormBox" value="' . $row['id_category'] . '">' . $row['name'] . '</option>
            ';
        }
        echo '</select>';
    }

    static function list_thumbnails($sort_by = 'id_photo', $order = 'DESC', $search_string = null)
    {
        include_once('outfit' . DIRECTORY_SEPARATOR . 'search_form.php');

        if (!is_null($search_string)) {
            echo 'Търсене на: <b>' . $search_string . '</b>';
        } else {
            include_once('outfit' . DIRECTORY_SEPARATOR . 'sort.php');
        }

        $sql = new SQL();
        $result = $sql->getAllTitleNamePhotos($sort_by, $order, $search_string);

        $per_column = -1;
        $thumbnail_list = '';
        foreach ($result as $row) {
            $per_column++;

            if ($per_column % 4 === 0) {
                if ($per_column !== 0) {
                    $thumbnail_list .= '</div>';
                }
                $thumbnail_list .= '<div class="RowImg">';
            }

            $thumbnail_list .= '<div class="ColumnImg">
                        <a href="view.php?id=' . $row['id_photo'] . '">
                            <img src="' . IMAGE_DIR . BASE_THUMBNAIL_NAME . $row['id_photo'] . '.' . $row['file_type'] . '"/>
                            <p class="Title">' . htmlspecialchars($row['title_name']) . '</p>
                        </a>
                  </div>
                  ';
        }
        $thumbnail_list .= '</div>';
        include_once('outfit' . DIRECTORY_SEPARATOR . 'thumbnail_view.php');

    }

    static function photo_view($id, $token)
    {
        $sql = new SQL();
        $result = $sql->getAllNameWhereId($id);
        $exists = $sql->idPhotoExists($id);
        if ($exists) {
            $next_id = 'view.php?id=' . $sql->getNextIdPhotos($id);
            $prev_id = 'view.php?id=' . $sql->getPrevIdPhotos($id);

            $img_lnk = IMAGE_DIR . BASE_IMAGE_NAME . $result['id_photo'] . '.' . $result['file_type'];
            $title_name = $result['title_name'];
            $description = $result['description'];
            if (empty($description)) {
                $description = '(Липсва)';
            }
            $date = DateTime::createFromFormat('Y-m-d', $result['date']);
            $date = $date->format('d/m/Y');
            $category_name = $result['name'];
            include_once('outfit' . DIRECTORY_SEPARATOR . 'photo_view.php');
        }
        return $exists;
    }
}