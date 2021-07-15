<div class="mt-3 d-flex">
    <h2>Thành phố <?php echo $city->name ?></h2>
    <a href="index.php?view=city" class="btn btn-info ml-auto">Xem danh sách thành phố</a>
</div>
<div class="mt-3">
    <p>Tên: <?php echo $city->name ?></p>
    <p>Quốc gia: <?php echo $city->countryName ?></p>
    <p>Diện tích: <?php echo $city->area ?></p>
    <p>Dân số: <?php echo $city->population ?></p>
    <p>GDP: <?php echo $city->gdp ?></p>
    <p>Giới thiệu: <?php echo $city->description ?></p>
</div>
<div class="d-flex justify-content-end">
    <a href="./index.php?view=city&page=edit&id=<?php echo $city->id ?>" class="btn btn-info mr-2">Chỉnh sửa</a>
    <a href="./index.php?view=city&page=delete&id=<?php echo $city->id ?>" class="btn btn-danger">Xóa</a>
</div>