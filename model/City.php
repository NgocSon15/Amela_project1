<?php
namespace Model;

class City
{
    public $id;
    public $name;
    public $countryId;
    public $area;
    public $population;
    public $gdp;
    public $description;
    public $countryName;

    public function __construct($name, $countryId, $area, $population, $gdp, $description)
    {
        $this->name = $name;
        $this->countryId = $countryId;
        $this->area = $area;
        $this->population = $population;
        $this->gdp = $gdp;
        $this->description = $description;
    }
}