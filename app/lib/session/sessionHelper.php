
<?php


class SessionHelper{

    public static function OpenSession(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
            self::init();
            Utils::WriteLog("セッションがスタート。SESSION_ID : " , session_id());
        }
    }

    public static function init(){
        self::put('sessionUtil_token',session_id());
        //Get config from const.xml
        $dom = new DocumentHelper($_SERVER['DOCUMENT_ROOT'] . '/upload/const.xml');
        $dom->load();
        $config = $dom->saveAsArray();
        //設定情報をセッションにセットする。
        self::put('sessionUtils_config',$config);

    }
    /**
     * 値をセッションに詰める。
     */
    public static function put($key,$obj){
        $_SESSION[$key] = $obj;
    }

    /**
     * 値をセッションに詰める。
     */
    public static function clear($key){
        unset($_SESSION[$key]);
    }

    /**
     * 値をセッションに詰める。
     */
    public static function has($key){
        return isset($_SESSION[$key]);
    }

    /**
     * 値をセッションに詰める。
     */
    public static function get($key){
        if(self::has($key)){
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

}