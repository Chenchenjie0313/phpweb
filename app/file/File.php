<?php 

class File {    
    
    /**
     * ファイルをアップロード
     * ファイル項目のキー
     * ファイル先のパス
     */
    public static function fileUpload($filesKey, $uploadPath){
        
        Logger::log(__METHOD__.",行:".__LINE__, $filesKey, $uploadPath);
        try{
            $filename = date("Ymd") . "_" . $_FILES[$filesKey]["name"];
            $saveFile = $uploadPath . APP_SLASH . '1.txt';//$filename;

            if (file_exists($saveFile)) {
                Logger::log(__METHOD__.",行:".__LINE__, $filesKey, $uploadPath);
                return false;
            } else {
                chmod($uploadPath, 755); 
                if ( move_uploaded_file($_FILES[$filesKey]["tmp_name"], $saveFile) ){
                    Logger::log(__METHOD__.",行:".__LINE__, $filesKey, $saveFile);
                    return true;
                }
            }
            Logger::log(__METHOD__.",行:".__LINE__, $filesKey, $saveFile);
            return false;

        }catch(Exception $e){
            Logger::log(__METHOD__.",行:".__LINE__, $e);
            return false;
        }
    }
}