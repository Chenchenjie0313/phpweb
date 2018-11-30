<?php

class MyPDO extends PDO{

    private static $target = null;

    public static function create(){
        if (self::$target == null){
            self::$target = new MyPDO();
        }
        return self::$target;
    }

    public function __construct(){

        $DB_CONFIG = SETTINGS['local_database'];
        $servername = $DB_CONFIG['ip'];
        $username = $DB_CONFIG['name'];
        $password = $DB_CONFIG['pwd'];
        $schema= $DB_CONFIG['schema'];
        $port= isset($DB_CONFIG['port']) ? $DB_CONFIG['port'] : '3306';
        try{
            //ATTR_EMULATE_PREPARES がよく分からない。
            // parent::__construct("mysql:dbname={$schema};host={$servername};port={$port};charset=utf8", $username, $password, array(PDO::ATTR_EMULATE_PREPARES => false));
            parent::__construct("mysql:dbname={$schema};host={$servername};port={$port};charset=utf8", $username, $password);
            // $this->query("SET NAMES utf8;");

            //// set the PDO error mode to exception
            ////$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            Logger::log($e);
            throw new Exception('数据库连接错误！'); 
        }
    }

    /***
     * セレクト
     */
    public function select($sql, $parmas){
        Logger::log(__METHOD__.",行:".__LINE__, $sql, $parmas);
        $stmt = $this -> prepare($sql);
        $stmt->execute($parmas);
        // foreach(range(0, $stmt->columnCount() - 1) as $column_index){
        //     $meta[] = $pdo_stmt->getColumnMeta($column_index);
        // }
        // while($row = $pdo_stmt->fetch(PDO::FETCH_NUM))
        // {
        //   foreach($row as $column_index => $column_value){}
        // }
        $row = null;
        $returnVal = WArray::create();
        while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
            $returnVal->put($returnVal->size(), $row);
        }
        //$stmt->closeCursor();

        Logger::log(__METHOD__.",行:".__LINE__, $returnVal);
        return $returnVal;
    }

    /***
     * セレクト
     */
    public function update($sql, $parmas){
        Logger::log(__METHOD__.",行:".__LINE__, $sql, $parmas);
        $stmt = $this -> prepare($sql);
        $stmt->execute($parmas);
    }

    /***
     * セレクト
     */
    public function delete($sql, $parmas){
        Logger::log(__METHOD__.",行:".__LINE__, $sql, $parmas);
        $stmt = $this -> prepare($sql);
        $stmt->execute($parmas);
    }

    /***
     * セレクト
     */
    public function insert($sql, $parmas){
        Logger::log(__METHOD__.",行:".__LINE__, $sql, $parmas);
        $stmt = $this -> prepare($sql);
        $stmt->execute($parmas);
        //lastInsertId

    }



    /***
     * 参考
     * 
     */
    private function todo($sql, $args){

        $pdo->beginTransaction(); // 开启一个事务
        $pdo->commit(); // 提交事务
        $pdo->rollback(); // 回滚事务

        $stmt = $pdo->query("SELECT * FROM テーブル名 ORDER BY no ASC");
        while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
            $ttitle = $row["title"];
            $tr = $row["r"];
            $tk = $row["k"];
            $tt = $row["t"];
            $tm = $row["m"];
        }


        $stmt = $pdo -> prepare("INSERT INTO テーブル名 (name, value) VALUES (:name, :value)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR); //文字列
        $stmt->bindValue(':value', 1, PDO::PARAM_INT);    //数値
        $name = 'one';
        $stmt->execute();
        //var_dump($dbh->lastInsertId()); 登録したデータのIDを取得して出力

        $sql = 'update テーブル名 set name =:name where id = :value';
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':value', 1, PDO::PARAM_INT);
        $stmt->execute();

        $sql = 'DELETE FROM テーブル名 where id = :delete_id';
        $stmt = $pdo -> prepare($sql);
        $stmt -> bindParam(':delete_id', $value, PDO::PARAM_INT);
        $stmt -> execute();

        $stmt = $pdo -> query("SELECT * FROM テーブル名");
        $count = $stmt -> rowCount();


        $stmt = $pdo -> prepare("SELECT SUM(a1) as a1 FROM テーブル名 WHERE y=:y");
        $stmt -> bindParam(':y', $y, PDO::PARAM_STR);
        $stmt -> execute();
        if($row = $stmt -> fetch()){$kei = $row['a1'];}

        $sql = "CREATE TABLE IF NOT EXISTS `テーブル名`"
                ."("
                . "`dd` INT auto_increment primary key,"
                . "`y` INT,"
                . "`m` INT,"
                . "`d` INT,"
                . "`youbi` INT,"
                . "`yokin` INT,"
                . "`a1` INT,"
                . "`a2` INT,"
                . "`a3` INT,"
                . "`a4` INT,"
                . "`a5` INT,"
                . "`i_date` DATETIME"
                .");";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute();

        $sql = "DROP TABLE IF EXISTS テーブル名";
        $pdo -> exec($sql);


    }



}