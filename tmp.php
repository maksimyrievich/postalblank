<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 20.11.2016
 * Time: 21:23
 */

//namespace MyCode {
//    $a = 111;
//    class SSHConnect{}
//}
//
//namespace AlienCode {
//    $a = 111;
//    class SSHConnect{}
//}



// ходить
// лаять
// кусать
// есть
// хвост
// ,,,

// ходить
// мяукать
// кусать
// царапаться
// есть
// ,,,

//abstract class Animal
//{
//    private $battery;
//    private $position;
//
//    /**
//     * Animal constructor.
//     * @param $battery
//     * @param $position
//     */
//    public function __construct($battery = 1000, $position = 0)
//    {
//        $this->battery = $battery;
//        $this->position = $position;
//    }
//
//    function __get($name)
//    {
//        echo 'Вызван: ' . $name;
//        return 10000;
//    }
//
//    function __set($name, $value)
//    {
//        if ($name == 'battery' && !is_int($value)) {
//            echo 'Erro battery only integer';
//        } else {
//            $this->battery = $value;
//        }
//    }
//
//
//    public function getBattery()
//    {
//        return $this->battery;
//    }
//
//    public function setBattery($value)
//    {
//        $this->battery = $value;
//    }
//
//    public function move($direct, $distance)
//    {
//        $this->position += $distance;
//    }
//
//    public function bit(Animal $other)
//    {
//        $other->battery--;
//    }
//
//    public function eat($value)
//    {
//        $this->battery += $value;
//    }
//
//    abstract public function voice();
//}
//
//class Cat extends Animal {
//    public function voice(){
//        echo 'Meow!!!!';
//    }
//}
//
//class Dog extends Animal {
//    public function eat($value)
//    {
//        $this->setBattery($value / 2);
//    }
//
//    public function bit(Animal $other)
//    {
//        $other->setBattery(
//            $other->getBattery() - 100
//        );
//    }
//
//    public function voice(){
//        echo 'Gav-gav!!!!';
//    }
//
//    private function foo()
//    {
//        $this->setBattery(100000);
//    }
//}
//
//$cat = new Cat(1000);
//$cat->battery = 'gray';
//
//$conn = new \MyCode\SSHConnect();
//$conn = new \AlienCode\SSHConnect();


class SharedPtr {
    // данные класса
    static private $count = 0;

    static private $table = "SharedPtr";

    // данные объекта
    private $name;

    /**
     * SharedPtr constructor.
     */
    public function __construct($name)
    {
        $this->name  = $name;
        static::$count++;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $count
     */
    public function getCount()
    {
        return self::$count;
    }

    public static function getTable()
    {
        return static::$table;
    }
}

class Child extends SharedPtr
{
    static private $table = "Child";

    // getTable()
}
SharedPtr::getTable(); // SharedPtr
Child::getTable(); // Child