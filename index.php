<?php
require 'controller/CityController.php';
require 'model/DBConnection.php';
require 'model/City.php';
require 'model/CityDB.php';
require 'controller/CountryController.php';
require 'model/Country.php';
require 'model/CountryDB.php';
require 'model/Citizen.php';
require 'model/CitizenDB.php';
require 'controller/CitizenController.php';
require 'model/Validator.php';

use \Controller\CityController;
use \Controller\CitizenController;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>City</title>
</head>
<body>
    <div class="d-flex" style="height: 100vh;">
        <div class="bg-dark" style="width: 15%;">
            <div class="w-100 text-light font-weight-bold d-flex" style="height: 50px;">
                <div class="justify-content-center align-self-center pl-3">
                    Nguyễn Ngọc Sơn
                </div>
            </div>
            <table class="table table-hover table-dark">
                <tr>
                    <td>
                        <a href="index.php?view=city" class="w-100 d-flex text-light" style="text-decoration: none;">
                            <div>Thành phố</div>
                            <div class="ml-auto">></div>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="index.php?view=citizen" class="w-100 d-flex text-light" style="text-decoration: none;">
                            <div>Dân cư</div>
                            <div class="ml-auto">></div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="container">
            <?php
            $cityController = new CityController();
            $citizenController = new CitizenController();
            $view = isset($_REQUEST['view']) ? $_REQUEST['view'] : NULL;
            $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : NULL;
            switch ($view)
            {
                case 'city':
                    switch ($page)
                    {
                        case 'add':
                            $cityController->add();
                            break;
                        case 'delete':
                            $cityController->delete();
                            break;
                        case 'edit':
                            $cityController->edit();
                            break;
                        case 'info':
                            $cityController->info();
                            break;
                        default:
                            $cityController->index();
                            break;
                    }
                    break;
                default:
                    switch ($page)
                    {
                        case 'add':
                            $citizenController->add();
                            break;
                        case 'delete':
                            $citizenController->delete();
                            break;
                        case 'edit':
                            $citizenController->edit();
                            break;
                        case 'info':
                            $citizenController->info();
                            break;
                        default:
                            $citizenController->index();
                            break;
                    }
                    break;
            }
            ?>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
