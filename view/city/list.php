<div class="mt-3"></div>
<h2><a class="text-dark" href="./index.php?view=city">Danh sách thành phố</a></h2>
<div class="d-flex">
    <form method="post">
        <div class="d-flex">
            <input type="text" class="form-control mr-2" name="name" placeholder="Tên thành phố cần tìm">
            <input type="submit" class="btn btn-primary" value="Tìm kiếm">
        </div>
    </form>
    <a href="./index.php?view=city&page=add" class="btn btn-primary ml-auto">Thêm thành phố</a>
</div>
<?php
    if (isset($_REQUEST['message'])):
?>
<div class="mt-3 alert alert-success" role="alert"><?php echo $_REQUEST['message'] ?></div>
<?php endif; ?>
<div class="mt-3">
    <table class="table table-striped">
        <thead class="thead-dark">
            <th class="text-center">STT</th>
            <th class="text-center">Thành phố</th>
            <th class="text-center">Quốc gia</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($cities as $key => $city): ?>
                <tr>
                    <td class="text-center"><?php echo ++$key ?></td>
                    <td class="text-center"><a href="./index.php?view=city&page=info&id=<?php echo $city->id ?>"><?php echo $city->name ?></a></td>
                    <td class="text-center"><?php echo $city->countryName ?></td>
                    <td class="text-center"><a href="./index.php?view=city&page=edit&id=<?php echo $city->id ?>">Sửa</a> | <a href="./index.php?view=city&page=delete&id=<?php echo $city->id ?>">Xóa</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


