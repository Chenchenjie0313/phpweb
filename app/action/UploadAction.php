<?php

App::import('action/Action');
App::import('file/File');
App::import('db/UploadFileTable');

/**
 * 
 */
class  UploadAction extends Action{

    public function __construct(){
        parent::__construct();
    }

    /***
     * ファイルアップロードする。
     * 
     */
    public function upload(){
        Logger::log(__METHOD__.",行:".__LINE__, "ファイルアップロードする。");

        //ユーザがログインしているかどうか
        if(parent::isLogin()==false){
            Error::add("header", 'ログインしてください。');
            return "|parts,inquiry2";
        }

        //入力チェック
        $type = WString::create(Input::get('type'));
        if ($type->isEmpty()){
            Error::add("type", 'type is error。');
        }

        $text = WString::create(Input::get('text'));
        if ($text->isEmpty()){
            Error::add("text", 'text is error。');
        }
        
        $file = $_FILES["file"];
        if ($file == null){
            Error::add("file", 'file is error。');
        } else {
            //アップロードできるファイル
            $allowedExts = array("gif", "jpeg", "jpg", "png", "txt");

            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);

            $fileType = $_FILES["file"]["type"];

            if ($fileType != "image/gif"
                && $fileType != "image/jpeg"
                && $fileType == "image/jpg"
                && $fileType == "image/pjpeg"
                && $fileType == "image/x-png"
                && $fileType == "image/png"
                && $fileType == "text/plain"){
                    Logger::log(__METHOD__.",行:".__LINE__, $fileType);
                    Error::add("file", 'fileType is error。');
                } else if ($_FILES["file"]["size"] >= 2 * 1024 * 10240){ //1024字节 = 1KB 1024KB = 1M
                    Logger::log(__METHOD__.",行:".__LINE__, $fileType);
                    Error::add("file", 'file size is error。');
                }
        }
        //has errors 
        if (!Error::isEmpty()){
            return "|parts,inquiry2";
        }
        //ファイルをアップロードする。
        if(File::fileUpload('file', BASE_WEB_ROOT .APP_SLASH. 'public'.APP_SLASH.'upload') === true){
            //ファイルをDBに保存する。 
            Logger::log(__METHOD__.",行:".__LINE__, $fileType);                   
            Error::add("header", 'アップロードしました。');
            $table = new UploadFileTable();
            $table->createNewTable();
            //$table->insert();

        } else {
            Logger::log(__METHOD__.",行:".__LINE__, $fileType);
            Error::add("header", 'アップロードを失敗しました。');

        }
        
        return "|parts,inquiry2";
    }

}