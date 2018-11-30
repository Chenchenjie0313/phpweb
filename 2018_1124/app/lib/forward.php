<?php

class Forward{

    public static function createAjaxJson(){
        return new Forward("AJAX_JSON", "", "", "");
    }

    public static function createAjaxTxt($pageKey){
        return new Forward("AJAX_TXT", "", "", $pageKey);
    }

    public static function createAction($action, $method){
        return new Forward("ACTION", $action, $method, "");
    }

    public static function createPage($pageKey){
        return new Forward("PAGE", "", "", $pageKey);
    }

    public static function create($type="", $action="", $method="", $pageKey=""){
        return new Forward($type, $action, $method, $pageKey);
    }

    const TYPE_ACTION = "ACTION";
    const TYPE_PAGE = "PAGE";
    const TYPE_AJAX_JSON = "AJAX_JSON";
    const TYPE_AJAX_TXT = "AJAX_TXT";

    private $type = "";
    private $action = "";
    private $method = "";
    private $pageKey = "";

    public function __construct($type="", $action="", $method="", $pageKey=""){
        $this->type = $type;
        $this->action = $action;
        $this->method = $method;
        $this->pageKey = $pageKey;
    }
    

    public function input($key){
        if ($key == "type"){
            return $this->type;

        } else if ($key == "action"){
            return $this->action;

        } else if ($key == "method") {
            return $this->method;

        } else if ($key == "page") {
            return $this->pageKey;
        }
        return "";
    }

    public function toJson(){
        
        $val = json_encode([
            "type" => $this->type,
            "action" => $this->action,
            "method" => $this->method,
            "pageKey" => $this->pageKey
        ], true);
        if (json_last_error() !== 0){
            Logger::log("JSON : " , json_last_error(), json_last_error_msg());
            throw new Exception("Request outputToJson is error!");
        }
        return $val;
    }
    

}