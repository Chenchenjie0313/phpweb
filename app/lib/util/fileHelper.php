<?php

class FileHelper{

    public function __construct(){
        
    }

    public static function getText($url){
        //ファイルがない場合、FALSEをリターンする。
        if(!file_exists($url)){
            return false;
        }
        //readfile("webdictionary.txt");
        //file_get_contents
        $myfile = fopen($url, "r");
        $txt = '';
        while(!feof($myfile)) {
           $txt .= fgetc($myfile);
        }
        fclose($myfile);    
        return $txt;
    }

    /**
     * テキストをファイルに保存する
     * ファイル先パス
     * 保存の内容
     * 
     */
    public static function creatNewOrEditText($url,$txt){

        Utils::WriteLog(__FILE__ . __FUNCTION__ . __LINE__ . '行'  , $url, $txt);

        $myfile = fopen($url, "w");
        if($myfile == false){
            Utils::WriteLog(__FILE__ . __FUNCTION__ . __LINE__ . '行 Error ... '  , $url, $txt);
            return false;
        }
        fwrite($myfile, $txt);
        fclose($myfile);
        return true;
    }

    
    public static function creatNewText($url,$txt){
        if(file_exists($url)){
            return false;
        }
        return creatNewOrEditText($url, $txt);
    }

    public static function editText($url,$txt){
        if(！file_exists($url)){
            return false;
        }
        $myfile = fopen($url, "w");
        fwrite($myfile, $txt);
        fclose($myfile);
        return true;
    }

    /**
     * ファイルをアップロード
     * ファイル項目のキー
     * ファイル先のパス
     */
    public static function fileUpload($filesKey, $uploadPath){
        
        Utils::WriteLog(__FILE__ . __FUNCTION__ . __LINE__ . '行'  , $filesKey, $uploadPath);

        try{
            $filename = date("Ymd") . "_" . $_FILES[$filesKey]["name"];
            $saveFile = $uploadPath . '/' . $filename;

            if (file_exists($saveFile)) {
                Utils::WriteLog(__FILE__ . __FUNCTION__ . __LINE__ . "Sorry, there was an existing your file.");
                return false;
            } else {
                if(move_uploaded_file($_FILES[$filesKey]["tmp_name"], $saveFile)){
                    return true;
                }
                Utils::WriteLog(__FILE__ . __FUNCTION__ . __LINE__ . "Sorry, there was an error uploading your file.");
            }
            return false;

        }catch(Exception $e){
            Utils::WriteLog(__FILE__ . __FUNCTION__ . __LINE__ . $e->getMessage());
            return false;
        }
    }


    /***
     * TODO:
     * 
     */
    public static function fileUpload2($url, $path){

        $newfname = $path;
        $file = fopen ($url, 'rb');
        if ($file) {
            $newf = fopen ($newfname, 'wb');
            if ($newf) {
                while(!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                }
            }
        }
        if ($file) {
            fclose($file);
        }
        if ($newf) {
            fclose($newf);
        }

    }

    public static function array2xml($xml,$isfile=false){
        if($isfile){
            if(!file_exists($xml)) return false;
            $xmlstr = file_get_contents($xml);
        }else{
            $xmlstr = $xml;
        }
        $result= json_decode(json_encode(simplexml_load_string($xmlstr, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

    }

    public static function xml2array($path){

    }

    public static function xml($filePath){
        //如果成功则返回 SimpleXMLElement 对象，如果失败则返回 FALSE。
        $xml=simplexml_load_file("note.xml");
        if($xml===FALSE){
            //current 当前元素
            //getChildren 当前元素的子元素
            //hasChildren 当前元素是否有子元素
            //key 当前键
            //next 移动到下一个元素
            //rewind 倒回到第一个元素
            //valid 检查当前元素是否有效


            
        }
        return NULL;

    }

    public static function array2csv($array,$filePath){
        $csv = fopen($filePath,'w');
        foreach($array as $key => $values){
            fputcsv($csv, $values);
        }
        fclose($csv);
        $csv = NULL;
    }

    public static function csv2array($filePath){
        $csv = fopen($filePath,'r');
        while($result = fgetcsv($csv, 1024)){
            //TOOD:
        }
        fclose($csv);
        $csv = NULL;

    }
}