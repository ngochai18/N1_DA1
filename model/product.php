<?php
    function get_listproduct($st, $step) {
        $sql = "SELECT * FROM san_pham ORDER BY san_pham.ma_san_pham DESC LIMIT $st, $step";
        $listsanpham = pdo_query($sql);
        return $listsanpham;
    }

    function get_product($id) {
        $sql = "SELECT * FROM san_pham INNER JOIN loai_sp ON loai_sp.ma_loai = san_pham.ma_loai WHERE san_pham.ma_san_pham = $id";
        $pdo = pdo_query_one($sql);
        return $pdo;
    }
?>