<?php 
namespace app\models;

class Person {
    public function __construct($name, $age){
        $this->name = $name;
        $this->age = $age;
    }

    public function sayHi(){
        return 'I am saying hi';
    }

    public function talk(){
        return 'I am talking';
    }
}