<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=web02";
    protected $pdo;
    public $table;
    
    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
        
    }
    //all
    public function all(...$arg){
        $sql="select * from $this->table ";
        switch(count($arg)){
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key =>$value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .=" where ".implode(" AND ",$tmp);
                }else{
                    $sql .=$arg[0];
                }
            break;

            case 2:
                foreach($arg[0] as $key =>$value){
                    $tmp[]="`$key`='$value'";
                }
                $sql .=" where ".implode(" AND ",$tmp)." ".$arg[1];
            break;
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //math
    public function math($math,$col,...$arg){
        $sql="select $math($col) from $this->table ";
        switch(count($arg)){
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key =>$value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .=" where ".implode(" AND ",$tmp);
                }else{
                    $sql .=$arg[0];
                }
            break;

            case 2:
                foreach($arg[0] as $key =>$value){
                    $tmp[]="`$key`='$value'";
                }
                $sql .=" where ".implode(" AND ",$tmp)." ".$arg[1];
            break;
        }
        //echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }

    //find
    public function find($id){
        $sql="select * from $this->table where ";
        if(is_array($id)){
            foreach($id as $key=>$value){
                $tmp[]="`$key`='$value'";
            }
            $sql .=implode(" AND ",$tmp);
        }else{
            $sql .=" `id`='$id'";
        }
        //echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    //del
    public function del($id){
        $sql="DELETE FROM $this->table where ";
        if(is_array($id)){
            foreach($id as $key=>$value){
                $tmp[]="`$key`='$value'";
            }
            $sql .=implode(" AND ",$tmp);
        }else{
            $sql .=" `id`='$id'";
        }
        //echo $sql;
        return $this->pdo->exec($sql);
    }

    //save
    public function save($array){
        //有id更新
        if(isset($array['id'])){
            foreach($array as $key=>$value){
                if($key!='id'){
                    $tmp[]="`$key`='$value'";
                }
            }
            $sql="update $this->table set ".implode(',',$tmp)." where `id`='{$array['id']}'";
        }else{
            //沒有id則新增
            $sql="insert into $this->table (`".implode("`,`",array_keys($array))."`)values('".implode("','",$array)."')";
        }
        //echo $sql;
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

//連結資料表
$News=new DB('news');
$User=new DB('user');
$View=new DB('view');
$Log=new DB('log');
$Que=new DB('que');


if(!isset($_SESSION['view'])){
    if($View->math('count','*',['date'=>date("Y-m-d")])>0){
        $view=$View->find(['date'=>date("Y-m-d")]);
        $view['total']++;
        $View->save($view);
        $_SESSION['view']=$view['total'];
    }else{
        $View->save(['date'=>date("Y-m-d"),'total'=>1]);
        $_SESSION['view']=1;
    }
}
?>