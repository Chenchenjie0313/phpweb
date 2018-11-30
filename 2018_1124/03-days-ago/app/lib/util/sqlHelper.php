<?php

class Helper{

    private static $instance = null;

    public static function open(){
        if(self::$instance == null){
            self::$instance = new Helper();
        }
        return self::$instance;
    }

    public static function close(){
        if(self::$instance != null){
            self::$instance->_close();
            self::$instance = null;
        }

    }

    private $dbLink = null;
    private $dbStmt = null;

    /***
     * 
     */
    private function __construct(){
        $this->dbLink = new mysqli(DB_CONFIG['ip'], DB_CONFIG['name'], DB_CONFIG['pwd'], DB_CONFIG['db']);
        
        if( !Validator::isEmpty($this->dbLink->connect_error) ){
            throw new Exception("Error: Unable to connect to MySQL." . $this->dbLink->connect_error,99);   
        }

//        $this->dbLink->set_charset(DB_CONFIG['charset']);

        if( !Validator::isEmpty($this->dbLink->error) ){
            throw new Exception("Error:  to MySQL." . $this->dbLink->error,99);   
        }

    }

    public function _close(){
        if($this->dbLink != null){
            $this->dbLink->close();
            $this->dbLink = null;
        }

    }

    /**
     * 
     * 
     */
    public function queryCount($sql,$refArr=null){
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        $numargs  =  func_num_args ();
        if($numargs == 0){
            throw new Exception("Error: Unable to queryCount to MySQL." ,99);  
        }
        $count = 0;
        $mysqli = $this->dbLink;
        $stmt = $mysqli->prepare($sql);
        if($refArr != null){
            $ref    = new ReflectionClass('mysqli_stmt'); 
            $method = $ref->getMethod("bind_param"); 
            $method->invokeArgs($stmt,$refArr);
        }    
        $stmt->execute();
        if(!Validator::isEmpty($this->dbLink->error)){
            throw new Exception("Error: Unable to connect to MySQL." . $this->dbLink->error,99);   
        }
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);
        $count = $row[0];
        $result->free();
        $stmt->close();
        Utils::WriteLog("mysql helper queryCount end.","SQL : " . $sql, "return :" . $count);

        return $count;
    }

    /**
     * 
     * 
     */
    public function query($sql,$refArr=null){
        Utils::WriteLog("mysql helper query start...");
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        $numargs  =  func_num_args ();
        if($numargs == 0){
            throw new Exception("Error: Unable to queryCount to MySQL." ,99);  
        }
        $row = array();
        $mysqli = $this->dbLink;

        Utils::WriteLog($sql);
        Utils::WriteLog($refArr);

        $stmt = $mysqli->prepare($sql);
        if($refArr != null){
            $ref    = new ReflectionClass('mysqli_stmt'); 
            $method = $ref->getMethod("bind_param"); 
            $method->invokeArgs($stmt,$refArr);
        }    
        $stmt->execute();
        if(!Validator::isEmpty($this->dbLink->error)){
            throw new Exception("Error: Unable to connect to MySQL." . $this->dbLink->error,99);   
        }
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);
        $result->free();
        $stmt->close();
        Utils::WriteLog($row);
        return $row;
    }

    /**
     * 
     * 
     */
    public function queryAll($sql,$refArr=null){
        Utils::WriteLog("mysql helper queryAll start...",$sql,$refArr);
        //1.func_num_args — 返回传入函数的参数总个数
        //2.func_get_args — 返回传入函数的参数列表
        //3.func_get_arg — 根据参数索引从参数列表返回参数值
        $numargs  =  func_num_args ();
        if($numargs == 0){
            throw new Exception("Error: Unable to queryCount to MySQL." ,99);  
        }
        $data = array();
        $mysqli = $this->dbLink;
        $stmt = $mysqli->prepare($sql);
        if($refArr != null){
            $ref    = new ReflectionClass('mysqli_stmt'); 
            $method = $ref->getMethod("bind_param"); 
            $method->invokeArgs($stmt,$refArr);
        }
        $stmt->execute();
        if(!Validator::isEmpty($this->dbLink->error)){
            throw new Exception("Error: Unable to connect to MySQL." . $this->dbLink->error,99);   
        }
        $result = $stmt->get_result();
        $index=0;
        while ($row = $result->fetch_array(MYSQLI_NUM)){
            $data[$index] = $row;
            $index ++ ;
        }
        $result->free();
        $stmt->close();
        Utils::WriteLog($data);
        return $data;
    }

    /**
     * インサート
     * 
     */
    public function execute2id($sql,$refArr){

        Utils::WriteLog("mysql helper execute2id..." , $sql, $refArr);

        $mysqli = $this->dbLink;
        $stmt = $mysqli->prepare($sql);
        $ref    = new ReflectionClass('mysqli_stmt'); 
        $method = $ref->getMethod("bind_param"); 
        $method->invokeArgs($stmt,$refArr);
        $stmt->execute();
        if(!Validator::isEmpty($this->dbLink->error)){
            throw new Exception("Error: Unable to connect to MySQL." . $this->dbLink->error,99);   
        }
        $id = $stmt->insert_id;
        Utils::WriteLog("mysql helper execute and return id : {$id}...");
        $stmt->close();
        return $id;
    }



    /**
     * 更新・削除
     * 
     */
    public function execute($sql,$refArr){
        Utils::WriteLog("mysql helper execute..." , $sql, $refArr);

        $mysqli = $this->dbLink;
        $stmt = $mysqli->prepare($sql);
        $ref    = new ReflectionClass('mysqli_stmt'); 
        $method = $ref->getMethod("bind_param"); 
        $method->invokeArgs($stmt,$refArr);
        $stmt->execute();
        if(!Validator::isEmpty($this->dbLink->error)){
            throw new Exception("Error: Unable to connect to MySQL." . $this->dbLink->error,99);   
        }
        $rowNum = $stmt->affected_rows;
        Utils::WriteLog("mysql helper execute and return RowNum : {$rowNum}...");
        $stmt->close();
        return $rowNum;
    }

    public function test(){
        $mysqli = $this->dbLink;

        //1-------------------
        $sql ="insert into notice_info(TITLE,CONTENT,TYPE) values (?,?,?)";   
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssi', $title, $content, $type);
        //i - integer
        //d - double
        //s - string
        //b - BLOB
        $title = "test";
        $content = "test";
        $type = 99;
        // 关闭自动提交  
        $mysqli->autocommit(FALSE);
        $stmt->execute();
        if(!Validator::isEmpty($this->dbLink->error)){
            throw new Exception("Error: Unable to connect to MySQL." . $this->dbLink->error,99);   
        }
        $mysqli->commit();
        $stmt->close();

        //2---------------
        $stmt =  $mysqli->stmt_init();
        if ($stmt->prepare("SELECT TITLE,CONTENT,TYPE FROM notice_info WHERE id > ?")) {
            $stmt->bind_param("i", $id);
            $id = 1;
            $stmt->execute();
            $result = $stmt->get_result();
            // while ($row = $result->fetch_array(MYSQLI_NUM)){
            //     foreach ($row as $key => $r){
            //         echo "$key -> $r; ";
            //     }
            //     echo "<br/>";
            // }

    //         while ($row = $result->fetch_array(MYSQLI_BOTH)){
    //             foreach ($row as $key => $r){
    //                 print "$key -> $r; ";
    //             }
    //             print "<br/>";
    //         }
    //         $result->free();
        }
        $stmt->close();
    //     //$mysqli->rollback();
          
    }

}