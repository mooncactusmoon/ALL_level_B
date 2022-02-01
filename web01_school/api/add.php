<?php
include_once "../base.php";

//判斷檔案上傳是否成功，成功就紀錄檔案名稱
if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    $data['img']=$_FILES['img']['name'];
}else{
    //排除admin menu這兩張沒有img欄位的資料表
    if($DB->table!='admin' && $DB->table!='menu'){
        $data['img']=''; //沒有檔案上傳時寫入空值
    }
}

//針對不同資料表處理
switch($DB->table){
    case "title":
        $data['text']=$_POST['text'];
        $data['sh']=0;
    break;
    case "admin":
        $data['pw']=$_POST['pw'];
        $data['acc']=$_POST['acc'];
    break;
    case "menu":
        $data['name']=$_POST['name'];
        $data['href']=$_POST['href'];
        $data['parent']=0;
        $data['sh']=1;
    break;
    default: //欄位格式相同的統一在此處理
        $data['text']=$_POST['text']??'';
        $data['sh']=1;
    break;
}
$DB->save($data);
to("../back.php?do=".$DB->table);
?>