<?php 
class Logger {

    private function __construct(){

    }
    
    public static function log(...$params){
        if(count($params) == 0){
            return ;
        }
        $time=time();
        $file = BASE_WEB_ROOT.APP_SLASH.'app'.APP_SLASH.'txt'.APP_SLASH.date("Y_md",$time) . ".log";
        $logMsg = "";
        foreach($params as $key => $value){
            $msg = self::toString($value);
            $msg = preg_replace("/\r\n|\r|\n|\t/", ' ', $msg);
            $msg = trim(preg_replace("/\s/", ' ', $msg));
            $logMsg = $logMsg . "; ". $msg; 
        }
        self::wrieteLog($logMsg);
    }

    /**
     * ログを出力
     */
    public static function wrieteLog($logMsg){
        $time=time();
        $file = BASE_WEB_ROOT.APP_SLASH.'app'.APP_SLASH.'txt'.APP_SLASH.date("Y_md",$time) . ".log";
        if($logMsg != null){
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
        } else if (is_object($obj)){
            $msg = $msg . var_export($obj, true);
        } else {
            $msg = $msg . json_encode($obj);
        }
        
        return $msg;
    }
	
}