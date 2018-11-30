<?php 
App::import('data/WString');
class View {

	private static $instance = null;

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

    /**
     * 指定したファイルにより、URLを生成する。
     * 
     */
    public static function asset($path){
        return APP_SLASH.'public'.APP_SLASH.$path;
    }

    /**
     * 指定したファイルにより、URLを生成する。
     * 
     */
    public static function css($path){
        return self::asset('css'.APP_SLASH.$path);
    }

    /**
     * 指定したファイルにより、URLを生成する。
     * 
     */
    public static function img($path){
        return self::asset('img'.APP_SLASH.$path);
    }

    /**
     * 指定したファイルにより、URLを生成する。
     * 
     */
    public static function js($path){
        return self::asset('js'.APP_SLASH.$path);
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

    private function __construct(){
    }
    
    /**
     * 指定したファイルをインポトする。
     * 
     */
	public function includeFile($view){
        
        $viewPath = BASE_WEB_ROOT.APP_SLASH.'app/views'.APP_SLASH.implode(APP_SLASH, WString::create($view)->split(',')) . '.html.php';
		if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo $viewPath . "<br/>";
            echo $view;
        }
    }


    
}