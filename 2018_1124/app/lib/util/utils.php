<?php

class Utils{

    public static function APP_CONFIG_JSON_DATA(){
        $token = SessionHelper::get("user_token");
        return json_encode([

            //{id : 'homeView', display : true, pageid : "homeView", display : true}
            'config' => [
                'token' => (empty($token) ? null : $token ),
                'map' => [
                    'workCarouselView' => [id => 'workCarouselView', type => 2], //スライドショー
                    'workCarouselView' => [id => 'foodCarouselView', type => 2], //スライドショー
                    'homeView' => [   //ホーム
                        id => 'homeView',
                        pageid => 'homeView',
                        type => 4,
                        BaseView => [ [id => 'baseShopInfoCard' ], [id => 'subBaseShopInfoCard'] ],
                        CarouselView => [ [id => 'subWorkCarouselView'], [id => 'foodCarouselView'] ]
                    ],
                    'foodMenuList' => [   //料理
                        id => 'foodMenuList',
                        pageid => 'foodMenuList',
                        type => 4,
                        BaseView => [ [id => 'footMenuListBaseCard'] ],
                        CarouselView =>[ [id => 'footMenuListCarouselCard'] ] 
                    ],
                    'noticeList' => [   //お知らせ
                        id => 'noticeList',
                        pageid => 'noticeList',
                        type => 0,
                        BaseView => [ ],
                        CarouselView =>[ ] 
                    ],
                    'loginView' => [   //ログイン
                        id => 'loginView',
                        pageid => 'loginView',
                        templateUrl => '/templete/login.txt',
                        type => 1,
                        BaseView => [ ],
                        CarouselView =>[ ] 
                    ],
                    'help' => [   //ヘルプ
                        id => 'help',
                        pageid => 'help',
                        type => 0,
                        BaseView => [ ],
                        CarouselView =>[ ]
                    ],
                    'todo' => [   //TODO
                        id => 'todo',
                        pageid => 'todo',
                        type => 0,
                        BaseView => [ ],
                        CarouselView =>[ ],
                        display => true,
                        cache => false,
                        template => false,
                        templateUrl => '/?method=getTemplate&action=show&templateid=listTemplate',
                        // templateUrl => '/templete/listTemplate.txt',
                        templateData => null,
                        templateDataUrl => '/?',
                        beforeTemplate => false,
                        afterTemplate => false
                    ]
                ]
            ]
        ]);
    }

    /**
     * 
     */
    public static function isAuth(){

        $token = SessionHelper::get("user_token");
        if($token == null){
            return false;
        }
        //SessionHelper::put('user_info',[id=>$id, login => true]);
        $user_info = SessionHelper::get("user_info");
        
        if($user_info['login'] === true){
            return true;
        }
        return false;
    }

    public static function isToken($token){
        if(Validator::isEmpty($token)) {
            return false;
        }
        $nowToken = SessionHelper::get("user_token");


        Utils::WriteLog("token => ${token} , nowToken : " . $nowToken , 1);
        

        //$oldToken = SessionHelper::get("old_user_token");
        if($token == $nowToken){
            return true;
        }
        return false;
    }

    /**
     * ユーザトークンコードを生成する。
     * 
     */
    public static function userToken($crypto_strong = true){
        $TOKEN_LENGTH = 16;//16*2=32バイト
        $bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH, $crypto_strong); //希望するバイト長 強い場合は TRUE
        return bin2hex($bytes);
    }

    public static function ip(){
        //代理服务器添加的HTTP头的IP 格式为X-Forwarded-For: client1, proxy1, proxy2。
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } 
        //和服务器直接"握手"的IP
        elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        }
        elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        //
        self::WriteLog('utils.php ip ' . $ip);
        return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    }

    /**
     * OPEN SESSION
     */
    public static function OpenSession(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
            Utils::WriteLog("セッションがスタート。SESSION_ID : " . session_id() , 1);
        }
        //$_SESSION
        //session_destroy();
    }

    /**
     * Write web log.
     */
    public static function WriteLog(){
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        if(func_num_args() == 0){
            return ;
        }

        $time=time();
        // $file = $_SERVER['DOCUMENT_ROOT'] . '/log/' .  date("Ymd",$time) . ".log";
        $file = $_SERVER['DOCUMENT_ROOT'] . '/log/' .  date("Y_md",$time) . ".log";
        $logMsg = "";


        foreach(func_get_args() as $key => $value){
            $msg = self::toString($value);
            $msg = preg_replace("/\r\n|\r|\n|\t/", ' ', $msg);
            $msg = trim(preg_replace("/\s/", ' ', $msg));
            $logMsg = $logMsg . "; ". $msg; 
        }
        if($logMsg != "" || true){
            $logMsg = date("[Y-m-d H:i:s]",$time) . " ". trim($logMsg) . "\r\n";
            error_log($logMsg, 3, $file);
        }
    }
    
	public static function toString($obj){
        $msg = "";
        if($obj == NULL && $obj !== 0 && $obj !== ''){
            $msg = $msg . "null";
        } else if(is_array($obj)){
            $msg = $msg . '[';
            $flag = false;
            foreach($obj as $key => $value){
                if ($flag){
                    $msg = $msg . ", ";
                } else {
                    $flag = true;
                }
                $msg = $msg . $key . "=>";
                $msg = $msg . self::toString($obj[$key]);
            }
            $msg .= ']';
        } else if(is_string($obj)){
            $msg = $msg . "" . $obj;
        } else if(is_numeric($obj)){
            $msg = $msg . "[numeric]".$obj;
        } else if(is_bool($obj)){
            $msg = $msg . "[bool]".$obj;
        } else {
            $msg = $msg . json_encode($obj);
        }
        
        return $msg;
    }
	
	
}
