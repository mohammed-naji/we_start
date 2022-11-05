<?php 

// header("Location: index.php");

class Doctor extends Person {

    protected $sp;

    function __construct($name, $sp)
    {
        parent::__construct($name);
        $this->sp = $sp;
    }

    function getColor() {
        return $this->color;
    }

    function getAge() {
        return $this->age;
    }

}