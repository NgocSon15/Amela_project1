<?php
namespace Model;

class Validator
{
    public $isValid;
    public $message;

    public function __construct($isValid, $message)
    {
        $this->isValid = $isValid;
        $this->message = $message;
    }
}