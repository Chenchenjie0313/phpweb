<?php 

App::import('data/WString');

class RouteItem {
 
    private $key = null;
    private $forward = null;
    private $layout = null;
    
    public function __construct($key, $forward, $layout=null){
        $this->key = $key;
        $this->forward = $forward;
        $this->layout = $layout;
    }

    public static function create($key, $forward, $layout=null){
        return new RouteItem($key, $forward, $layout);
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
    
    public function getLayout(){
        return $this->layout;

    }

}