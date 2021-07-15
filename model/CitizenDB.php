<?php
namespace Model;

use Exception;
use Model\Validator;

class CitizenDB
{
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $sql = "SELECT citizens.*, cities.name as cityName FROM cities JOIN citizens ON citizens.cityId = cities.id";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result == null)
        {
            throw new Exception('Không tìm thấy dữ liệu người dân');
        } else {
            $citizens = [];

            foreach ($result as $row)
            {
                $citizen = new Citizen($row['name'], $row['age'], $row['gender'], $row['cityId'], $row['imageUrl']);
                $citizen->id = $row['id'];
                $citizen->cityName = $row['cityName'];
                $citizens[] = $citizen;
            }
            return $citizens;
        }
    }

    public function create($citizen)
    {
        $validator = $this->validate($citizen);
        if ($validator->isValid == false)
        {
            throw new Exception($validator->message);
        } else {
            $sql = "INSERT INTO citizens(`name`, `age`, `gender`, `cityId`, `imageUrl`) VALUES (?, ?, ?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $citizen->name);
            $statement->bindParam(2, $citizen->age);
            $statement->bindParam(3, $citizen->gender);
            $statement->bindParam(4, $citizen->cityId);
            $statement->bindParam(5, $citizen->imageUrl);
            return $statement->execute();
        }
    }

    public function getById($id)
    {
        $sql = "SELECT citizens.*, cities.name as cityName FROM citizens JOIN cities ON citizens.cityId = cities.id WHERE citizens.id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->execute();
        $result = $statement->fetch();
        if ($result == null)
        {
            throw new Exception('Không tìm thấy người dân');
        } else {
            $citizen = new citizen($result['name'], $result['age'], $result['gender'], $result['cityId'], $result['imageUrl']);
            $citizen->id = $result['id'];
            $citizen->cityName = $result['cityName'];
            return $citizen;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM citizens WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);
        return $statement->execute();
    }

    public function update($id, $citizen)
    {
        $validator = $this->validate($citizen);
        if ($validator->isValid == false)
        {
            throw new Exception($validator->message);
        } else {
            $sql = "UPDATE citizens SET name = ?, age = ?, gender = ?, cityId = ?, imageUrl = ? WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $citizen->name);
            $statement->bindParam(2, $citizen->age);
            $statement->bindParam(3, $citizen->gender);
            $statement->bindParam(4, $citizen->cityId);
            $statement->bindParam(5, $citizen->imageUrl);
            $statement->bindParam(6, $id);
            return $statement->execute();
        }
    }

    public function getByName($name)
    {
        $sql = "SELECT citizens.*, cities.name as cityName FROM citizens JOIN cities ON citizens.cityId = cities.id WHERE citizens.name LIKE CONCAT('%',?,'%')";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $name);
        $statement->execute();
        $result = $statement->fetchAll();
        if ($result == null)
        {
            throw new Exception('Không tìm thấy người dân');
        } else {
            $citizens = [];

            foreach ($result as $row)
            {
                $citizen = new citizen($row['name'], $row['age'], $row['gender'], $row['cityId'], $row['imageUrl']);
                $citizen->id = $row['id'];
                $citizen->cityName = $row['cityName'];
                $citizens[] = $citizen;
            }

            return $citizens;
        }
    }

    public function isValidName($name)
    {
        $pattern = '/^[A-ZÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]+[ a-zA-ZàáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]*[a-zA-ZàáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]*$/u';
        if ($name == '' || $name == null || !preg_match($pattern, $name))
        {
            return false;
        }
        return true;
    }

    public function validate($citizen)
    {
        if (!$this->isValidName($citizen->name))
        {
            $validator = new Validator(false, 'Tên người dân không hợp lệ');
        } elseif (empty($citizen->age) || !is_numeric($citizen->age) || $citizen->age < 0) {
            $validator = new Validator(false, 'Tuổi không hợp lệ');
        } elseif (empty($citizen->gender)) {
            $validator = new Validator(false, 'Chưa chọn giới tính');
        } elseif (empty($citizen->cityId)) {
            $validator = new Validator(false, 'Chưa chọn thành phố');
        } else {
            $validator = new Validator(true, 'Dữ liệu hợp lệ');
        }
        return $validator;
    }

    public function getImageUrl()
    {
        if($_FILES['uploadFile']['name'] == null)
        {
            throw new Exception( 'Chưa chọn file ảnh');
        } elseif ($_FILES['uploadFile']['type'] != "image/jpeg" && $_FILES['uploadFile']['type'] != "image/png" && $_FILES['uploadFile']['type'] != "image/jpg") {
            throw new Exception( 'File bạn chọn hệ thống không hỗ trợ, vui lòng chọn lại');
        } elseif ($_FILES['uploadFile']['size'] > 5242880) {
            throw new Exception('File upload không được quá 5MB');
        } else {
            $target_dir = './images/';
            $target_file = $target_dir.basename($_FILES['uploadFile']['name']);

            move_uploaded_file($_FILES['uploadFile']['tmp_name'], $target_file);

            return $target_file;
        }
    }

//    public function validateImage()
//    {
//        if($_FILES['uploadFile']['name'] == null)
//        {
//            $validator = new Validator(false, 'Chưa chọn file ảnh');
//        } elseif ($_FILES['uploadFile']['type'] != "image/jpeg" && $_FILES['uploadFile']['type'] != "image/png" && $_FILES['uploadFile']['type'] != "image/jpg") {
//            $validator = new Validator(false, 'File bạn chọn hệ thống không hỗ trợ, vui lòng chọn lại');
//        } elseif ($_FILES['size'] > 5242880) {
//            $validator = new Validator(false, 'File upload không được quá 5MB');
//        } else {
//            $validator = new Validator(true, 'File hợp lệ');
//        }
//        return $validator;
//    }
}