<?php
namespace App\Helpers;
use Response;
use Redirect;
use Session;
use Carbon\Carbon;

class Helpers {
    public static function pp($data,$die=0)
    {
        echo "<pre>";
            print_r($data);
        echo "</pre>";
        if($die ==0){
            die(" pp ");    
        }
        
    }

}