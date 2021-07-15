<div class="mt-3"></div>
<a href="./index.php?view=city"><< Danh sách thành phố</a>
<h2>Thêm thành phố:</h2>
<?php if (isset($message)): ?>
    <div class="alert alert-danger" role="alert"><?php echo $message ?></div>
<?php endif; ?>
<div class="mt-3">
    <form method="post">
        <div class="form-group">
            <label>Tên:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên thành phố"
                   value="<?php if(isset($city)) {echo $city->name;} ?>" required/>
        </div>
        <div class="form-group">
            <label>Quốc gia:</label>
            <select name="countryId" class="form-control">
                <option value="" hidden selected>-- Lựa chọn quốc gia --</option>
            <?php
                use \Controller\CountryController;
                $countryController = new CountryController();
                $countries = $countryController->index();
                foreach ($countries as $country):
            ?>
                <option value="<?php echo $country->id ?>"
                    <?php
                        if(isset($city))
                        {
                            if ($city->countryId == $country->id)
                            {
                                echo 'selected';
                            }
                        }
                    ?>
                >
                    <?php echo $country->name ?>
                </option>
            <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Diện tích:</label>
            <input type="text" class="form-control" name="area" placeholder="Nhập diện tích"
                   value="<?php if(isset($city)) {echo $city->area;} ?>" required/>
        </div>
        <div class="form-group">
            <label>Dân số:</label>
            <input type="text" class="form-control" name="population" placeholder="Nhập dân số"
                   value="<?php if(isset($city)) {echo $city->population;} ?>" required/>
        </div>
        <div class="form-group">
            <label>GDP:</label>
            <input type="text" class="form-control" name="gdp" placeholder="Nhập gdp"
                   value="<?php if(isset($city)) {echo $city->gdp;} ?>" required/>
        </div>
        <div class="form-group">
            <label>Giới thiệu:</label>
            <textarea class="form-control" name="description" placeholder="Nhập mô tả" required><?php if(isset($city)) {echo $city->description;} ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="./index.php?view=city" class="btn btn-secondary">Thoát</a>
    </form>
</div>

