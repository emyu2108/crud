<?php

abstract class Animal {
    abstract public function makeSound();

    public function sleep() {
        echo "Животное спит...<br>";
    }
}

class Dog extends Animal {
    public function makeSound() {
        echo "Собака лает 🐶<br>";
    }
}

$dog = new Dog();
$dog->makeSound(); // ✅
$dog->sleep();     // ✅