<?php
session_start();

require "../model/pdo.php";
require "../model/product.php";
require "../model/category.php";
require "../model/user.php";
require "../global.php";
require "../model/comment.php";

ob_start();
if (!isset($_SESSION['user_admin'])) {
    include "login/login.php";
} else {
    include "view/header.php";

    if (isset($_GET['act'])) {

        $act = $_GET['act'];
        include "view/navbar.php";
        switch ($act) {

            case 'logout_admin':
                unset($_SESSION['user_admin']);
                header('location: index.php');
                ob_end_flush();
                break;

            case 'btn-add':
                if (isset($_POST['btn-add']) && ($_POST['btn-add'])) {
                    $ten_loai = $_POST['ten_loai'];
                    add_loai_sp($ten_loai);
                }
                include 'category/add.php';
                break;

            case 'btn-edit':
                if (isset($_GET['editId'])) {
                    $id = $_GET['editId'];
                    $row = get_one_loai_sp($id);
                }
                $categories = get_all_loai_sp();
                include "category/edit.php";
                break;

            case 'list_category':
                if (isset($_GET['deleteId'])) {
                    $id = $_GET['deleteId'];
                    delete_loai_sp($id);
                }
                $results = get_all_loai_sp();
                include 'category/list.php';
                break;
        }
    }
}
