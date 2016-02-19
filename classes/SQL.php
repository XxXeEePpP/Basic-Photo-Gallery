<?php

class SQL
{
    private $connection;

    function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                DB_USER, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function errorMessage($e)
    {
        if (DEVELOPER_MOD) {
            echo $e->getMessage() . '<br />';
        } else {
            echo ERR_MESSAGE;
        }
    }

    function getAllCategories()
    {
        try {
            $sql = ('SELECT id_category, name FROM categories');
            $execute = $this->connection->query($sql);
            return $execute->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errorMessage($e);
            return false;
        }
    }

    function categoryExists($category_id)
    {
        try {
            $sql = ('SELECT EXISTS(SELECT * FROM categories where id_category = :category_id) as valid');
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['valid'];
        } catch (PDOException $e) {
            $this->errorMessage($e);
            return false;
        }
    }

    function idPhotoExists($id)
    {
        try {
            $sql = ('SELECT EXISTS(SELECT * FROM photos where id_photo = :id) as valid');
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['valid'];
        } catch (PDOException $e) {
            $this->errorMessage($e);
            return false;
        }
    }

    function getAllTitleNamePhotos($sort_by, $order, $search_string = null)
    {
        try {
            $sql = ('SELECT id_photo, file_type, title_name FROM photos');
            if (!is_null($search_string)) {
                $sql .= " WHERE title_name LIKE :str1 OR title_name like :str2";
            }
            $sql .= ' ORDER BY ' . $sort_by . ' ' . $order;

            $stmt = $this->connection->prepare($sql);

            if (!is_null($search_string)) {
                $search_string1 = $search_string . '%';
                $stmt->bindParam(':str1', $search_string1, PDO::PARAM_STR);
                $search_string2 = '% ' . $search_string . '%';
                $stmt->bindParam(':str2', $search_string2, PDO::PARAM_STR);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errorMessage($e);
            return false;
        }
    }


    function getAllNameWhereId($id)
    {
        try {
            $sql = ('SELECT id_photo, file_type, title_name, description, cast(date as date) as date, categories.name
                        FROM photos
                        LEFT JOIN categories on categories.id_category = photos.id_category
                        WHERE id_photo = :id
                        LIMIT 0,1');
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errorMessage($e);
            return false;
        }
    }

    function getNextIdPhotos($id)
    {
        return $this->getBetweenIdPhotos($id, 'next');
    }

    function getPrevIdPhotos($id)
    {
        return $this->getBetweenIdPhotos($id, 'prev');
    }

    private function getBetweenIdPhotos($id, $pos)
    {
        try {
            if ($pos === 'next') {
                $sign = '<';
                $order = 'DESC';
            } else {
                $sign = '>';
                $order = 'ASC';
            }
            $sql = ('SELECT * FROM photos
                      WHERE id_photo' . $sign . $id . ' ORDER BY id_photo ' . $order . ' limit 0,1');
            $execute = $this->connection->query($sql);
            $result = $execute->fetch(PDO::FETCH_ASSOC);
            if (empty($result['id_photo'])) {
                $result['id_photo'] = $id;
            }
            return $result['id_photo'];
        } catch (PDOException $e) {
            $this->errorMessage($e);
            return false;
        }
    }

    function saveToPhotos($file_type, $title_name, $description, $category_id)
    {
        try {
            $sql = ('INSERT INTO photos (file_type, title_name, description, date, id_category)
                        values (:file_type, :title_name, :description, NOW() ,:category_id)');
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':file_type', $file_type, PDO::PARAM_STR);
            $stmt->bindParam(':title_name', $title_name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $result = $stmt->execute();
            if ($result === true) {
                return $this->connection->lastInsertId();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $this->errorMessage($e);
            return false;
        }
    }

    function deleteByIdPhoto($id)
    {
        try {
            $sql = ('DELETE FROM photos WHERE id_photo=:id');
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            $this->errorMessage($e);
            return false;
        }
    }
}