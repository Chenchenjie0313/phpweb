<?php 

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
            return ;
        }
        $this -> max = $this -> max - 1;
        Logger::log(__METHOD__.",行:".__LINE__,"dispatchRouter[開始] ", $item, " MAX回数". $this->max);

        if ($item != null && is_object($item) && $item instanceof RouteNode){

            //Forwadが空白文字ではない。
            $forward = $item->getForward();
            
            if ($forward != null && is_callable($forward)){
                Logger::log(__METHOD__.",行:".__LINE__, "コールバック関数", $forward);
                $forward = call_user_func($forward);
            }

            if (!WString::isEmpty($forward)){
                //アクションを呼び出するか
                if (WString::create($forward)->match('/^(.+)@(.+)$/i')){
                    $actionAndMethod = WString::create($forward)->split("@");
                    $returnVal = $this->invokeMethod($actionAndMethod[0],$actionAndMethod[1]);
                    if ($returnVal == null || $returnVal === false){
                        return false;
                    }
                    else if (is_string($returnVal)){
                        Logger::log(__METHOD__.",行:".__LINE__, "dispatchRouter [結果] : " ,$returnVal);
                        return $returnVal;
                    } 
                    else if ($returnVal instanceof RouteItem){
                        return $this->dispatchRouter($returnVal);
                    } 
                    else {
                        Logger::log(__METHOD__.",行:".__LINE__, "dispatchRouter [想定外結果を返した。] : " ,$returnVal);
                        return false;
                    }
                }
                else {
                    return $forward;
                }
                    
            }
        } 
        //文字列の場合、そのまま返却
        else if ($item != null && !WString::isEmpty($item)){
            return $item;
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
        if (!WString::isEmpty($uri)){
            $pathArray = WString::create($uri)->split(APP_SLASH);
            Logger::log(__METHOD__.",行:".__LINE__, $pathArray);
            if ($pathArray !== false){
                foreach($pathArray as $path){
                    if (!WString::isEmpty($path)){

                        //キーにより、ルートを取得する。
                        $target = Route::get($path);

                        if ($target == null){
                            throw new Exception("ルートが存在していない。");
                        }
                        //2.Uルートアイテムにより、APP処理を行い
                        else if (is_object($target) && $target instanceof RouteNode){
                            Logger::log(__METHOD__.",行:".__LINE__, "RouteNode", $target);
                            $item = $this->dispatchRouter($target);
                        }
                        //文字列の場合、
                        else if (is_string($target)){
                            Logger::log(__METHOD__.",行:".__LINE__, "文字列", $target);
                            $item = $target;
                        }
                        break;

                    }
                }
            }

        }
        //3.APP処理結果的をリターンする。
        if ($item != null && is_string($item)){
            return $item;
        }
        return WEB_APP_DEFAULT_VIEW;
    }

}