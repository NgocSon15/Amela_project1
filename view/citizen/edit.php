<div class="mt-3"></div>
<a href="./index.php?view=citizen"><< Danh sách dân cư</a>
<h2>Sửa thông tin người dân <?php echo $citizen->name ?>:</h2>
<?php if (isset($message)): ?>
    <div class="alert alert-danger" role="alert"><?php echo $message ?></div>
<?php endif; ?>
<div class="mt-3">
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $citizen->id ?>">
        <div class="form-group">
            <label>Tên:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên người dân"
                   value="<?php echo $citizen->name ?>" required/>
        </div>
        <div class="form-group">
            <label>Tuổi:</label>
            <input type="text" class="form-control" name="age" placeholder="Nhập tuổi"
                   value="<?php echo $citizen->age ?>" required/>
        </div>
        <div class="form-group">
            <label>Giới tính:</label>
            <select name="gender" class="form-control">
                <option value="nam"
                    <?php
                        if ($citizen->gender == 'nam')
                        {
                            echo 'selected';
                        }
                    ?>
                >
                    Nam
                </option>
                <option value="nữ"
                    <?php
                        if ($citizen->gender == 'nữ')
                        {
                            echo 'selected';
                        }
                    ?>
                >
                    Nữ
                </option>
            </select>
        </div>
        <div class="form-group">
            <label>Thành phố:</label>
            <select name="cityId" class="form-control">
                <?php
                use \Controller\CityController;
                $cityController = new CityController();
                $cities = $cityController->getAll();
                foreach ($cities as $city):
                    ?>
                    <option value="<?php echo $city->id ?>"
                        <?php
                            if ($citizen->cityId == $city->id)
                            {
                                echo 'selected';
                            }
                        ?>
                    >
                        <?php echo $city->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Ảnh:</label>
            <br>
            <img src="<?php echo $citizen->imageUrl ?>" style="max-width: 100px; max-height: 200px">
            <br>
            <input type="file" name="uploadFile">
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="./index.php?view=citizen" class="btn btn-secondary">Thoát</a>
    </form>
</div>
