<?php
     /*
      * @return type datetime+microtime
      */
    function getTime(){
        $time=sprintf("%d%.6f",time(),microtime());
        return $time;
    }
    if(isset($_POST)){
        $userId=$_POST["userId"];
        $friendId=$_POST["friendId"];
        $message=$_POST["message"];
        $currentTime=getTime();
        $connection=mysql_connect("localhost","root","");
        mysql_select_db("chatbox",$connection) or die("Database Connection Failed");
        $query="INSERT INTO chat(messageFrom,messageTo,message,created) VALUES(".$userId.",".$friendId.",'".$message."',".$currentTime.")";
        $result=mysql_query($query,$connection);
        if($result==1){
            echo "Inserted Successfully";
        }else{
            echo mysql_error();
        }
    }
    
?>
