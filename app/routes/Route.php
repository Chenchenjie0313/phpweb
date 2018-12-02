<?php 

App::import('data/WString');
App::import('data/WArray');

/**
 * ルートノードクラス
 * 
 */
class RouteNode {
 
    private $path = null;
    private $value = null;
    private $attrs = null;
    private $childrens = null;
    
    public function __construct($path="", $value="", $childrens=null, $attrs=null){
        $this->path = $path;
        $this->value = $value;
        if ($attrs == null){
            $this->attrs = WArray::create();
        } else {
            $this->attrs = $attrs;
        }
        if ($childrens == null){
            $this->childrens = WArray::create();
        } else {
            $this->childrens = $childrens;
        }
    }
    
    public static function create($path="", $value="", $childrens=null, $attrs=null){
        return new RouteNode($path, $value, $childrens, $attrs);
    }

    public function add ($path, $value){
        $this->getChildrens()->add($path, $value);
        return $this;
    }

    public function get ($path){
        return $this->getChildrens()->get($path);
    }

    /** GET/SET */
    public function getChildrens(){return $this->childrens;}
    public function setChildrens($childrens){$this->childrens = $childrens;return $this;}
    public function getAttrs(){return $this->attrs;}
    public function setAttrs($attrs){$this->attrs = $attrs;return $this;}
    public function getPath(){return $this->path;}
    public function setPath($value){$this->path = $path;return $this;}
    public function getValue(){return $this->value;}
    public function setValue($value){$this->value = $value;return $this;}

}


/***
 * ルート
 * 
 */
class Route {

    private static $instance = null;

    public static function create(){
        if (self::$instance == null){
            self::$instance = new Route();
        }
        return self::$instance;
    }

    private $rootNode = null;

    private function __construct(){
        $this->rootNode = RouteNode::create();
    }

    public function getRootNode(){return $this->rootNode;}

    /**
     * 指定パスより、ノードを設定する。
     */
    public static function any($path, $value){
        //Logger::log(__METHOD__.",行:".__LINE__, $path, $value);
        if (WString::anyEmpty($path, $value)){
            throw new WException();
        }
        $root = Route::create()->getRootNode();
        $root->add($path, RouteNode::create($path, $value));
    }

    /**
     * 指定パスより、ノードを取得する。
     */
    public static function get($path){
        $root = Route::create()->getRootNode();
        if (!WString::anyEmpty($path)){
            return $root->get($path);
        }
        return $root->get(WEB_APP_DEFAULT_VIEW_PATH);
    }

}