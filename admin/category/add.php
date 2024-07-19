<?php
if (isset($_POST['btn-add'])) {
    $ten_loai = $_POST['ten_loai'];
    add_loai_sp($ten_loai);
    $message = "Thêm thành công";
}

?>

<div style="margin-left: 350px;" class="container">
    <div class="alert alert-success" role="alert">
        <h2>QUẢN LÝ ĐƠN HÀNG</h2>
    </div>
    <form class="form" action="index.php?&act=btn-add" method="POST">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label fw-bold">Mã loại</label>
            <input type="text" value="Auto number" class="form-control" id="formGroupExampleInput" disabled>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label fw-bold">Tên loại</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="ten_loai" placeholder="Enter tên loại">
        </div>
        <button type="submit" class="btn btn-outline-secondary" name="btn-add">Thêm mới</button>
        <button type="button" class="btn btn-outline-primary" onclick="window.location.reload()">Nhập lại</button>
        <a href="index.php?act=list_category" class="btn btn-outline-secondary">Danh sách</a>
    </form>
    <br>
    <?php echo isset($message) ? "div class='alert alert-success' role='alert'>" . $message . "</div>" : ""; ?>
</div>