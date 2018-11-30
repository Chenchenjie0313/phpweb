<?php


class Action {

    public function __construct(){
        
    }

    public function insert($key){
        return "";
    }

    public function validate(/*string*/ $methodName = null){
        if($methodName == null){
            throw New Exception( `NULL. CLASS : ${__CLASS__},FUNCTION : ${__FUNCTION__},${__LINE__}行 .`);
        }
        $errors = array();
        return $errors;
    }


}