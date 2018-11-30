<?php 
App::import('data/WString');


class View {

    private static $instance = null;
    
    private $once_head_flag = false;

    private $viewArray = null;
    
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

    /***
     * トークンのINPUTを生成出力する。
     * 
     */
    public static function token($crypto_strong = true){
        $TOKEN_LENGTH = 16;//16*2=32バイト
        $bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH, $crypto_strong); //希望するバイト長 強い場合は TRUE
        $newToken = bin2hex($bytes);
        //save to session
        Session::create()->add("web_app_token", $newToken);
        return "<input type='hidden' name='web_app_token' value='".htmlspecialchars($newToken)."' />";
    }

    public static function checked($name,$value){
        $outputValue = self::output($name, true);
        if ($outputValue == $value){
            return ' checked="checked" ';
        }
        return " ";
    }

    public static function hidden(...$params){
        $returnVal = "";
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        if ($params != null && count($params) > 0){
            foreach ($params as $val){
                if ($val != null && is_string($val)){
                    $returnVal = $returnVal . "<input type='hidden' name='".$val."' value='".self::output($val)."' />";
                }
            }
        }
        return $returnVal;
    }

    

    /**
     * 指定したファイルにより、URLを生成する。
     * 
     */
    public static function asset($path){return APP_SLASH.'public'.APP_SLASH.$path.'?ver=1';}

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
        if ($app->viewArray != null && $app->viewArray->size() >1){
            self::view($app->viewArray->get(1));
        }
    }

    /**
     * 指定したビューをインクルードする。
     * 
     */
    public static function view($view){
        Logger::log(__METHOD__.",行:".__LINE__, $view);
        $app = self::create();
        
        $s = WString::create($view);
        $arr = WArray::create($s->split('|'));
        Logger::log(__METHOD__.",行:".__LINE__, $arr);

        if ($arr->size() > 1){
            $app->viewArray = $arr;
            if ( WString::isEmpty($arr->get(0)) ){
                $app->includeFile("layouts,layout");
            } else {
                $app->includeFile("layouts,".$arr->get(0));
            }
        } else {
            $app->includeFile($view);
        }
        return $app;
    }

    
    /**
     * 指定したファイルをインポトする。
     * 
     */
	public function includeFile($view){
        //Header
        $this->once_head();
        $viewPath = BASE_WEB_ROOT.APP_SLASH.'app/views'.APP_SLASH.implode(APP_SLASH, WString::create($view)->split(',')) . '.html.php';
		if (file_exists($viewPath)) {
            Logger::log(__METHOD__.",行:".__LINE__, $viewPath);
            include $viewPath;
        } else {
            Logger::log(__METHOD__.",行:".__LINE__, "対象ビューがない。".$viewPath);
            echo $view;
            echo $viewPath;
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