<?php

namespace App\Controllers;

use App\Models\Category;


class CategoryController extends BaseController
{
    private $category;
    public function __construct()
    {
        $this->category = new Category();
    }
    public function index()
    {
        $data = $this->category->getAllCate();

        // check notification website
        if (!empty($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
        } else {
            $msg = null;
        }

        if (!empty($_SESSION['msg_type'])) {
            $msg_type = $_SESSION['msg_type'];
        } else {
            $msg_type = null;
        }

        session_destroy();
        // end check notification website

        return $this->render('category/list.blade.php', compact('data', 'msg', 'msg_type'));
    }

    public function add()
    {
        // check notification website
        if (!empty($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
        } else {
            $msg = null;
        }

        if (!empty($_SESSION['msg_type'])) {
            $msg_type = $_SESSION['msg_type'];
        } else {
            $msg_type = null;
        }

        if (!empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
        } else {
            $errors = null;
        }

        if (!empty($_SESSION['old'])) {
            $old = $_SESSION['old'];
        } else {
            $old = null;
        }
        // end check notification website

        session_destroy();
        return $this->render('category/add.blade.php', compact('msg', 'msg_type', 'errors', 'old'));
    }

    public function post_add()
    {
        $errors = [];

        if (empty(trim($_POST['title']))) {
            $errors['title'] = 'Tiêu đề danh mục không được để trống';
        } else {
            if (strlen(trim($_POST['title'])) < 6) {
                $errors['title'] = 'Tiêu đề danh mục không được nhỏ hơn 6 ký tự';
            }
        }

        if (empty($errors)) {
            // khong co loi xay ra
            $title = $_POST['title'];

            $this->category->insertCate($title);

            $_SESSION['msg'] = 'Thêm danh mục thành công';
            $_SESSION['msg_type'] = 'success';
        } else {
            $_SESSION['msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại';
            $_SESSION['msg_type'] = 'danger';
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $_POST;
        }

        header("Location: " . BASE_URL . 'add-category');
    }

    public function edit($id)
    {
        $cateDetail = $this->category->getDetailCate($id);
        if (empty($cateDetail)) {
            $_SESSION['msg'] = 'Liên kết không tồn tại hoặc đã hết hạn';
            $_SESSION['msg_type'] = 'danger';
            header("Location: " . BASE_URL . 'list-category');
        }
        // check notification website
        if (!empty($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
        } else {
            $msg = null;
        }

        if (!empty($_SESSION['msg_type'])) {
            $msg_type = $_SESSION['msg_type'];
        } else {
            $msg_type = null;
        }

        if (!empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
        } else {
            $errors = null;
        }

        if (!empty($_SESSION['old'])) {
            $old = $_SESSION['old'];
        } else {
            $old = null;
        }

        session_destroy();
        // end check notification website

        return $this->render('category/edit.blade.php', compact('cateDetail', 'msg', 'msg_type', 'errors', 'old'));
    }

    public function post_edit($id)
    {
        $errors = [];

        if (empty(trim($_POST['title']))) {
            $errors['title'] = 'Tiêu đề danh mục không được để trống';
        } else {
            if (strlen(trim($_POST['title'])) < 6) {
                $errors['title'] = 'Tiêu đề danh mục không được nhỏ hơn 6 ký tự';
            }
        }

        if (empty($errors)) {
            // khong co loi xay ra
            $title = $_POST['title'];

            $this->category->updateCate($title, $id);

            $_SESSION['msg'] = 'Cập nhật danh mục thành công';
            $_SESSION['msg_type'] = 'success';
        } else {
            $_SESSION['msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại';
            $_SESSION['msg_type'] = 'danger';
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $_POST;
        }

        header("Location: " . BASE_URL . 'edit-category/' . $id);
    }

    public function delete($id)
    {
        $checkForeignKey = $this->category->checkForeignKey($id);
        if (!empty($checkForeignKey)) {
            $_SESSION['msg'] = 'Danh mục bài viết hiện còn bài viết, không thể xóa!';
            $_SESSION['msg_type'] = 'danger';
        } else {
            $this->category->deleteCate($id);

            $_SESSION['msg'] = 'Xóa danh mục bài viết thành công!';
            $_SESSION['msg_type'] = 'success';
        }
        header("Location: " . BASE_URL . 'list-category/');
    }
}