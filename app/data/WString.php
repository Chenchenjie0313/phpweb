<?php 
class WString implements Serializable{

    private $value = null;

    private function __construct($value = ""){
        $this->value = $value;
    }

    public function isEmpty(){
        if ($this->value == null || $this->value === ''){
            return true;
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

    /***
     * 
     */
    public function toString(){
        return $this->value;
    }

    /***
     * Serializable
     * 
     */
    public function serialize (  ) {
        return serialize($this->value);
    }
    public function unserialize ( $data ) {
        $this->value = unserialize($data);
    }


    /***
     * staitc function
     * 
     */

    /**
     * 文字列クラスを生成する。
     */
    public static function create($value="") {
        return new WString($value);
    }

    /**
     * 指定した文字列いずれか空白か
     */
    public static function anyEmpty(...$params){
        foreach ($params as $val){
            if (WString::create($val)->isEmpty()){
                return true;
            }
        }
        return false;
    }


}