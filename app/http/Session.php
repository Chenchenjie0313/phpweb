<?php 
App::import('data/WString');
App::import('data/WArray');
class Session {

    private function __construct(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    private static $target = null;

    public static function create(){
        if (self::$target == null){
            self::$target = new Session();
        }
        return self::$target;
    }

    public function hasValue($key){
        return array_key_exists($key, $_SESSION);
    }

    public function get($key){
        if ($this->hasValue($key)){
            return $_SESSION[$key];
        }
        return null;
    }

    public function remove($key){
        if ($this->hasValue($key)){
            unset($_SESSION[$key]);
        }
        return $this;
    }

    public function add($key, $value){
        $_SESSION[$key] = $value;
        return $this;
    }


}