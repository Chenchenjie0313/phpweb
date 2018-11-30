<?php

class StringHelper{

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

    /***
     * 空文字文字チェック
     */
    public static function isRealEmpty($s){
        //空文字の場合、
        if (self::isEmpty($s)) return true;
        //半角スペースまたは全角スペース
        $pattern="/^(\s| )+$/";
        return preg_match($pattern, $s);
        
    }
    
    /**
     * 英数字チェック
     */
    public static function isAlnum($s){
        //空文字の場合、
        if (self::isEmpty($s)) return false;
        //英数字
        $pattern="/^[a-zA-Z0-9]+$/";
        return preg_match($pattern, $s);
    }


    /**
     * 检测变量是否为数字或数字字符串
     * 数字和数字字符串则返回 TRUE，否则返回 FALSE
     */
    public static function isInteger(/* string **/ $s){
        if (self::isEmpty($s)) return false;
        return preg_match("/^(0|[1-9][0-9]*)$/", $s);
    }

    

}