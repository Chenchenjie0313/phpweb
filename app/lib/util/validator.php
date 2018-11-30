<?php

class Validator{

    public function __construct(){
        
    }
    
    /**
     * 文字列がNULL OR 空の場合、TRUEをリターンする。
     * その以外、FALSEをリターンする。
     */
    public static function isEmpty(/* string **/ $s){
        if($s == null || strlen($s) == 0){
            return true;
        }
        return false;
    }
    
    /**
     * 文字列がNULL OR 空の場合、TRUEをリターンする。
     * その以外、FALSEをリターンする。
     */
    public static function isNotEmpty(/* string **/ $s){
        return !self::isEmpty($s);
    }
    
    /**
     * 检测变量是否为数字或数字字符串
     * 数字和数字字符串则返回 TRUE，否则返回 FALSE
     */
    public static function isInteger(/* string **/ $s){
        if($s == null){
            return true;
        }
        return preg_match("/^(0|[1-9][0-9]*)$/", $s);
    }
    
    /**
     * 检测变量是否为数字或数字字符串
     * 数字和数字字符串则返回 TRUE，否则返回 FALSE
     */
    public static function isNotInteger(/* string **/ $s){
        return !self::isInteger($s);
    }

    /***
     * 
     * 
     */
    public static function maxLength(/* string **/$s,/* int **/$max){
        if(self::isEmpty($s) && $max >= 0){
            return true;
        } else if(strlen($s) <=  $max){
            return true;
        }
        return false;
    }

    public static function minLength(/* string **/$s,/* int **/$min){
        if(self::isEmpty($s) || $min <= 0){
            return true;
        } else if(strlen($s) >  $min){
            return true;
        }
        return false;
    }

    public static function length(/* string **/$s,/* int **/$max,/* int **/$min){
        return self::maxLength($s,$max) && self::minLength($s,$min);
    }

    /**
     * $arr [column => [[check=>'empty',msg=>'message'],[check=>'empty',msg=>'message']] ]
     * [id=>[msg=>'??',max=>10]]
     * 
     */
    public static function validetion(&$req, $arr, $allFlag = false){
        $errors = array();
        $error = null;

        foreach($arr as $key => $columns){
            foreach($columns as $index => $column ){
                $vali = $column['check'];
                switch($vali){
                    case 'empty' : //空
                        if(self::isEmpty($req[$key])){
                            $allFlag ? $errors[count($errors)] = $column['msg'] : $error = $column['msg'];
                        }
                        break;
                    case 'notempty' : 
                        if(self::isNotEmpty($req[$key])){
                            $allFlag ? $errors[count($errors)] = $column['msg'] : $error = $column['msg'];
                        }
                        break;
                    case 'integer' : 
                        if(self::isInteger($req[$key])){
                            $allFlag ? $errors[count($errors)] = $column['msg'] : $error = $column['msg'];
                        }
                        break;
                    case 'notinteger' :
                        if(self::isNotInteger($req[$key])){
                            $allFlag ? $errors[count($errors)] = $column['msg'] : $error = $column['msg'];
                        }
                        break;
                    case 'maxlength' :
                        if(self::maxLength($req[$key],$column['max'])){
                            $allFlag ? $errors[count($errors)] = $column['msg'] : $error = $column['msg'];
                        }
                        break;
                    case 'minlength' :
                        if(self::minLength($req[$key],$column['min'])){
                            $allFlag ? $errors[count($errors)] = $column['msg'] : $error = $column['msg'];
                        }
                        break;
                    case 'maxlength' :
                        if(self::length($req[$key],$column['max'],$column['min'])){
                            $allFlag ? $errors[count($errors)] = $column['msg'] : $error = $column['msg'];
                        }
                        break;
                    
                    default ; //その以外、チェックしない。
                }
            }
        }

        return $allFlag ? $errors : $error;
    }
}