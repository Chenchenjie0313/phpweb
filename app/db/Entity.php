<?php

App::import('db/MyPDO');

abstract class Entity{


    public function __construct(){

    }

    /**
     * 
     */
    abstract public function tableName();
    abstract public function columns();


    public function insert(){

    }

    public function selectList(){
        
    }

    public function select(){
        
    }

    public function update(){
    }

    public function deleteById($id){
        $sql = "DELTE"." ".$this->tableName()." "."WHERE ID = :ID";
        $this->execute($sql, [':ID'=>$id]);
        return $this;
    }

    public function execute($sql, $parmas){
        MyPDO::create()->execute($sql, $parmas);
        return $this;
    }

    public function createNewTable(){
        $this->execute($this->getCreateSql());
    }

    /**
     * テーブル生成するSQL
     * 
     */
    public function getCreateSql(){
        $sql = "CREATE TABLE IF NOT EXISTS"." ".$this->tableName() + "(";
        $isFirst = true;
        foreach ($this->columns() as $key => $value) {
            if ($isFirst == true){
                $isFirst = false;
            } else {
                $sql .= ",";
            }
            $sql .= "{$key} {$value}";

        }
        $sql .= ")";
    }


    
}