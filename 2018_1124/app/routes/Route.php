<?php 

App::import('data/WString');
App::import('routes/RouteItem');

class Route {

    private static $instance = null;

    public static function create(){
        if (self::$instance == null){
            self::$instance = new Route();
        }
        return self::$instance;
    }

    private $urlPath = null;
    private $routeMap = null;

    public function __construct(){

        $this->routeMap = array();
    }

    /**
     * 
     */
    public static function layout($key, $forward, $layout=null){
        //Logger::log(__METHOD__.",行:".__LINE__, $key, $forward);
        if (WString::anyEmpty($key, $forward)){
            throw new WException();
        }
        if (isset(Route::create()->routeMap[$key])){
            return Route::create()->routeMap[$key];
        }
        if (WString::isEmpty($layout)){
            $layout ="common/layout";
        }
        Route::create()->routeMap[$key] = RouteItem::create($key, $forward, $layout);
        return Route::create()->routeMap[$key];
    }

    

    /**
     * 
     */
    public static function any($key, $forward){
        Logger::log(__METHOD__.",行:".__LINE__, $key, $forward);
        if (WString::anyEmpty($key, $forward)){
            throw new WException();
        }
        if (isset(Route::create()->routeMap[$key])){
            return Route::create()->routeMap[$key];
        }
        Route::create()->routeMap[$key] = RouteItem::create($key, $forward);
        return Route::create()->routeMap[$key];
    }

    /**
     * 
     */
    public static function get($key){
        if (!WString::isEmpty($key) && isset(Route::create()->routeMap[$key])){
            return Route::create()->routeMap[$key];
        }
        return null;
    }

}