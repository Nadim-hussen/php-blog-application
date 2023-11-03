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