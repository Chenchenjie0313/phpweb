<?php 

App::import('routes/Route');

/***
 * 
 * 
 */
class Dispatch {

    private static $instance = null;


    private $max = 100;

    private function __construct(){
        $this -> max = 100;
    }

    /**
     * オブジェクトを生成する。
     * 
     */
    public static function create(){
        if (self::$instance==null) {
            self::$instance = new Dispatch();
        }
        return self::$instance;
    }

    /***
     * 指定したアクションのメソッドを実行する。
     * 
     */
    private function invokeMethod($action, $method){
        Logger::log(__METHOD__.",行:".__LINE__, "invokeMethod : " ,$action , $method);
        
        try{
            App::import('action'.APP_SLASH.$action);
            $reflector = new ReflectionClass($action); // 建立class 
            $instance  = $reflector->newInstanceArgs(); // 实例化 
            $reflectionMethod = $reflector->getmethod($method); // 获取$method方法
            $forward = $reflectionMethod->invoke($instance, []);    // 执行$method方法　※パラメタ：空配列
            Logger::log(__METHOD__.",行:".__LINE__, "invokeMethod[終了] : " ,$forward);
            return $forward;
        } catch (Exception $e){
            Logger::log(__METHOD__.",行:".__LINE__, "invokeMethod[例外] : " ,$e);
            throw $e;
        }
    }


    /***
     * ルートアイテムにより、指定されたアクションを呼び出し、結果をリターンする。
     * リターン結果：文字列　OR false
     * 
     */
    public function dispatchRouter($item){
        if ($this -> max <= 0 ){
            return false;
        }
        $this -> max = $this -> max - 1;
        Logger::log(__METHOD__.",行:".__LINE__,"dispatchRouter[開始] ", $item, " MAX回数". $this->max);

        if ($item != null && is_object($item) && $item instanceof RouteNode){

            //Forwadが空白文字ではない。
            $forward = $item->getValue();
            
            if ($forward != null && is_callable($forward)){
                Logger::log(__METHOD__.",行:".__LINE__, "コールバック関数", $forward);
                $forward = call_user_func($forward);
            }
            
            Logger::log(__METHOD__.",行:".__LINE__, "コールバック関数", $forward);
            $forward = WString::create($forward);
            Logger::log(__METHOD__.",行:".__LINE__, "コールバック関数", $forward);

            if (!$forward->isEmpty()){
                Logger::log(__METHOD__.",行:".__LINE__, "コールバック関数", $forward);
                //アクションを呼び出するか
                if ($forward->match('/^(.+)@(.+)$/i')){
                    $actionAndMethod = $forward->split("@");
                    $returnVal = $this->invokeMethod($actionAndMethod[0],$actionAndMethod[1]);
                    if ($returnVal == null || $returnVal === false){
                        return false;
                    }
                    else if (is_string($returnVal)){
                        Logger::log(__METHOD__.",行:".__LINE__, "dispatchRouter [結果] : " ,$returnVal);
                        return $returnVal;
                    } 
                    else if ($returnVal instanceof RouteNode){
                        return $this->dispatchRouter($returnVal);
                    } 
                    else {
                        Logger::log(__METHOD__.",行:".__LINE__, "dispatchRouter [想定外結果を返した。] : " ,$returnVal);
                        return false;
                    }
                }
                else if ($forward instanceof WString){
                    return $forward->toString();
                }
                else {
                    return $forward;
                }
                    
            }
        } 
        //文字列の場合、そのまま返却
        else if ($item != null && is_string($item)){
            $s = WString::create($item);
            if (!$s->isEmpty()){
                return $s->toString();
            }
        }
        return false;

    }

    /**
     * 
     * URLからパスを取得して、パスにより、ルートアイテムを取得する。
     * ルートアイテムにより、APP処理を行い、結果的をリターンする。
     * 
     */
    public function excute(){

        //1.URLからパスを取得して、パスにより、ルートアイテムを取得する。
        $item = null;
        $uri = Request::create()->getUri();
        if (!WString::anyEmpty($uri)){
            $pathArray = WString::create($uri)->split(APP_SLASH);
            $realPath = "";
            foreach($pathArray as $path){
                if (WString::anyEmpty($path)){
                    continue;
                } else if ($realPath == "") {
                    $realPath = $path;
                } else {
                    $realPath .= APP_SLASH.$path;
                }
            }
            Logger::log(__METHOD__.",行:".__LINE__, "dispatchRouter [パス] : " . $realPath);
            
            //キーにより、ルートを取得する。
            //$realPath = aaa/bbb
            $target = Route::get($realPath);
            Logger::log(__METHOD__.",行:".__LINE__, $target);
            if ($target == null){
                throw new Exception("ルートが存在していない。");
            }
            //ノードにより、処理を実行し、結果を返す。
            else {
                return $this->dispatchRouter($target);
            }

        }
    }

}