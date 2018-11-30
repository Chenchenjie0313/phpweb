<?php 

class App {
	private static $instance = null;

    public static function create(){
        if (self::$instance == null){
            self::$instance = new App();
        }
        return self::$instance;
    }

    /**
     * 指定したPHPファイルをインポトする。
     * 
     */
    public static function import($class){
        $app = self::create();
        $app->importClass($class);
        return $app;
    }

    private $map = null;

    private function __construct(){
        $this->map = array();
        /**
         * 設定ファイルをインクルードする。
         */
        $this->importClass('config/StartApp');
        $this->importClass('config/WRoute');
    }


    private function exists($key){
        return isset($this->$map[$key]);
    }
    
    /***************************************
     * 指定したPHPファイルをインポトする。
     * 
     ***************************************/
	public function importClass($class){
        $classPath = BASE_WEB_ROOT . '/app/' . $class . '.php';
		if (!$this->exists($class) && file_exists($classPath)) {
            $this->map[$key] = true;
            require_once $classPath;
        }
    }
}
