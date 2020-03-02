<?php
//simple class definition
class ASimpleClass {
    //property declaration
    public $var = 'I am main class </br>';

    //method declaration
    public function displayVar(){
        echo $this->var;
    }
}

$a = new ASimpleClass();
$a->displayVar();

//using inheritance
class AnotherSimpleClass extends ASimpleClass {
    public function say(){
        echo "I am inherited class </br>";
    }
}
$a = new AnotherSimpleClass();
$a->displayVar();
$a->say();

//encapsulation
class EncapsulatedClass {
    private $userName;
    private $emailId; //not accesible to outer user

    //update emailId
    public function getName(){
        return $this->userName; //cannot change property encapsulated
    }
    public function setName($userName){
        $this->userName = $userName;
        echo("The username is set to " . $userName);
        echo("</br>");
    }
    public function getEmail(){
        return $this->emailId;
    }
    public function setEmail($emailId){
        echo("The email is set to " . $emailId);
        echo("</br>");
    }
}
$a = new EncapsulatedClass();
$a->setName('ABC');
$a->setEmail('abc@abc.com');

//abstraction
abstract class AbstractClass {
    abstract protected function  getValue();
    abstract protected function prefixValue($prefix);
    //common method
    public function output(){
        print $this->getValue() . "</br>";
    }

}
class RealClass extends AbstractClass {
    protected function getValue(){
        return "RealClass";
    }
    public function prefixValue($prefix)
    {
        return "{$prefix}RealClass";
    }
}
class RealClass2 extends AbstractClass {
    public function getValue(){
        return "RealClass2";
    }
    public function prefixValue($prefix)
    {
        return "{$prefix}RealClass2";
    }
}
$a = new RealClass ;
$b = new RealClass2 ;
$a->output();
echo $a-> prefixValue('prefixed_') ."</br>";
$b->output();
echo $b-> prefixValue('prefixed_') ."</br>";
//static classes
class staticClass {
    private function __construct(){}
    private static $greeting = 'Hello';
    private static $initialized = false;
    private static function initialize (){
        if(self::$initialized)
        return;

        self::$greeting .= 'There!' ."</br>";//concatenate there
        self::$initialized = true;
    }

    public static function greet(){
        self::initialize();
        echo self::$greeting;
    }
}
staticClass::greet();

//polymorphism in php
interface Shape {
    public function calcArea();
}
class Circle implements Shape {
    private $radius;
    public function __construct($radius){
        $this->radius = $radius;
    }
    //calc the area
    public function calcArea()
    {
        return $this->radius * $this->radius * pi();
    }
}
class Rectangle implements Shape {
    private $width;
    private $height;
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height= $height;
    }
    //calc area
    public function calcArea()
    {
        return $this->width * $this->height;
    }
}
$a = new Circle(10);
$b = new Rectangle(10,10);
echo $a->calcArea() ."</br>";
echo $b->calcArea() ."</br>";

//overload
//property overloading

class PropertyOverloading{
    /** location of overloaded data */
    private $data = array();
    /**overloading not used on declared properties */
    public $declared = 1;
    /**overloading only used ob this when accessed outside the class*/
    private $hidden = 2;
    public function __set($name, $value){
        echo "Setting '$name' to '$value'</br>";
        $this->data[$name]=$value;
    }
    public function __get($name){
        echo "Getting '$name'</br>";
        if (array_key_exists($name, $this->data)){
            return $this->data[$name];
        }
        $trace = debug_backtrace();
        trigger_error('Undefined property via __get(): ' .$name .
        ' in ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'], E_USER_NOTICE);
        return null;
    }
    public function __isset($name)
    {
        echo "Is '$name' set?";
        return isset($this->data[$name]);
    }
    public function __unset($name){
        echo "</br> Unsetting '$name'</br>";
        unset($this->data[$name]);
    }
    public function getHidden(){
        return $this->hidden;
    }
}

$a = new PropertyOverloading;
//set value to 1
$a->key = 100;
echo $a->key ."</br>";
//use isset function
//key is set or not
var_dump(isset($a->key));
//unset key
unset($a->key);
var_dump(isset($a->key));
echo "</br>";

echo $a->declared . "</br>";
echo "Let's experiment with the private property named 'hidden' : </br>";
echo "Privates are visible inside the class, so __get() not used...</br>";
echo $a->getHidden() . "</br>";
echo "Privates not visible outside of class, so __get() is used...\n";
echo $a->hidden . "\n";

//method overloadding
class MethodOverload{
    public function __call($name, $arguments){
        echo "Calling object method '$name' " . implode(', ' , $arguments). "</br>";
    }
    public static function __callStatic($name, $arguments)
    {
        echo "Calling static method '$name' " . implode(', ' , $arguments). "</br>";
    }
}
$a = new MethodOverload;
$a->runTest(' in object context');
MethodOverload::runTest(' in static context');

//override
class ParentClass {
    function allfunctions(){
        echo "Parent";
    }
}
class ChildClass extends ParentClass {
    function allfunctions(){
        echo "</br> I am child </br>";
    }
}

$a= new ParentClass;
$b= new ChildClass;
$a->allfunctions();
$b->allfunctions();





?>
