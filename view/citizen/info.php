<div class="mt-3 d-flex">
    <h2>Người dân <?php echo $citizen->name ?></h2>
    <a href="index.php?view=citizen" class="btn btn-info ml-auto">Xem danh sách người dân</a>
</div>
<div class="mt-3">
    <p>Tên: <?php echo $citizen->name ?></p>
    <p>Tuổi: <?php echo $citizen->age ?></p>
    <p>Giới tính: <?php echo $citizen->gender ?></p>
    <p>Thành phố: <?php echo $citizen->cityName ?></p>
    <p>Ảnh:</p>
    <img src="<?php echo $citizen->imageUrl ?>" style="max-height: 200px; max-width: 100px">
</div>
<div class="d-flex justify-content-end">
    <a href="./index.php?view=citizen&page=edit&id=<?php echo $citizen->id ?>" class="btn btn-info mr-2">Chỉnh sửa</a>
    <a href="./index.php?view=citizen&page=delete&id=<?php echo $citizen->id ?>" class="btn btn-danger">Xóa</a>
</div>
