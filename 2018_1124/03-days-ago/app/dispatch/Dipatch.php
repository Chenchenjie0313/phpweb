<?php 
class Dispatch {

    private static $instance = null;

    private function __construct(){}

    /**
     * 
     */
    public static function create(){
        if (self::$instance==null) {
            self::$instance = new Dispatch();
        }
        return self::$instance;
    }

    /**
     * 
     */
    public function excute(){
        $item = null;
        $uri = Request::create()->getUri();
        if (!WString::isEmpty($uri)){
            $pathArray = WString::create($uri)->split(APP_SLASH);            
            Logger::log(__METHOD__.",行:".__LINE__, $pathArray);
            if ($pathArray !== false){
                Logger::log(__METHOD__.",行:".__LINE__, "is not false");
                foreach($pathArray as $path){
                    if (!WString::isEmpty($path)){
                        Logger::log(__METHOD__.",行:".__LINE__, $path);
                        $item = Route::get($path);
                        break;
                    }
                }
            }

        }
        Logger::log(__METHOD__.",行:".__LINE__, $item);

        if ($item != null){
            if ($item instanceof RouteItem){
                return $item->getForward();
            } else if (is_string($item)){
                return $item;
            }

        }
        return 'index';
    }




}