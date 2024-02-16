<?php

namespace App\Models;

class Category extends BaseModel
{
    public function getAllCate()
    {
        $sql = "SELECT * FROM category";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function insertCate($title)
    {
        $sql = "INSERT INTO category(`title`) VALUES(?)";
        $this->setQuery($sql);
        $this->execute([$title]);
    }

    public function getDetailCate($id)
    {
        $sql = "SELECT * FROM category WHERE id=$id";
        $this->setQuery($sql);
        return $this->loadRow();
    }

    public function updateCate($title, $id = '')
    {
        if (!empty($id)) {
            $sql = "UPDATE category SET `title`='$title' WHERE `id`='$id'";
        } else {
            $sql = "UPDATE category SET `title`='$title'";
        }

        $this->setQuery($sql);
        $this->execute();
    }

    public function deleteCate($id = '')
    {
        if (!empty($id)) {
            $sql = "DELETE FROM `category` WHERE id=$id";
        } else {
            $sql = "DELETE FROM `category`";
        }

        $this->setQuery($sql);
        $this->execute();
    }

    public function checkForeignKey($id)
    {
        $sql = "SELECT * FROM product WHERE cate_id=$id";
        $this->setQuery($sql);
        return $this->loadRow();
    }
}