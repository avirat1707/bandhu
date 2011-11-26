<?php
    /**
     * This id the comman file where the necessary functions would be included
     * automatically and hence this function would be available all the time
     * of the execution
     */

     /*
      *
      * To print the array ith PRE tag!
      * @param type $arr
      * @return type boolean
      */
     function pr($arr){
         echo "<pre>";
         print_r($arr);
         echo "</pre>";
         return true;
     }
     
?>
