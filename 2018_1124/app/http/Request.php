<?php 
App::import('data/WString');
class Request {

    private $uri = null;
    private $outputData = array();
    private $viewData = array();
    private $errorData = array();

    private function __construct(){
        Logger::log(__METHOD__.",行:".__LINE__, "Request生成");
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $this->outputData = array([layout=>null, view => array()]);
        $this->viewData = array();
        $this->errorData = array();
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
    public function output(){
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        if (func_num_args() == 1){
            return $this->outputData[func_get_args()[0]];
        }
        else if (func_num_args() == 2){
            $this->outputData[func_get_args()[0]] = func_get_args()[1];
            return $this;
        }
        throw new Excption("args is error!");
    }

    /**
     * 出力のデータを保持する。
     * 
     */
    public function cotyInputToView(){
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        if (func_num_args() == 0){
            $this->viewData = array_merge($this->viewData, $this->outputData);
        }
        else {
            $arr = array();
            $values = func_get_args();
            foreach ($values as $vals){
                if (is_array($vals)){
                    foreach($vals as $val){
                        $inputVal = $this->input($val);
                        $arr[$val] = $inputVal == null ? "" : $inputVal;
                    }
                } else {
                    $inputVal = $this->input($vals);
                    $arr[$val] = $inputVal == null ? "" : $inputVal;
                }
            }
            $this->viewData = array_merge($this->viewData, $arr);
        }
        return $this;
    }

    /**
     * 出力のデータを保持する。
     * 
     */
    public function view(){
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        if (func_num_args() == 1){
            return $this->viewData[func_get_args()[0]];
        }
        else if (func_num_args() == 2){
            $this->viewData[func_get_args()[0]] = func_get_args()[1];
            return $this;
        }
        throw new Excption("args is error!");
    }

    public function error(){
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        if (func_num_args() == 1){
            $key = func_get_args()[0];
            return $this->errorData[$key];
        }
        else if (func_num_args() == 2){
            $key = func_get_args()[0];
            $value = func_get_args()[1];
            $this->errorData[$key] = $value;
            return $this;
        }
        throw new Excption("args is error!");
    }

    public function hasError(){
        $returnVal = false;
        if (count($this->errorData) >= 1){
            $returnVal = true;
        }
        return $returnVal;
    }

    /**
     * 出力のデータを保持する。
     * 
     */
    public function input(){
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        if (func_num_args() == 1){
            return $_REQUEST[func_get_args()[0]];
        }
        else if (func_num_args() == 2){
            //TODO ?
            return $this->output(func_get_args()[0], func_get_args()[1]);
        }
        throw new Excption("args is error!");
    }

    /**
     * URIを取得する。
     * 
     */
    public function getUri(){
        return $this->uri;
    }
}