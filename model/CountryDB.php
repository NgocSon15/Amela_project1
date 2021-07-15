<?php
namespace Model;

class CountryDB
{
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM countries";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $countries = [];

        foreach ($result as $row)
        {
            $country = new Country($row['name']);
            $country->id = $row['id'];
            $countries[] = $country;
        }

        return $countries;
    }
}