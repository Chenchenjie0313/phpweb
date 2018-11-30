<?php



App::import('/web/lib/action/action.php');

class Controller{

    private static $instance;
    public static function create () {
        return new Controller();
    }
    /***
     * 
     */
    public function __construct(){

    }


    public function run(){

        $request = Request::newInstance();

        $action = $request->input('action');
        $method = $request->input('method');
        if(StringHelper::isRealEmpty($action) || StringHelper::isRealEmpty($method)){
            return false;
        }
        
        $forward = Forward::create("ACTION", $action, $method);

        $maxIndex = 100;
        while($forward instanceof Forward &&  $forward->input("type") == "ACTION" && $maxIndex > 0){
             $maxIndex--;
             $forward = $this->invokeMethod($forward);
        }

        // if($action == null || $method == null){
        //     throw New Exception( "NULL. CLASS : " . __CLASS__ . ",FUNCTION : " . __FUNCTION__ . ". " . __LINE__ . "行 .");
        // }
        // $action = strtolower($action);
        // $classPath = "/web/action/{$action}" . "Action.php";
        // App::import($classPath);
        // $class = ucwords($action) . "Action";
        // $reflector = new ReflectionClass($class); // 建立class 
        // $instance  = $reflector->newInstanceArgs(); // 相当于实例化Person 类 
        // $reflectionMethod = $reflector->getmethod($method); // 获取$method方法

        // Utils::WriteLog($class , $method, "runing...");
        // $_REQ = array_merge($_GET,$_POST);
        // $forward = $reflectionMethod->invoke($instance,$_REQ);    // 执行$method方法 方法
        // Utils::WriteLog("forward : ", $forward);
        return $forward;
    }

    private function invokeMethod(Forward $forward){
        $action = $forward->input('action');
        $method = $forward->input('method');
        Logger::log(__FILE__, __LINE__, "invokeMethod : " ,$action , $method);

        if(StringHelper::isRealEmpty($action) || StringHelper::isRealEmpty($method)){
            return false;
        }
        try{
            $action = strtolower($action);
            $classPath = "/web/action/{$action}" . "Action.php";
            App::import($classPath);
            $class = ucwords($action) . "Action";
            $reflector = new ReflectionClass($class); // 建立class 
            $instance  = $reflector->newInstanceArgs(); // 相当于实例化Person 类 
            $reflectionMethod = $reflector->getmethod($method); // 获取$method方法
    
            Logger::log(__FILE__, __LINE__, "実行前：" ,$class , $method, "start...");
            $forward = $reflectionMethod->invoke($instance, Request::newInstance()->cloneInput());    // 执行$method方法 方法
            Logger::log(__FILE__, __LINE__, "実行後：", $class , $method, "end...", " [Forwad]" , $forward->toJson());
            return $forward;
        } catch (Exception $e){
            throw $e;
        }


    }

}