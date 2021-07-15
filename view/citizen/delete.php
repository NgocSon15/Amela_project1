<div class="mt-3"></div>
<h2>Xóa người dân</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $citizen->id ?>"/>
    <p>Bạn có chắc chắn muốn xóa người dân: <?php echo $citizen->name ?> ?</p>
    <input type="submit" value="Xóa" class="btn btn-danger">
    <a class="btn btn-default" href="./index.php?view=citizen">Thoát</a>
</form>