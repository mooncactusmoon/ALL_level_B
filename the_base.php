<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB{
    protected $dsn='mysql:host=localhost;charset=utf8;dbname=dbXX';
    protected $table;
    protected $pdo;

    public function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    //all
    public function all(...$arg){
        $sql="select * from $this->table ";
        switch(count($arg)){
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " where ".implode(" AND ",$tmp);
                }else{
                    $sql .=$arg[0];
                }
            break;
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }
                $sql .= " where ".implode(" AND ",$tmp)." ".$arg[1];
            break;
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    //math
    public function math($math,$col,...$arg){
        $sql="select $math($col) from $this->table ";
        switch(count($arg)){
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " where ".implode(" AND ",$tmp);
                }else{
                    $sql .=$arg[0];
                }
            break;
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }
                $sql .= " where ".implode(" AND ",$tmp)." ".$arg[1];
            break;
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    //find
    public function find($id){
        $sql="select * from $this->table where ";
        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql .=implode(" AND ",$tmp);
        }else{
            $sql .=" `id`='$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    //del
    public function del($id){
        $sql="DELETE FROM $this->table where ";
        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql .=implode(" AND ",$tmp);
        }else{
            $sql .=" `id`='$id'";
        }
        return $this->pdo->exec($sql);
    }

    //save
    public function save($array){
        if(isset($array['id'])){
            //update
            foreach($array as $key => $value){
                if($key!='id'){
                    $tmp[]="`$key`='$value'";
                }
            }
            $sql="UPDATE $this->table set ".implode(',',$tmp)." where `id`='{$array['id']}'";
            
        }else{
            //insert
            $sql="INSERT INTO $this->table (`".implode("`,`",array_keys($array))."`) values('".implode("','",$array)."')";
        }
        return $this->pdo->exec($sql);
    }

    //q
    public function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
//to
function to($url){
    header("location:".$url);
}
//dd
function dd($array){
    echo "<pre>";   
    print_r($array);
    echo "</pre>";   
}

//假設資料表名稱:abc
$Abc=new PDO('abc');

?>