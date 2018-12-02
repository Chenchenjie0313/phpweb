<?php



/**
 * 
 */
class  Action{

    public function __construct(){
    }


    /**
     * ログインしているかとうか
     * 
     */
    protected function isLogin(){
        $webUserInfo = Request::create()->getSession()->get('web_user_info');
        if ($webUserInfo == null){
            return false;
        }
        return true;
    }

}