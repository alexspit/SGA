<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26-Dec-15
 * Time: 11:38
 */

class Random {

    public static function generate(){
        return mt_rand() / mt_getrandmax();
    }

} 