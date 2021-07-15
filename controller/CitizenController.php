<?php

namespace Controller;

use Model\citizen;
use Model\citizenDB;
use Model\DBConnection;
use Exception;

class CitizenController
{
    public $citizenDB;

    public function __construct()
    {
        $connection = new DBConnection("mysql:host=localhost;dbname=city_manager", "root", "");
        $this->citizenDB = new CitizenDB($connection->connect());
    }

    public function index()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $citizens = $this->citizenDB->getAll();
                include 'view/citizen/list.php';
            } else {
                $name = trim($_POST['name']);
                $citizens = $this->citizenDB->getByName($name);
                include 'view/citizen/list.php';
            }
        } catch (Exception $e) {
            $citizens = [];
            include 'view/citizen/list.php';
            echo $e->getMessage();
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include 'view/citizen/add.php';
        } else {
            try {
                $name = trim($_POST['name']);
                $age = $_POST['age'];
                $gender = $_POST['gender'];
                $cityId = $_POST['cityId'];
                $citizen = new Citizen($name, $age, $gender, $cityId, null);
                $citizen->imageUrl = $this->citizenDB->getImageUrl();
                $this->citizenDB->create($citizen);
                $message = "Đã thêm người dân mới";
                header('Location: index.php?view=citizen&message=' . $message);
            } catch (Exception $e) {
                $message = $e->getMessage();
                include 'view/citizen/add.php';
            }
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            try {
                $id = $_GET['id'];
                $citizen = $this->citizenDB->getById($id);
                include 'view/citizen/delete.php';
            } catch (Exception $e) {
                echo '<h2>404 Error: ' . $e->getMessage() . '</h2>';
                echo '<a href="./index.php?view=citizen"><< Danh sách dân cư</a>';
            }
        } else {
            $id = $_POST['id'];
            $this->citizenDB->delete($id);
            $message = 'Xóa người dân thành công';
            header('Location: index.php?view=citizen&message=' . $message);
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            try {
                $id = $_GET['id'];
                $citizen = $this->citizenDB->getById($id);
                include 'view/citizen/edit.php';
            } catch (Exception $e) {
                echo '<h2>404 Error: ' . $e->getMessage() . '</h2>';
                echo '<a href="./index.php?view=citizen"><< Danh sách dân cư</a>';
            }
        } else {
            try {
                $id = $_POST['id'];
                $citizen = new Citizen(trim($_POST['name']), $_POST['age'], $_POST['gender'], $_POST['cityId'], $_POST['imageUrl']);
                $this->citizenDB->update($id, $citizen);
                $message = 'Sửa thông tin người dân thành công';
                header('Location: index.php?view=citizen&message=' . $message);
            } catch (Exception $e) {
                $message = $e->getMessage();
                include 'view/citizen/edit.php';
            }
        }
    }

    public function info()
    {
        try {
            $id = $_GET['id'];
            $citizen = $this->citizenDB->getById($id);
            include 'view/citizen/info.php';
        } catch (Exception $e) {
            echo '<h2>404 Error: ' . $e->getMessage() . '</h2>';
            echo '<a href="./index.php?view=citizen"><< Danh sách dân cư</a>';
        }
    }
}