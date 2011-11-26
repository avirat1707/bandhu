<?php
/**
 *  Description of ChatBox
 *  This is the general class that will
 *  redirect and include files accordingly
 *
 *  @author tirthbodawala
 */
class ChatBox {
    
    /**
     * @var type string: this is to declare the name of the cirrent class name
     */
    public static $name="ChatBox";
    
    /**
     * To keep track whether this class already have a instance or not
     * @var type boolean
     */
    static private $initiated=false;
    
    // To Store the Initialized Object of this class
    static private $Object;
    
    // To Store the data 
    private $data;
    
    /**
     * Constructor for the ChatBox Class
     */
    private function __construct() {
        $this->_InitData();
    }
    
    /*
     * Initialize the all required data needed for core configurations
     */
    function _InitData(){
        /**
         * Setting Base Path Of The Website
         */
        $base=dirname(dirname(__FILE__));
        $this->data['website']['base']=$base.DIRECTORY_SEPARATOR;
    }
    
    
    /**
     * This static function is used to initialize the ChatBox Core class and thus
     * making different functionality available to the class
     * @return type boolean
     */
    static function init(){
        
        if(!self::$initiated){
            
            self::$Object=new ChatBox();            
            // Setting the initialized flag to true
            self::$initiated =true;
            
            return true;
            
        }else{
            
            // If this is already initialized return the object of this class
            return false;
        }
        
    }
    /**
     * This function accepts the string path and accordingly replacing '/',
     * creates a path to that specified location
     * @param type $PathString
     * @return string 
     */
    private function _BuildPath($PathString){
        $PathArray=explode("/",$PathString);
        
        // Initialize new path (this variable will finally contain the build path)
        $NewPath="";
        
        // Iterate through the array except the last element in the array
        for($i=0;$i<count($PathArray)-1;$i++){
            $NewPath=$NewPath.$PathArray[$i].DIRECTORY_SEPARATOR;
        }
        
        // Make the last element as the class file to be included
        $NewPath=self::$Object->data['website']['base'].$NewPath.$PathArray[$i].".php";
        return $NewPath;
    }
    
    
    /**
     * This function accepts a string with '/' and returns the last element name after
     * last '/' which would be class according to the convention
     * @param type $Path:String
     * @return String
     */
    private function _BuildClassName($Path){
        
        // Get the array of the path
        $PathArray=explode("/",$Path);
        
        // Return the name of class
        return end($PathArray);
    }
    
    private function _BuildModelName($Path){
        $ModelClassName=explode("/", $Path);
        $ModelClassName=implode("_",$ModelClassName);
        return $ModelClassName;
    }
    
    /**
     * This function get the class file from the path specified and try to return
     * the object of the class
     * @param type $ClassName: String
     * @return Class Object 
     */
    static function getClass($ClassName=NULL){
        /**
         * Check if the ChatBox class is initialized or not, so that all the data
         * necessary before initialization is set and available accordingly
         */
        if(!self::$initiated){
            throw new Exception("ChatBox Not Initialized");
        }
        
        /**
         * Check if the Class Name is Provided or not
         */
        if($ClassName==NULL){
            throw new Exception("Invalid Class Name");
        }
        
        /*
         * Build the Path for the file for the specified class name
         */
        $ClassPath=self::_BuildPath($ClassName);
        if(!file_exists($ClassPath)){
            // Throw  Exception  If Class Is Not Found
            throw new Exception("Class Not Found At Location: ".$ClassPath);
        }else{
            include_once $ClassPath;
        }
        
        $NeededClass=self::_BuildClassName($ClassName);
        
        // Return Class Object
        return new $NeededClass();
    }
    static function getModel($ModelName=NULL){
        /**
         * Check if the ChatBox class is initialized or not, so that all the data
         * necessary before initialization is set and available accordingly
         */
        if(!self::$initiated){
            throw new Exception("ChatBox Not Initialized");
        }
        
        /**
         * Check if the Class Name is Provided or not
         */
        if($ModelName==NULL){
            throw new Exception("Invalid Class Name");
        }
        
        $CoreModelPath=self::_BuildPath("core/model");
        if(!file_exists($CoreModelPath)){
            throw new Exception("Core Model Missing: The core file fo model class is missing");
        }else{
            include_once $CoreModelPath;
        }
        /*
         * Build the Path for the file for the specified class name
         */
        $ModelPath=self::_BuildPath("model".DIRECTORY_SEPARATOR.$ModelName);
        
        if(!file_exists($ModelPath)){
            // Throw  Exception  If Class Is Not Found
            throw new Exception("Model Not Found At Location: ".$ModelPath);
        }else{
            include_once $ModelPath;
        }
        
        $NeededClass=self::_BuildModelName($ModelName);
        
        // Return Class Object
        $ModelObject= new $NeededClass();
        if(strcasecmp(get_parent_class($ModelObject),"Model")){
            throw new Exception("Not a valid Model Class");
        }
        return $ModelObject;
    }
    
}
?>
