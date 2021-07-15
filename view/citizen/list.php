<div class="mt-3"></div>
<h2><a class="text-dark" href="./index.php?view=citizen">Danh sách dân cư</a></h2>
<div class="d-flex">
    <form method="post">
        <div class="d-flex">
            <input type="text" class="form-control mr-2" name="name" placeholder="Tên người dân cần tìm">
            <input type="submit" class="btn btn-primary" value="Tìm kiếm">
        </div>
    </form>
    <a href="./index.php?view=citizen&page=add" class="btn btn-primary ml-auto">Thêm người dân</a>
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
        <th class="text-center">Tên</th>
        <th class="text-center">Thành phố</th>
        <th></th>
        </thead>
        <tbody>
        <?php foreach($citizens as $key => $citizen): ?>
            <tr>
                <td class="text-center"><?php echo ++$key ?></td>
                <td class="text-center"><a href="./index.php?view=citizen&page=info&id=<?php echo $citizen->id ?>"><?php echo $citizen->name ?></a></td>
                <td class="text-center"><?php echo $citizen->cityName ?></td>
                <td class="text-center"><a href="./index.php?view=citizen&page=edit&id=<?php echo $citizen->id ?>">Sửa</a> | <a href="./index.php?view=citizen&page=delete&id=<?php echo $citizen->id ?>">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
