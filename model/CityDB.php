<?php
namespace Model;

use Exception;
use Model\Validator;

class CityDB
{
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $sql = "SELECT cities.*, countries.name as countryName FROM cities JOIN countries ON cities.countryId = countries.id";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result == null)
        {
            throw new Exception('Không tìm thấy dữ liệu thành phố');
        } else {
            $cities = [];

            foreach ($result as $row)
            {
                $city = new City($row['name'], $row['countryId'], $row['area'], $row['population'], $row['gdp'], $row['description']);
                $city->id = $row['id'];
                $city->countryName = $row['countryName'];
                $cities[] = $city;
            }
            return $cities;
        }
    }

    public function create($city)
    {
        $validator = $this->validate($city);
        if ($validator->isValid == false)
        {
            throw new Exception($validator->message);
        } else {
            $sql = "INSERT INTO cities(`name`, `countryId`, `area`, `population`, `gdp`, `description`) VALUES (?, ?, ?, ?, ? ,?)";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $city->name);
            $statement->bindParam(2, $city->countryId);
            $statement->bindParam(3, $city->area);
            $statement->bindParam(4, $city->population);
            $statement->bindParam(5, $city->gdp);
            $statement->bindParam(6, $city->description);
            return $statement->execute();
        }
    }

    public function getById($id)
    {
        $sql = "SELECT cities.*, countries.name as countryName FROM cities JOIN countries ON cities.countryId = countries.id WHERE cities.id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->execute();
        $result = $statement->fetch();
        if ($result == null)
        {
            throw new Exception('Không tìm thấy thành phố');
        } else {
            $city = new City($result['name'], $result['countryId'], $result['area'], $result['population'], $result['gdp'], $result['description']);
            $city->id = $result['id'];
            $city->countryName = $result['countryName'];
            return $city;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM cities WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);
        return $statement->execute();
    }

    public function update($id, $city)
    {
        $validator = $this->validate($city);
        if ($validator->isValid == false)
        {
            throw new Exception($validator->message);
        } else {
            $sql = "UPDATE cities SET name = ?, countryId = ?, area = ?, population = ?, gdp = ?, description = ? WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $city->name);
            $statement->bindParam(2, $city->countryId);
            $statement->bindParam(3, $city->area);
            $statement->bindParam(4, $city->population);
            $statement->bindParam(5, $city->gdp);
            $statement->bindParam(6, $city->description);
            $statement->bindParam(7, $id);
            return $statement->execute();
        }
    }

    public function getByName($name)
    {
        $sql = "SELECT cities.*, countries.name as countryName FROM cities JOIN countries ON cities.countryId = countries.id WHERE cities.name LIKE CONCAT('%',?,'%')";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $name);
        $statement->execute();
        $result = $statement->fetchAll();
        if ($result == null)
        {
            throw new Exception('Không tìm thấy thành phố');
        } else {
            $cities = [];

            foreach ($result as $row)
            {
                $city = new City($row['name'], $row['countryId'], $row['area'], $row['population'], $row['gdp'], $row['description']);
                $city->id = $row['id'];
                $city->countryName = $row['countryName'];
                $cities[] = $city;
            }

            return $cities;
        }
    }

    public function isValidName($name)
    {
        $pattern = '/^[a-zA-ZàáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]+[ ]*[a-zA-ZàáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]*$/u';
        if ($name == '' || $name == null || !preg_match($pattern, $name))
        {
            return false;
        }
        return true;
    }

    public function validate($city)
    {
        if (!$this->isValidName($city->name))
        {
            $validator = new Validator(false, 'Tên thành phố không hợp lệ');
        } elseif (empty($city->area) || !is_numeric($city->area) || $city->area < 0) {
            $validator = new Validator(false, 'Diện tích không hợp lệ');
        } elseif (empty($city->population) || !is_numeric($city->population) || $city->population < 0) {
            $validator = new Validator(false, 'Dân số không hợp lệ');
        } elseif (empty($city->gdp) || !is_numeric($city->gdp) || $city->gdp < 0) {
            $validator = new Validator(false, 'GDP không hợp lệ');
        } elseif (empty($city->countryId)) {
            $validator = new Validator(false, 'Chưa chọn quốc gia');
        } else {
            $validator = new Validator(true, 'Dữ liệu hợp lệ');
        }
        return $validator;
    }
}