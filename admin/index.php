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

            case 'product-add':
                $loai_sp = get_all_loai_sp();
                if (isset($_POST["them_product"])) {
                }
                include 'produc/add.php';
                break;

            case "update_product":
                $loai_sp = get_all_loai_sp();

                $error = [];
                if (isset($_POST["edit_san_pham"])) {
                    $ma_sp = $_POST["ma_sp"];
                    $ten_san_pham = $_POST["ten_san_pham"];
                    $don_gia = $_POST["don_gia"];
                    $ma_loai = $_POST["loai_sp"];
                    $anh_san_pham = $_FILES['anh_san_phama']['name'];
                    $mo_ta_tom_tat = $_POST["mo_ta_chi_tiet"];
                    $ngay_tao = $_POST["ngay_tao"];
                    $gia_khuyen_mai = $_POST["gia_khuyen_mai"];
                    $so_luong = $_POST["so_luong"];

                    if (isset($_FILES["anh_san_phâm"])) {
                        $targer_dir = "../media/product";
                        $nameImg = $_FILES["anh_san_phama"]["name"];
                        $targer_file = $targer_dir . $nameImg;
                        $maxFileSize = 800000;
                        $allowUpload = true;
                        $allowTypes = ["jpg", "png", "jpeg", "gif"];
                        $imageFileType = pathinfo($targer_file, PATHINFO_EXTENSION);

                        if ($_FILES["anh_san_pham"]["size"] > $maxFileSize) {
                            $error["img_size"] = "Khong duoc upload anh > " . $maxFileSize . "(Byte)";
                            $allowUpload = false;
                        }

                        if (!in_array($imageFileType, $allowTypes)) {
                            $error["img_type"] = "Chi duoc upload cac dinh dang jpg,png,jbeg,gif";
                            $allowUpload = false;
                        }

                        if ($allowUpload == true) {
                            move_uploaded_file($_FILES["anh_san_pham"]["tmp_name"], $target_file);
                        }
                        edit_san_pham($ma_san_pham, $ten_san_pham, $don_gia, $anh_san_pham, $mo_ta_tom_tat, $ngay_tao, $gia_khuyen_mai, $so_luong);

                        $message = "update thành công";
                    }
                }

                include 'product/edit.php';
                break;
            case 'list_products':
                if (isset($_GET['deleteId'])) {
                    $id = $_GET['deleteId'];
                    delete_san_pham($id);
                }
                $results = get_all_san_pham();
                include 'product/list.php';
                break;

            default:
                include "view/home.php";
        }
        include "view/footer.php";
    } else {
        include "view/navbar.php";

        include "view/home.php";
        include "view/footer.php";
    }
}
