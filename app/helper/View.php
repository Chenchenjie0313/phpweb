<?php 
App::import('data/WString');
class View {

    private static $instance = null;
    
    private $once_head_flag = false;
    
    private function __construct(){
        $this->once_head_flag = false;
    }

    public static function create(){
        if (self::$instance == null){
            self::$instance = new View();
        }
        return self::$instance;
    }

    /**
     * 指定したファイルにより、URLを生成する。
     * 
     */
    public static function url($path){
        if ($path == "/"){
            return APP_SLASH;
        } else {
            return APP_SLASH.$path;
        }
    }

    
    public static function outputList($key, $list = [], $defautVal=""){
        $index=self::output($key, true);
        if (isset($list[$index])){
            return $list[$index];
        }
        return $defautVal;
    }

    public static function output($key, $flag = false, $defautVal=""){
        $value = Request::create()->view($key);
        if (!isset($value)){
            $value = Request::create()->output($key);
        }
        if ($value == null){$value = $defautVal;}
        if ($flag !== true){
            $value = htmlspecialchars($value);
        }
        return $value;
    }

    public static function error($key,$pre="",$last="<br/>"){
        //Logger::log(__METHOD__.",行:".__LINE__,"Requestのデータ", Request::create());

        $value = Request::create()->error($key);
        Logger::log(__METHOD__.",行:".__LINE__,"error : ",$key, $value);
        if (!isset($value) || WString::isEmpty($value)){
            return "";
        }
        return $pre.'<span style="color:red"><b>'.$value.'</b></span>'.$last;
    }

    public static function checked($name,$value){
        $outputValue = self::output($name, true);
        if ($outputValue == $value){
            return ' checked="checked" ';
        }
        return " ";
    }

    public static function hidden(){
        $returnVal = "";
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        if (func_num_args() > 0){
            $values = func_get_args();
            
            foreach ($values as $val){
                if ($val != null && is_string($val)){
                    $returnVal = $returnVal . "<input type='hidden' name='".$val."' value='".self::output($val)."' />";
                }
            }
        }
        Logger::log("hidden", Request::create());
        Logger::log("hidden", $returnVal);
        return $returnVal;
    }

    

    /**
     * 指定したファイルにより、URLを生成する。
     * 
     */
    public static function asset($path){return APP_SLASH.'public'.APP_SLASH.$path;}

    /**
     * 指定したファイルにより、URLを生成する。
     * 
     */
    public static function css($path){return self::asset('css'.APP_SLASH.$path);}

    /**
     * 指定したファイルにより、URLを生成する。
     * 
     */
    public static function img($path){return self::asset('img'.APP_SLASH.$path);}

    /**
     * 指定したファイルにより、URLを生成する。
     * 
     */
    public static function js($path){return self::asset('js'.APP_SLASH.$path);}

    /**
     * 指定したビューをインクルードする。
     * 
     */
    public static function layoutSubView(){
        $app = self::create();
        $view = Request::create()->output('layout_view');
        self::view($view);
    }

    /**
     * 指定したビューをインクルードする。
     * 
     */
    public static function view($view){
        Logger::log(__METHOD__.",行:".__LINE__, $view);
        $app = self::create();
        $app->includeFile($view);
        return $app;
    }

    
    /**
     * 指定したファイルをインポトする。
     * 
     */
	public function includeFile($view){
        //Header
        //$this->once_head();
        $viewPath = BASE_WEB_ROOT.APP_SLASH.'app/views'.APP_SLASH.implode(APP_SLASH, WString::create($view)->split(',')) . '.html.php';
		if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo $view;
        }
    }

    public function once_head(){
        if ($this->once_head_flag === false){
            $this->once_head_flag = true;
            //文字コードはUTF-8
            header('conten-type:text/html;charset=utf-8');
            header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
            header( 'Cache-Control: no-store, no-cache, must-revalidate' );
            //header( 'Cache-Control: post-check=0, pre-check=0', false );
            header( 'Pragma: no-cache' );

        }
    }


    
}