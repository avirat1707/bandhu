<?php


/**
 * Description of db
 *
 * @author tirthbodawala
 */
class db extends mysqli {
    private $host;
    private $username;
    private $passwd;
    private $database;
    static private $connected=false;
    static private $defaultHost="bandhudb.db.8561465.hostedresource.com";
    static private $defaultUsername="bandhudb";
    static private $defaultPasswd="King123#";
    static private $defaultDatabase= "bandhudb";
    static private $dbObject;
    
    private function __construct($host=NULL,$username=NULL,$passwd=NULL,$database=NULL) {
        $host==NULL?$this->host=self::$defaultHost:$this->host=$host;
        $username==NULL?$this->username=self::$defaultUsername:$this->username=$username;
        $passwd==NULL?$this->passwd=self::$defaultPasswd:$this->passwd=$passwd;
        $database==NULL?$this->database=self::$defaultDatabase:$this->database=$database;
        parent::__construct($this->host, $this->username, $this->passwd, $this->database);
    }
    
    static function dbConnect(){
        if(!self::$connected){
            $db=new db();
            self::$connected=true;
            self::$dbObject=$db;
            return $db;
        }else{
            return self::$dbObject;
        }
    }
}

?>
