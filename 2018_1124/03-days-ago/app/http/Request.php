<?php 
App::import('data/WString');
class Request {

    private $uri = null;

    private function __construct(){
        Logger::log(__METHOD__.",行:".__LINE__, "Request生成");
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private static $req = null;

    public static function create(){
        if (self::$req == null){
            $req = new Request();
        }
        return $req;
    }

    /**
     * URIを取得する。
     * 
     */
    public function getUri(){
        return $this->uri;
    }
}