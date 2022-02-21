<?php
include_once "../base.php";

if(isset($_POST['subject'])){
    $Que->save(['text'=>$_POST['subject'],'parent'=>0,'count'=>0]);
    $parent=$Que->math("max","id");
    if(isset($_POST['opt'])){
        foreach($_POST['opt'] as $opt){
            $Que->save(['text'=>$opt,'parent'=>$parent,'count'=>0]);
        }
    }
}
to("../back.php?do=que");

?>