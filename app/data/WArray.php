<?php 
class WArray implements ArrayAccess,Serializable {

    private $value = null;

    private function __construct($value = array()){
        $this->value = $value;
    }

    /**
     * 文字列クラスを生成する。
     */
    public static function create($value = array()) {
        if ($value == null){
            return new WArray(array());
        } else if (is_array($value)){
            return new WArray($value);
        }
        throw new Exception("params is error!");
    }

    public function isEmpty(){
        return $this->size() == 0 ;
    }

    public function size(){
        return count($this->value);
    }

    public function keys(){
        return array_keys($this->value);
    }

    public function hasValue($key){
        return array_key_exists($key, $this->value);
    }

    public function get($key){
        if ($this->hasValue($key)){
            return $this->value[$key];
        }
        return null;
    }

    public function put($key, $value){
        $this->value[$key] = $value;
        return $this;
    }

    public function addList($values){
        if ($values != null){
            if (is_array($values)){
                $this->value = array_merge($this->value, $values);
            } else if (is_object($values) && $values instanceof WArray){
                $this->value = array_merge($this->value, $values->clone());
            }

        }
        return $this;
    }

    /**
     * 配列を返却
     * 
     */
    public function clone(){
        return array_merge(array(),$this->value);
    }

    public function remove($key){
        if ($this->hasValue($key)){
            unset($this->value[$key]);
        }
        return $this;
    }

    /***
     * ArrayAccess
     */
    public function offsetExists ( $offset ) {
        return $this->hasValue($offset);
    }
    public function offsetGet ( $offset ) {
        return $this->get($offset);
    }
    public function offsetSet ( $offset , $value ){
        return $this->put( $offset , $value );

    }
    public function offsetUnset ( $offset ) {
        return $this->remove($offset);
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

}