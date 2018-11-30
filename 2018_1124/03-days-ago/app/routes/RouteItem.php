<?php 

App::import('data/WString');

class RouteItem {
 
    private $key = null;
    private $forward = null;
    
    public function __construct($key, $forward){
        $this->key = $key;
        $this->forward = $forward;
    }

    public static function create($key, $forward){
        return new RouteItem($key, $forward);
    }

    /**
     * 
     */
    public function where(){
        
    }

    public function getKey(){
        return $this->key;
    }

    
    public function getForward(){
        return $this->forward;

    }

}