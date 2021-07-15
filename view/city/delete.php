<div class="mt-3"></div>
<h2>Xóa thành phố</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $city->id ?>"/>
    <p>Bạn có chắc chắn muốn xóa thành phố: <?php echo $city->name ?> ?</p>
    <input type="submit" value="Xóa" class="btn btn-danger">
    <a class="btn btn-default" href="./index.php?view=city">Thoát</a>
</form>
