<div class="mt-3"></div>
<a href="./index.php?view=city"><< Danh sách thành phố</a>
<h2>Chỉnh sửa thành phố <?php echo $city->name ?></h2>
<?php if (isset($message)): ?>
    <div class="alert alert-danger" role="alert"><?php echo $message ?></div>
<?php endif; ?>
<div class="mt-3">
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $city->id ?>">
        <div class="form-group">
            <label>Tên:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $city->name ?>"  required/>
        </div>
        <div class="form-group">
            <label>Quốc gia:</label>
            <select name="countryId" class="form-control">
                <?php
                use \Controller\CountryController;
                $countryController = new CountryController();
                $countries = $countryController->index();
                foreach ($countries as $country):
                ?>
                    <option value="<?php echo $country->id ?>" <?php if($city->countryId == $country->id){echo "selected";} ?>>
                        <?php echo $country->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Diện tích:</label>
            <input type="text" class="form-control" name="area" value="<?php echo $city->area ?>" required/>
        </div>
        <div class="form-group">
            <label>Dân số:</label>
            <input type="text" class="form-control" name="population" value="<?php echo $city->population ?>" required/>
        </div>
        <div class="form-group">
            <label>GDP:</label>
            <input type="text" class="form-control" name="gdp" value="<?php echo $city->gdp ?>" required/>
        </div>
        <div class="form-group">
            <label>Giới thiệu:</label>
            <textarea class="form-control" name="description" required><?php echo $city->description ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="index.php?view=city" class="btn btn-default">Thoát</a>
    </form>
</div>
