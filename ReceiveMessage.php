<?php
    /**
     * Include the ChjatBox class
     */
    require_once 'core'.DIRECTORY_SEPARATOR.'ChatBox.php';
    
    // Initialize the chat box functionality
    ChatBox::init();
    
    /**
     *  Checking the parameters for the post and get gata
     *
    if(isset($_GET) && isset($_GET['timestamp']) && isset($_GET['userId']) && $_GET['userId']!=NULL && $_GET['timestamp']!=NULL){
        $userId=$_GET["userId"];
        $timestamp=$_GET["timestamp"];
        pr($ReceiveMessage->data);
        die;
        
        $db=db::dbConnect();
        $query="SELECT * FROM chat WHERE (messageTo='".$userId."' OR messageFrom='".$userId."') AND created < ".$timestamp." ORDER BY created";
        $total_rows=0;
        $result=NULL;
        while($total_rows==0){
            $result=$db->query($query);
            $total_rows=$result->num_rows;
            if($total_rows>0){break;}
            sleep(0);
        }
        $messages=array();
        if($result){
            while($row=mysql_fetch_assoc($result)){
                array_push($messages,$row);
            }
        }
        //header("Pragma: no-cache");
        //header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
        //header('Content-Type: text/x-json');
        //header("X-JSON: ".json_encode($messages));
        echo json_encode($messages);
        die;
    }else{
        die("Nothing To Show");
    }*/
?>

