<?php 
App::import('http/Session');
App::import('data/WString');
App::import('data/WArray');

/*********************************************
 *  リクエスト
 ********************************************/
class Request {

    /** 処理中設定されたパラメタ */
    private $outputData = null;
    /** ビュー表示するためのデータ */
    private $viewData = null;
    /** 処理で業務とか、エラーを格納 */
    private $errorData = null;
    /** リクエストにも元に、入力パラメタ */
    private $headData = null;
    /** セッション */
    private $session = null;

    private function __construct(){

        $this->outputData = WArray::create(null);
        $this->viewData = WArray::create(null);
        $this->errorData = WArray::create(null);
        $this->headData = WArray::create(null);
        $this->session = null;

        //Ajax
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        //IP
        $ip = null;
        //代理服务器添加的HTTP头的IP 格式为X-Forwarded-For: client1, proxy1, proxy2。
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } 
        //和服务器直接"握手"的IP
        elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        }
        elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        //URI
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->headData->put('ajax', $isAjax)
                    ->put('ip', $ip)
                    ->put('uri', $uri);

        //SESSION
        $this->session = Session::create();
    }

    private static $req = null;

    public static function create(){
        if (self::$req == null){
            self::$req = new Request();
        }
        return self::$req;
    }

    /**
     * 出力のデータを保持する。
     * 
     */
    public function output(...$params){
        if (count($params) == 1){
            return $this->outputData->get($params[0]);
        }
        else if (count($params) == 2){
            $this->outputData->put($params[0], $params[1]);
            return $this;
        }
        Logger::log(__METHOD__.",行:".__LINE__, $params, "params num is wrong");
        throw new Exception(__METHOD__ . "args is error!");
    }

    /**
     * 出力のデータを保持する。
     * 
     */
    public function copyInputToView(...$params){
        $list = WArray::create($params);
        if ($list->size() == 0){
            $this->viewData->addList($this->input());
            Logger::log(__METHOD__.",行:".__LINE__, $this->viewData);
        }
        else {
            foreach ($list->keys() as $key){
                $this->viewData->put($key, $this->input($key));
            }
        }
        Logger::log(__METHOD__.",行:".__LINE__, $this->viewData);
        return $this;
    }

    /**
     * 出力のデータを保持する。
     * 
     */
    public function view(...$params){
        $list = WArray::create($params);
        if ($list->size() == 1){
            return $this->viewData->get($list->get(0));
        }
        else if ($list->size() == 2){
            $this->viewData->put($list->get(0),$list->get(1));
            return $this;
        }
        return WArray::create()->addList($this->viewData);
    }

    public function error(...$params){
        $list = WArray::create($params);
        if ($list->size() == 0){
            return WArray::create()->addList($this->errorData);
        }
        else if ($list->size() == 1){
            return $this->errorData->get($list->get(0));
        }
        else if ($list->size() == 2){
            $this->errorData->put($list->get(0), $list->get(1));
            return $this;
        }
        Logger::log(__METHOD__.",行:".__LINE__, $params, "params num is wrong");
        throw new Exception(__METHOD__ . "args is error!");
    }

    public function hasError(){
        return !$this->errorData->isEmpty();
    }

    /**
     * 出力のデータを保持する。
     * 
     */
    public function input(...$params){

        $list = WArray::create($params);
        if ($list->isEmpty()){
            return WArray::create().addList($_REQUEST).addList($this->outputData);
        }
        else if ($list->size() == 1){
            return $_REQUEST[$params[0]];
        }
        else if ($list->size() == 2){
            return $this->outputData->put($list->get(0), $list->get(1));
        }
        Logger::log(__METHOD__.",行:".__LINE__, $params, "params num is wrong");
        throw new Exception(__METHOD__ . "args is error!");
    }

    /**
     * URIを取得する。
     * 
     */
    public function head($param){
        return $this->headData->get($param);
    }

    /**
     * URIを取得する。
     * 
     */
    public function getUri(){
        return $this->headData->get('uri');
    }

    /**
     * セッション
     * 
     */
    public function getSession(){
        return $this->session;
    }


    public function checkToken(){
        $token = $this->session->get('web_app_token');
        if ($token != null && $token == $this->input('web_app_token')) {
            return true;
        }
        return false;
    }





}