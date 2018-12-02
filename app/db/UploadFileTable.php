<?php

App::import('db/Entiry');

class UploadFileTable implements Entiry{

    public function __construct(){

    }

    /**
     * CREATE TABLE IF NOT EXISTS tasks
     */
    public function columns(){
        return [
            ID => 'INT AUTO_INCREMENT PRIMARY KEY',
            NAME => 'VARCHAR(255)',
            UPDATE_DATE => 'DATE',
            TEXT => 'VARCHAR(255)',
            TYPE => 'INT'
        ];
    }
    public function tableName(){
        return "UPDATE_FILE";
    }

    
}