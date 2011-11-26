<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'core'.DIRECTORY_SEPARATOR.'ChatBox.php';
try{
    ChatBox::init();
    $mytry=ChatBox::getClass('core/Model');
    $mytry->SayHello();
}catch (Exception $e){
    die($e->getMessage());
}


?>
