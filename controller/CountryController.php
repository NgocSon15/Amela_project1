<?php
namespace Controller;

use Model\Country;
use Model\CountryDB;
use Model\DBConnection;

class CountryController
{
    public $countryDB;

    public function __construct()
    {
        $connection = new DBConnection("mysql:host=localhost;dbname=city_manager", "root", "");
        $this->countryDB = new CountryDB($connection->connect());
    }

    public function index()
    {
        $countries = $this->countryDB->getAll();
        return $countries;
    }
}