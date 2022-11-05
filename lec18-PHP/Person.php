<?php 
class Person {
    public $name;
    protected $age = 28;
    private $color = 'Black'; 

    function __construct($abc)
    {
        $this->name = $abc;
    }

    function __destruct()
    {
        echo 'End';
    }

    function getName() {
        return $this->name;
    }

    // function getAge() {
    //     return $this->age;
    // }

    // function getColor() {
    //     return $this->color;
    // }
}