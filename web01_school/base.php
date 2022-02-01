<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db01";
    protected $root="root";
    protected $password="";
    protected $table;
    protected $pdo;

    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->root,$this->password);

    }

    //all
    public function all(...$arg){
        $sql="select * from $this->table ";
        switch(count($arg)){
            case 1:
                //判斷是否為陣列
                if(is_array($arg[0])){
                    //使用迴圈建立條件句的字串 並暫存在陣列中
                    foreach($arg[0] as $key=>$value){
                        $tmp[]="`$key`='$value'";
                    }
                    //使用implode()轉換鎮列為字串並和原本的$sql結合
                    $sql.=" where ". implode(" AND ",$tmp);
                }else{
                    //參數若非陣列，直接接在原本的$sql字串後就好
                    $sql.=$arg[0];
                }
            break;

            case 2:
                //第一個參數必須是陣列 使用迴圈來建立條件語句的陣列
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }
                //使用implode()轉換鎮列為字串,最後接上第二個參數(要是字串)
                $sql.=" WHERE ".implode(" AND ",$tmp)." ".$arg[1];
            break;
        }
        //echo $sql; //除錯用
        //fetchAll()加上常數參數FETCH_ASSOC是為了讓取回的資料陣列中只有欄位名稱
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    //math
    public function math($math,$col,...$arg){
        $sql="select $math(`$col`) from $this->table ";
        if(!empty($arg[0])){
            foreach($arg[0] as $key =>$value){
                $tmp[]="`$key`='$value'";
            }
            $sql.=" where ". implode(" AND ",$tmp);
        }
        //使用fetchColumn()來取回第一欄位的資料，因為這個SQL語法
        //只有select 一個欄位的資料，因此這個函式會直接回傳計算的結果出來
        return $this->pdo->query($sql)->fetchColumn();
    }
    //find
    public function find($id){
        $sql="select * from $this->table where ";
        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql.= implode(" AND " ,$tmp);
        }else{

            $sql.=" `id`=`$id`";
        }
        //echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    }
    //del
    public function del($id){
        $sql="delete from $this->table where ";
        if(is_array($id)){
            foreach($id as $key=>$value){
                $tmp[]="`$key`='$value'";
            }
            $sql.=implode(" && ",$tmp);
        }else{
            $sql.=" `id`=`$id`";
        }
        //echo $sql;
        return $this->pdo->exec($sql);

    }

    //save update
    public function save($array){
        //有id就是更新，沒有的話則是新增
        if(isset($array['id'])){
            //update
            foreach($array as $key=>$value){
                if($key!='id'){
                    $tmp[]="`$key`='$value'";
                }
            }
            //更新sql的語法
            $sql="update $this->table set ".implode(',',$tmp)." where `id`='{$array['id']}'";
        }else{
            //insert
            $sql="insert into $this->table (`".implode("`,`",array_keys($array))."`)values('".implode("','",$array)."')";
            /*上面太複雜可以拆解組合成如下
            $cols=implode("`,`",$array_keys($arg));
            $values=implode("','",$arg);
            $sql="insert into $table(`$cols`) VALUES('$values')";
            */
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

$User=new DB('user');
?>