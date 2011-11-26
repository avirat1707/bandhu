<?php

/**
 * Description of Controller
 *
 * @author tirthbodawala
 */
class Controller extends ChatBox{
    /**
     * Throwing custom error as there should be no init method for the controller
     * as controller is derived from chatbox
     */
    final static function init(){
        throw new Exception("Cannot Initialize Derived Class Of ChatBox!");
    }
    function SayHello(){
        echo "Hello form controller";
    }
}

?>
