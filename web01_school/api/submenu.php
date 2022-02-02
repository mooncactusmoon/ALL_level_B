<?php
include_once "../base.php";

if(isset($_POST['id'])){

    //次選單可能多筆資料所以用迴圈來一筆一筆處理
    foreach($_POST['id'] as $key =>$id){
        if(isset($_POST['del']) && in_array($id,$_POST['del'])){
            //del
            $Menu->del($id);
        }else{
            //撈要編輯的資料
            $sub=$Menu->find($id);

            $sub['name']=$_POST['name'][$key];
            $sub['href']=$_POST['href'][$key];

            //存回資料表
            $Menu->save($sub);
        }
    }
}

//判斷是否也name2  若有就代表有資料要新增
if(isset($_POST['name2'])){
    foreach($_POST['name2'] as $key =>$name){
        //判斷是否空值，空值不新增
        if($name!=''){
            $Menu->save([
                'name'=>$name,
                'href'=>$_POST['href2'][$key],
                'sh'=>1,
                'parent'=>$_GET['main']
            ]);
        }
    }
        
}
to("../back.php?do=".$Menu->table);
?>