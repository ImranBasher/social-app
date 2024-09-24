<?php 

namespace   App\Services;

use Exception;

class IsActive{
    public function is_active($value){
       
        try{

            $boolValue = [0,1];

            if( !in_array($value,$boolValue)){

                throw new Exception("Value not in array");
            }

            return (bool)$value;
            
        }catch(Exception $e){
            
            return false;
        }
        
    }
}