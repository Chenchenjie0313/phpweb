<?php 

class WTreeNode {

    private function __construct(){
        $this->root = WArray::create();
    }

    /**
     * 文字列クラスを生成する。
     */
    public static function create() {
        return new WTreeNode($value);
    }

    public function addNode($chair){
        
    }

}

class WTree {

    private $root = null;

    private function __construct(){
        $this->root = WTreeNode::create();
    }

    /**
     * 文字列クラスを生成する。
     */
    public static function create() {
        return new WTree($value);
    }

    public function addNode(){

    }

}