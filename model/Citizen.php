<?php
namespace Model;

class Citizen
{
    public $id;
    public $name;
    public $age;
    public $gender;
    public $cityId;
    public $imageUrl;
    public $cityName;

    public function __construct($name, $age, $gender, $cityId, $imageUrl)
    {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->cityId = $cityId;
        $this->imageUrl = $imageUrl;
    }
}
