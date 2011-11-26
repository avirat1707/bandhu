<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'core'.DIRECTORY_SEPARATOR.'ChatBox.php';
try{
    ChatBox::init();
    $name=ChatBox::getController('ReceiveMessage')->getModel('Try/mytry')->SayHello();
    //ChatBox::init();
}catch (Exception $e){
    die($e->getMessage());
}


?>
