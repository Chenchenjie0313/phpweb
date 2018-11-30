<?php 
class WString {

    private $value = null;

    private function __construct($value = null){
        $this->value = $value;
    }

    /**
     * 文字列クラスを生成する。
     */
    public static function create($value) {
        return new WString($value);
    }

    public static function isEmpty($value){
        if ($value == null || $value === ''){
            return true;
        }
        return false;
    }
    
    public static function anyEmpty(){
        $values = func_get_args();
        if ($values == null){ return true;}
        foreach ($values as $val){
            if (self::isEmpty($val)){
                return true;
            }
        }
        return false;
    }

    /**
     * 正規表現により文字列を分割し、配列に格納する
     */
    public function split($reg) {
        if ($this->value == null){
            return array();
        }
        return explode($reg, $this->value);
    }


    public function match($reg){
        return preg_match($reg, $this->value);
    }


}