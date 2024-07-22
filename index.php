<?php
session_start();
require "model/pdo.php";
require "model/product.php";
require "model/user.php";
require "model/bill.php";
require "model/comment.php";
require "model/category.php";
require "global.php";
ob_start();

require "view/header.php";
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
// unset($_SESSION['cart']);
$user = [];
if (isset($_GET['act'])) {

    $act = $_GET['act'];

    require "view/navbar.php";

    switch ($act) {
        case "shop-details":
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                flus_luot_xem($id);
                $pro = get_product($id);
                $listBinhLuan = get_list_cmt_product($id);
                $rate_avg = (int) get_avg_rate($id);
                $so_luong_binh_luan = count_cmt($id)['so_luong'];
                require "view/shop-details.php";
            } else {
                require "view/page-404.php";
            }

            break;

        case "binhluan":
            if (isset($_POST['submit'])) {
                $ma_khach_hang = $_SESSION['user']['id'];
                $date = getdate();
                $day = $date['mday'];
                $mon = $date['mon'];
                $year = $date['year'];
                $ngay_binh_luan = ($day . "/" . $mon . '/' . $year);
                $noi_dung = $_POST['comment'];
                $ma_san_pham = $_POST['id'];
                $rate = (int)$_POST['star'];
                binh_luan_insert($ma_khach_hang, $ngay_binh_luan, $noi_dung, $ma_san_pham, $rate);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                ob_end_flush();
            }
            break;
    }
}
