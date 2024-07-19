<?php
    $results = get_all_san_pham();
?>
<div style = "margin-left: 350px">
    <div class="alert alert-success" role="alert">QUẢN LÝ SẢN PHẨM</div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Tên loại</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Giá khuyến mại</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>

        <tbody class="table-group-divider">
            <?php foreach ($results as $key => $value){ ?>
                <?php $img = explode(", ", $value['anh_san_pham'])[0] ?>
                <tr>
                    <td><?php echo $value['ma_san_pham'] ?> </td>
                    <td style="width: 200px;"><?php echo $value['ten_san_pham'] ?></td>
                    <td><?php echo $value['don_gia'] ?></td>
                    <td><?php echo $value['ten_loai'] ?></td>
                    <td><div  style=' background-image: url("../media/product/<?php echo $img;?>"); width: 150px; height: 100px; background-position: center; background-size: cover;' alt="ảnh sp"></div></td>              
                <!-- <td><?php echo $value['mo_ta_tom_tat']; ?></td> -->
                <!-- <td><?php echo $value['ngay_tao'] ?></td> -->
                <td><?php echo $value['gia_khuyen_mai'] ?></td>
                <td><?php echo $value['so_luong_san_pham'] ?></td>
                <td>
                    <button type="button" class="btn btn-primary" onclick="location.href='index.php?act=update_product&editId=<?php echo $value['ma_san_pham']; ?>'">Sửa</button>
                    <!-- <button type="button" class="btn btn-primary" onclick="location.href='index.php?act=edit_san_pham&editId=<?php echo $value['ma_loai']; ?>'">Sửa</button> -->

                    <button type="button" class="btn btn-danger" onclick="
                        const result = confirm('Bạn có chắc chắn muốn xóa không?');
                        if(result){
                            location.href='index.php?act=list_products&deleteId=<?php echo $value['ma_san_pham']; ?>'
                    }">Xóa</button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="actions" style="margin-left: 10px;">
        <a href="index.php?act=product-add" type="button" class="btn btn-outline-secondary">Thêm mới</a>
    </div>
</div>