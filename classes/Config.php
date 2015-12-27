<?php

class Config{
    
    public static function get($path = null){//Setting a static function to be able to access it without declaring a new class
        if($path){ //Make sure a path has been submitted
            $config = $GLOBALS['config']; //Setting the value of the config array in a vriable for easier access
            $path = explode('/', $path);//Sepetating the $path in a array 
            
            foreach($path as $x) //Looping through the array
            {
                if(isset($config[$x])){ //If the first value is set
                    $config = $config[$x]; //Set the next array to that value
                }
            }  
            return $config;            
        }
    }
}
