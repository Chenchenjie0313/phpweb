<?php 
class WArray {

    private $value = null;

    private function __construct($value = array()){
        if ($value != null){
            $this->value = $value;
        }
    }

    /**
     * 文字列クラスを生成する。
     */
    public static function create($value) {
        return new WArray($value);
    }

    public function isEmpty(){
        if ($this->value == null || count($this->value) == 0){
            return true;
        }
        return false;
    }

    public function size(){
        if ($this->isEmpty()){
            return 0;
        }
        return count($this->value);
    }

    public function get($key){
        if (isset($this->value[$key])){
            return $this->value[$key];
        }
        return null
    }

}