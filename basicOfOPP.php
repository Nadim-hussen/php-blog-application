<!-- --------------------------** 1.constructor/destructor **-----------------------------------  -->
<?php
// constructor ::: A constructor allows you to initialize an object's properties upon creation of the object. it call automatically when your instantiate an object.
// destructor  ::: A destructor is called when the object is destructed or the script is stopped or exited.
class Animal{
    private $name = 'Nadim'; // the property or method can ONLY be accessed within the class
    public $car = 'BMW'; //the property or method can be accessed from everywhere. This is default
    protected $weight = '30'; //the property or method can ONLY be accessed within the class ++ and by classes derived from that class
    function __construct($name='hello'){
        $this->name = $name;
        echo'Function Started <br/>';
    }
    function __destruct(){
        echo 'This is a destructor Animal'; //
    }
    function add(){
        echo 'Added <br />'.$this->name;
    }
}

$obj = new Animal();
$obj->car = 'Mercedes <br />'; // OK
// $obj->name = 'Yellow <br />'; // ERROR
// $obj->weight = '300 <br />'; // ERROR
echo ''.$obj->add().'<br />';
// note ::: Methods declared protected in a superclass must either be protected or public in subclasses;
//          they cannot be private. Methods declared private are not inherited at all, so there is no rule for them.


// ---------------------------------- ** 2.Static properties and method ** -----------------------------------

// Static methods and properties are bound to a class, not individual objects of the class. Use the static keyword
// to define static methods and properties. Use the self keyword to access static methods and properties within the class.
class Test {
    public static $name = 'Harry Potter';
    public static function showName(){
        echo self::$name; // *** you can access static properties by self keywords.
    }
}
Test::$name = 'Nadim Potter'; // you can replace name from there;
echo Test::$name.'<br />';
echo Test::showName().'<br />';


// -----------------------------------------------------------** 3.Encapsulation **---------------------------------------------
// Encapsulation is a way to restrict the direct access to some components of an object, so users cannot access state
// values. for all of the variables of a particular object Encapsulation can be used to hide both data members and data
// functions or methods associated with an instantiated class or object.
class User {
    private $id;
    private $name;
    private $email;
    // setters
    public function setId($id){ // A setter method is used to set or update the value of a specific variable within a class.
        $this->id = $id;
    }
    // getters
    public function getId(){ // A getter method is used to retrieve the value of a specific variable within a class.
        return $this->id;
    }
}
$user = new User();
$user->setId(5000);
echo $user->getId().'<br />';

// ----------------------------------------------------** 4.Single Inheritance **-----------------------------------------
// Inheritance in OOP = When a class derives from another class. The child class will inherit all the public* and
// protected* properties and methods from the parent class. In addition, it can have its own properties and methods.
//  An inherited class is defined by using the extends keyword.

class Person {
    protected $name;
    protected $age;
    protected $gender;
    protected function showPerson($n,$a,$g){
        echo "Name : ".$this->name = $n.'<br />';
        echo "Age : ".$this->age= $a.'<br />';
        echo "Gender : ".$this->gender = $g.'<br />';
    }
}

class Person_1 extends Person{
    private $salary;
    private $post;
    public function showEmployee($n,$a,$g,$s,$p){
        $this->showPerson($n,$a,$g);
        echo 'Salary: '.$this->salary = $s.'<br />';
        echo 'Post: '.$this->post = $p.'<br />';
    }
}
$person1 = new Person_1();
$person1->showEmployee('Nadim','17','Male',5000,'web dev');

// ----------------------------------------------------** 5.Abstraction **-----------------------------------------
// Abstract classes and methods are when the parent class has a named method, but need its child class(es) to fill out the tasks.
// An abstract class is a class that contains at least one abstract method. An abstract method is a method that is declared
// , but not implemented in the code.

// note :: Data Abstraction means any representation of data in which the implementation details are hidden or abstracted.
abstract class NewPerson {
    public $name;
    public $age;
    function __construct($n,$a){
        $this->name = $n;
        $this->age = $a;
    }
    public function hello(){
        echo "This is an abstract class. <br />";
    }
    abstract public function showData();
    abstract public function add($x,$y);
}
class AnotherPerson extends NewPerson{
    public function showData(){
        echo "My name is ".$this->name.'and I\'m'.$this->age.'year old.<br />';
    }
    public function add($x,$y){
        return $x + $y.'<br />';
    }
}
$newperson = new AnotherPerson('Nadim',24);
$newperson->showData();
$newperson->hello();
echo $newperson->add(10,20);

// --------------------------------------------------** 6.Interface **-----------------------------------------
// Interfaces allow you to specify what methods a class should implement.
// Interfaces make it easy to use a variety of different classes in the same way.
// When one or more classes use the same interface, it is referred to as "polymorphism".
// Note :: Interfaces are declared with the interface keyword
// 1 ::
interface Test1{
    const A = 10;
    public function showValue();
}
interface Test2{
    const B = 200;
    public function showValue();
}
class Main implements Test1,Test2{
    public function showValue(){
        echo Test2::B.'<br />';
        echo Test1::A.'<br />';
    }
}

$test1 = new Main();
$test1->showValue();
// --------------------
// 2 ::
interface Login {
    const Email = 'Nadim@gmail.com';
    const Password = 123456;
    public function getEmail();
    public function getPassword();
}
interface Register extends Login{
    const Phone = '01726603587';
    public function getPhone();
}

Class NewUser implements Register {
    public function getEmail(){
        echo Register::Email.'<br />';
    }
    public function getPassword(){
        echo Register::Password.'<br />';
    }
    public function getPhone(){
        echo Register::Phone.'<br />';
    }
}
$newUser = new NewUser();
$newUser->getEmail();


// *** different between Abstract and interface :::
    // 1.Interface supports multiple inheritence. Abstract class doesn't support multiple inheritence
    // 2.Interface doesn't contain member variable (var $price; var $title;) and constructor. but Abstract contain them.
    // 3. All interface methods must be public, while abstract class methods is public or protected

// ----------------------------------------------------** 7.Polymorphism **--------------------------------------------
// Polymorphism in PHP refers to the ability of objects to take on different forms and exhibit different behaviors
// while sharing a common interface. It allows different classes to implement the same method name with different functionality.
interface Shape{
    public function calculateArea();
}
class Circle implements Shape{
    private $radius;
    public function __construct($r){
        $this->radius = $r;
    }
    public function calculateArea(){
        echo "Area of circle= ". pi()*$this->radius*$this->radius.'<br />';
    }
}
class Rectangle implements Shape {
    private $height;
    private $width;
    public function __construct($h,$w){
        $this->height = $h;
        $this->width = $w;
    }
    public function calculateArea(){
        echo "Area of triangle= ".$this->height * $this->width.'<br />';
    }
}
class Triangle implements Shape {
    private $base;
    private $height;
    public function __construct($b,$h){
        $this->base = $b;
        $this->height = $h;
    }
    public function calculateArea(){
        echo "Area of triangle = ". ($this->base * $this->height)/2 ."<br />";
    }
}

$circle = new Circle(5);
$rect = new Rectangle(10,30);
$tri = new Triangle(10,30);
$circle->calculateArea();
$rect->calculateArea();
$tri->calculateArea();


// ---------------------------------- **overriding** ---------------------------------------

class Base {
    public function hello(){
        echo "This is a base class <br />";
    }
}
class Child extends Base {
    public function hello(){
        echo "This is child class <br />";
    }
}
$b = new Base;
$c = new Child;
$b->hello();
$c->hello(); // hello method changes in Child.