<?php
session_start();

require "../model/pdo.php";
require "../model/product.php";
require "../model/category.php";
require "../model/user.php";
require "";
require "../model/comment.php";

ob_start();
if (!isset($_SESSION['user_admin'])) {
    include "login/login.php";
} else {
}
