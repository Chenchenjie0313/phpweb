<?php

App::import('action/Action');

class SettingAction extends Action{

    public function __construct(){
        parent::__construct();
        
    }


    /**
     * 定数設定画面
     */
    public function showEdit($_QUE){

        //初期値
        $title = '';
        $type = 0;
        $id = '';
        $edit = '';
        $msg = '';

        $isNew = true;
        // IDがあった場合、タイトル、コンテンツを設定する。
        if($_QUE['id'] != null && $_QUE['id'] != ''){
            $id = $_QUE['id'];
            $sql = 'SELECT ID,TITLE,TYPE FROM BLOG WHERE id = ?';
            $blod = Helper::open()->query($sql,[
                'i',
                $id
            ]);
            if($blod != null && count($blod) > 0){
                $isNew = false;
                $id = $blod[0];
                $title = htmlspecialchars($blod[1], ENT_QUOTES);
                $type = $blod[2];
                $path = $_SERVER['DOCUMENT_ROOT'] . "/upload/" . $type . '_' . $id . '.txt';
                $edit = FileHelper::getText($path);
                if($edit === false){
                    $edit = "";
                    $msg = "コンテンツが存在されていない。[ID:${id},PATH:${path}]";
                }
               
            } else {
                $isNew = false;
                $msg = "データが存在されていない。[ID:${id}]";
            }

        }

        if($isNew){
            $type = 0;
            $title = '';
            $id = '';
            $edit = '';

        }

        Request::newInstance()->output("msg", $msg)
                        ->output("statusCode", ０)
                        ->output("insert", [
                            'title' => $title,
                            'type' => $type,
                            'id' => $id,
                            'edit' => $edit
                        ]);
        return Forward::createAjaxJson();
    }

    /**
     * ファイルアップロードする。
     * AJAXと想定する。
     * 
     */
    public function uploadFile(){
        Logger::log(__METHOD__.",行:".__LINE__, "ファイルアップロードする。");

        //ユーザがログインしているかどうか
        if(Auth::isLogin()==false){
            Error::add("header", 'ログインしてください。');
            return ;
        }

        //入力チェック
        $type = Input::get('type');
        if ($type->isEmpty()){
            Error::add("type", 'type is error。');
        }

        //アップロードできるファイル
        $allowedExts = array("gif", "jpeg", "jpg", "png", "txt");

        $temp = explode(".", $_FILES["file"]["name"]);

        $extension = end($temp);
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "text/plain"))
        && ($_FILES["file"]["size"] < 2 * 1024 * 10240)  //1024字节 = 1KB 1024KB = 1M
        && in_array($extension, $allowedExts)) {

            if ($_FILES["file"]["error"] > 0) {
                return [
                    statusCode => 99,
                    error => $_FILES["file"]
                ];
            } else {
                $filename = $label.$_FILES["file"]["name"];
                $var1 =  "Upload: " . $_FILES["file"]["name"] . "<br>";
                $var2 =  "Type: " . $_FILES["file"]["type"] . "<br>";
                $var3 =  "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                $var4 =  "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                //ファイルをアップロードする。
                if(FileHelper::fileUpload('file', $_SERVER['DOCUMENT_ROOT'] . '/upload') === true){
                    //ファイルをDBに保存する。                    
                    Error::add("header", 'アップロードを失敗しました。');
                    return ;

                }
            }
        }

        return ;

    }

    /**
     * ブログ・お知らせを保存する。
     * 
     */
    public function saveToTemplet($_QUE){
        
        //権限チェック
        if(Utils::isAuth()==false){
            Request::newInstance()->output("msg", '権限が足りない。')
                        ->output("statusCode", 99);
            return Forward::createAjaxJson();
            //return [ statusCode => 99, msg => '権限が足りない。' ];
        }

        //登録・更新

        //1.リクエストから必要のパラメタを取得
        $id = '01';
        $id = $_QUE['id'];  //id
        $title = $_QUE['title'];  //title
        $edit = $_QUE['edit'];  //edit
        $type = $_QUE['type'];  //edit

        //2.項目チェックを行う。
        if($title == null || $title == ''){

            Request::newInstance()->output("msg", 'title is null')
                        ->output("statusCode", 99);
            return Forward::createAjaxJson();
        }
        if($edit == null || $edit == ''){
            Request::newInstance()->output("msg", 'edit is null')
                        ->output("statusCode", 99);
            return Forward::createAjaxJson();
        }
        if($type == null || $type == ''){
            Request::newInstance()->output("msg", 'type is null')
                        ->output("statusCode", 99);
            return Forward::createAjaxJson();
        }

        $boldid = null;
        $insert = null;
        $msg = "";
        //3.IDが設定された場合、更新処理を行う。
        if($id != null && $id != ''){
            //3.1.当該IDの情報収集
            $boldid = $id;
            $sql = 'SELECT ID,TITLE,TYPE FROM BLOG WHERE id = ?';
            $blod = Helper::open()->query($sql,[
                'i',
                $boldid
            ]);
            if($blod != null && count($blod) > 0){
               //3.1.タイプが不一致の場合、エラー
                if($blod[2] != $type){
                    Request::newInstance()->output("msg", 'type is not same.[ID:' . $boldid .']')
                                ->output("statusCode", 99);
                    return Forward::createAjaxJson();

                } else {
                    $sql = 'update BLOG set TITLE = ?, SYS_UPDATE = now() WHERE id = ?';
                    $rowNum = Helper::open()->execute($sql,[
                        'si',
                        $title,
                        $boldid
                    ]);
                    $msg = "更新しました。[ID:${boldid}]";
                }

            } else {
                //3.1.当該IDが登録されない場合、エラー
                    Request::newInstance()->output("msg", 'data is null.[ID:' . $boldid .']')
                    ->output("statusCode", 99);
                    return Forward::createAjaxJson();
            }

        } else {
            //4.IDが設定されなかった場合、登録処理を行う。
            $sql ="insert into BLOG(TITLE,TYPE,SYS_UPDATE) values (?,?,now())";
            $boldid = Helper::open()->execute2id($sql,[
                'si',
                $title,
                $type
            ]);
            $msg = "登録しました。[ID:${boldid}]";
            $insert = [id => $boldid];

        }

        //コンテンツ内容を更新・登録
        $path = $_SERVER['DOCUMENT_ROOT'] . "/upload/" . $type . '_' . $boldid . '.txt';
        if( FileHelper::creatNewOrEditText($path, $edit) === true){
            Request::newInstance()->output("path", $path)
                            ->output("url", ("/upload/" . $type . '_' . $boldid . '.txt'))
                            ->output("id", $boldid)
                            ->output("msg", $msg)
                            ->output("insert", $insert)
                            ->output("statusCode", 0);
            return Forward::createAjaxJson();
        }

        Request::newInstance()->output("msg", 'error.[ID:' . $boldid .']')
        ->output("statusCode", 99);
        return Forward::createAjaxJson();
    }

    /**
     * 
     * ログイン処理
     * 
     */
    public function login($_QUE){
        $id = $_QUE['id'] . '';
        $pwd = $_QUE['password'];
        $token = $_QUE['token'];

        //セッションをクリアする。
        SessionHelper::clear('user_info');

        //トークンチェック
        if(Utils::isToken($token) == false){
            Request::newInstance()->output("msg", 'token is not right')
            ->output("statusCode", 99);
            return Forward::createAjaxJson();
            //return [ statusCode => 99, msg => 'token is not right' ];
        }

        //入力チェック
        if(Validator::isEmpty($id) || Validator::isEmpty($pwd) || Validator::isNotInteger($id)){
            Request::newInstance()->output("msg", 'ID or Password is not right')
            ->output("statusCode", 99);
            return Forward::createAjaxJson();
            //return [ statusCode => 99, msg => '1.ID or Password is not right' ];
        }

        //id=1, password:ccjie0313
        if($id == '1' && $pwd == 'ccjie0313'){
            SessionHelper::put('user_info',[id=>$id, login => true]);

            Request::newInstance()->session('user_info',[id=>$id, login => true])
                        ->output("msg", 'ログインした。')
                        ->output("statusCode", 0);
            return Forward::createAjaxJson();
        } else {
            Request::newInstance()->output("msg", 'ID or Password is not right')
                            ->output("statusCode", 99);
            return Forward::createAjaxJson();
        }

    }


}