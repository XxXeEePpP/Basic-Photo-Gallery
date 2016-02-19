<?php

class Image_Upload
{
    private $file;
    private $title_name;
    private $description;
    private $category;
    private $file_type;

    function __construct($file, $title_name, $description, $category)
    {
        $this->file = $file;
        $this->title_name = $title_name;
        $this->description = $description;
        $this->category = $category;
        $this->file_type = pathinfo($file['name'], PATHINFO_EXTENSION);
    }

    function verificateData()
    {
        $verificate = true;

        if (empty($this->file['tmp_name'])) {
            echo 'Не сте избрали снимка! <br>';
            $verificate = false;
        }

        if (empty($this->title_name)) {
            echo 'Не сте въвели име на снимката! <br>';
            $verificate = false;
        }

        if (empty($this->category) || !is_numeric($this->category)) {
            echo 'Невалидна категория! <br>';
            $verificate = false;
        }

        if ($verificate === true) {
            if ($this->file_type != 'jpg' && $this->file_type != 'png' && $this->file_type != 'gif') {
                echo 'Файлът трябва да е .jpg, .png или .gif! <br>';
            }

            if ($this->file["size"] > MAX_IMAGE_SIZE) {
                echo 'Файлът е прекалено голям.';
                $verificate = false;
            }

            $title_name = trim($this->title_name);
            $description = trim($this->description);
            if (mb_strlen($title_name) < MIN_TITLE_SIZE || strlen($title_name) > MAX_TITLE_SIZE) {
                echo 'Името трябва да е между ' . MIN_TITLE_SIZE . ' и ' . MAX_TITLE_SIZE . ' символа! <br>';
                $verificate = false;
            }

            if (mb_strlen($description) > MAX_DESCRIPTION_SIZE) {
                echo 'Описанието трябва да е не повече от ' . MAX_DESCRIPTION_SIZE . 'символа! <br>';
                $verificate = false;
            }
            $sql = new SQL();

            if ($sql->categoryExists($this->category) == 0) {
                echo 'Невалидна категория!';
                $verificate = false;
            }

        }
        return $verificate;
    }

    function saveData()
    {
        $correct = true;
        $sql = new SQL();
        $id = $sql->saveToPhotos($this->file_type, $this->title_name, $this->description, $this->category);
        if ($id !== false) {
            if (!$this->saveImage($id)) {
                $correct = false;
            }
            $this->saveThumbnail($id);
        } else {
            $correct = false;
        }
        return $correct;
    }

    private function saveImage($id)
    {
        $uploaded = move_uploaded_file($this->file['tmp_name'],
            IMAGE_DIR . BASE_IMAGE_NAME . $id . '.' . $this->file_type);
        return $uploaded;
    }

    private function saveThumbnail($id)
    {
        include_once('classes' . DIRECTORY_SEPARATOR . 'external' . DIRECTORY_SEPARATOR . 'simpleimage.php');
        $savedImage = IMAGE_DIR . BASE_IMAGE_NAME . $id . '.' . $this->file_type;
        $img = new SimpleImage();
        $img->load($savedImage);
        $img->load($savedImage);
        $img->resizeToWidth(THUMBNAIL_WIDTH);
        $img->save(IMAGE_DIR . BASE_THUMBNAIL_NAME . $id . '.' . $this->file_type);
    }
}