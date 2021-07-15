<?php
namespace Controller;

use Model\City;
use Model\CityDB;
use Model\DBConnection;
use Exception;

class CityController
{
    public $cityDB;

    public function __construct()
    {
        $connection = new DBConnection("mysql:host=localhost;dbname=city_manager", "root", "");
        $this->cityDB = new CityDB($connection->connect());
    }

    public function index()
    {
        try {
            if($_SERVER['REQUEST_METHOD'] === 'GET')
            {
                $cities = $this->cityDB->getAll();
                include 'view/city/list.php';
            } else {
                $name = trim($_POST['name']);
                $cities = $this->cityDB->getByName($name);
                include 'view/city/list.php';
            }
        } catch (Exception $e) {
            $cities = [];
            include 'view/city/list.php';
            echo $e->getMessage();
        }
    }

    public function getAll()
    {
        $cities = $this->cityDB->getAll();
        return $cities;
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            include 'view/city/add.php';
        } else {
            $name = trim($_POST['name']);
            $countryId = $_POST['countryId'];
            $area = $_POST['area'];
            $population = $_POST['population'];
            $gdp = $_POST['gdp'];
            $description = $_POST['description'];
            $city = new City($name, $countryId, $area, $population, $gdp, $description);
            try {
                $this->cityDB->create($city);
                $message = "Đã thêm thành phố mới";
                header('Location: index.php?view=city&message=' .$message);
            } catch (Exception $e) {
                $message = $e->getMessage();
                include 'view/city/add.php';
            }
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            try {
                $id = $_GET['id'];
                $city = $this->cityDB->getById($id);
                include 'view/city/delete.php';
            } catch (Exception $e) {
                echo '<h2>404 Error: ' .$e->getMessage(). '</h2>';
                echo '<a href="./index.php?view=city"><< Danh sách thành phố</a>';
            }
        } else {
            $id = $_POST['id'];
            $this->cityDB->delete($id);
            $message = 'Xóa thành phố thành công';
            header('Location: index.php?view=city&message=' .$message);
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            try {
                $id = $_GET['id'];
                $city = $this->cityDB->getById($id);
                include 'view/city/edit.php';
            } catch (Exception $e) {
                echo '<h2>404 Error: ' .$e->getMessage(). '</h2>';
                echo '<a href="./index.php?view=city"><< Danh sách thành phố</a>';
            }
        } else {
            try {
                $id = $_POST['id'];
                $city = new City(trim($_POST['name']), $_POST['countryId'], $_POST['area'], $_POST['population'], $_POST['gdp'], $_POST['description']);
                $this->cityDB->update($id, $city);
                $message = 'Sửa thông tin thành phố thành công';
                header('Location: index.php?view=city&message=' .$message);
            } catch (Exception $e) {
                $message = $e->getMessage();
                include 'view/city/edit.php';
            }
        }
    }

    public function info()
    {
        try {
            $id = $_GET['id'];
            $city = $this->cityDB->getById($id);
            include 'view/city/info.php';
        } catch (Exception $e) {
            echo '<h2>404 Error: ' .$e->getMessage(). '</h2>';
            echo '<a href="./index.php?view=city"><< Danh sách thành phố</a>';
        }
    }


}