<?php

App::import('/web/lib/action/action.php');
App::import('/web/lib/util/fileHelper.php');

class ShowAction extends Action{

    public function __construct(){
        parent::__construct();
        
    }

    public function getContentAndLink($_QUE){

        $template = "";
        $statusCode = 0;

        $url = 'http://m.xbiquge.la/wapbook/15409.html';//$_QUE['url'];
        $arr = DocumentHelper::parseHtmlByUrl($url);

        if ($arr === false){
            return Forward::createPage($redirect);
        }
        Request::newInstance()->output("statusCode", $statusCode)
                        ->output("templateData", [
                            'title' => "",
                            "body" => $arr[0],
                            "list" => $arr[1]
                        ]);
        //return Forward::createAjaxJson();
        return $this->getTemplate(["templateid" => "dailogTemplete"]);
    }

    public function redirect($_QUE){
        $redirect = $_QUE['redirect'];

        if ($redirect === "admin"){
            $redirect = '/html/admin/index.html.php';
        }
        return Forward::createPage($redirect);

    }

    /**
     * テンプレートIDより、テンプレートを取得する
     * 
     */
    public function getTemplate($_QUE){

        $templateid = $_QUE['templateid'];
        $template = "";
        $error = "";
        $statusCode = "0";

        $path = $_SERVER['DOCUMENT_ROOT'] . "/templete/" . $templateid . '.txt';
        $template = FileHelper::getText($path);
        if($template === false){
            $template = "";
            $error = "コンテンツが存在されていない。[ID:${id},PATH:${path}]";
            $statusCode = "99";
        }
        Request::newInstance()->output("template", $template)
                            ->output("statusCode", $statusCode)
                            ->output("error", $error);
        return Forward::createAjaxJson();

    }


    /**
     * IDより、表示された内容を取得
     */
    public function preview($_QUE){

        //初期値
        $title = '';
        $type = 0;
        $id = '';
        $content = '';
        $statusCode = 0;

        // IDがあった場合、タイトル、コンテンツを設定する。
        if($_QUE['id'] != null && $_QUE['id'] != ''){
            $id = $_QUE['id'];
            $sql = 'SELECT ID,TITLE,TYPE FROM BLOG WHERE id = ? ';
            $blod = Helper::open()->query($sql,[
                'i',
                $id
            ]);
            if($blod != null && count($blod) > 0){
                $id = $blod[0];
                $title = htmlspecialchars($blod[1], ENT_QUOTES);
                $type = $blod[2];
                
                $path = $_SERVER['DOCUMENT_ROOT'] . "/upload/" . $type . '_' . $id . '.txt';
                $content = FileHelper::getText($path);
                if($content === false){
                    $statusCode = 99;
                    $content = "コンテンツが存在されていない。[ID:${id},PATH:${path}]";
                }
               
            } else {
                $statusCode = 99;
                $content = "データが存在されていない。[ID:${id}]";
            }
        }

        Request::newInstance()->output("template", null)
                            ->output("statusCode", $statusCode)
                            ->output("templateData", [
                                    'title' => $title,
                                    'type' => $type,
                                    'id' => $id,
                                    'body' => $content,
                                    'msg' => $msg
                                ]);
        return Forward::createAjaxJson();

        // return [
        //     'statusCode' => $statusCode,
        //     'template' => null,
        //     'templateData' => [
        //         'title' => $title,
        //         'type' => $type,
        //         'id' => $id,
        //         'body' => $content,
        //         'msg' => $msg
        //     ]
        // ];
    }


    /**
     * 
     * 表示内容リストデータを取得
     * 
     */
    public function templeteList($_QUE){

        $statusCode = 0;
        $pageIndex = $_QUE['pageIndex'];
        $type = $_QUE['type'];
        //LIMIT 開始　レコード数
        $total_records = Helper::open()->queryCount('SELECT count(1) FROM BLOG');

        // $num_records_perpage = 100;
        $num_records_perpage = 100;
        $total_pages = ceil(intval($total_records) / $num_records_perpage);

        Utils::WriteLog("total_pages =>  " , $total_pages);
        
        if(Validator::isEmpty($pageIndex) || Validator::isNotInteger($pageIndex)){
            $pageIndex = 1;

        } else {
            $pageIndex = intval($pageIndex);
        }

        Utils::WriteLog("total_pages =>  " , $total_pages);

        if($pageIndex > $total_pages && $total_pages > 0){
            $pageIndex = $total_pages;
        }
        
        $start_from = ($pageIndex-1) * $num_records_perpage;
        $start_to = ($pageIndex) * $num_records_perpage;

        Utils::WriteLog("from => to : " , $start_from . " =>" .  $start_to);

        $data = null;
        if(Validator::isEmpty($type)){
            $data = Helper::open()->queryAll(('SELECT ID,TITLE,TYPE FROM BLOG order by id limit ?,?'), [
                'ii', $start_from, $start_to
            ]);
        } else {
            $data = Helper::open()->queryAll(('SELECT ID,TITLE,TYPE FROM BLOG WHERE TYPE = ? order by id limit ?,?'), [
                'sii', $type, $start_from, $start_to
            ]);
        }

        $arr = array();
        if($data != null && count($data) > 0){
            //list:[[img,name,time,text],[...]]
            for($i=0;$i<count($data);$i++){
                $arr[$i] = array();
                $arr[$i]['id'] = $data[$i][0];
                $arr[$i]['text'] = $data[$i][1];
                $arr[$i]['type'] = $data[$i][2];
                $arr[$i]['name'] = '';
                $arr[$i]['time'] = '';
            }
        }

        $pageTitle = 'お知らせ';
        if($type == "1"){
            $pageTitle = 'Java';
        } else if ($type == "2"){
            $pageTitle = 'JavaScript/CSS';
        } else if ($type == "3"){
            $pageTitle = 'Oracle';
        } else if ($type == "4"){
            $pageTitle = 'ES6の入門';
        } else if ($type == "99"){
            $pageTitle = 'その他';
        }
        
        $this->getTemplate(['templateid'=>'listTemplate']);
 
        Request::newInstance()->output("statusCode", $statusCode)
                        ->output("templateData", [
                            'title' => $pageTitle
                            ,'list' => $arr
                        ]);
        return Forward::createAjaxJson();

    }

}