<?php
namespace Model;

class Country
{
    public $id;
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}