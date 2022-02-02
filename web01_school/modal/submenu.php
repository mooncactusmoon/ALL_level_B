<?php
include_once "../base.php";
?>
<h3>編輯次選單</h3>
<hr>
<form action="api/submenu.php?main=<?=$_GET['id'];?>" method="post">
<table id="sub">
    <tr>
        <td>次選單名稱</td>
        <td>
        次選單連結網址
        </td>
        <td>刪除</td>
    </tr>
    <?php
    $subs=$Menu->all(['parent'=>$_GET['id']]);
    foreach($subs as $sub){
    ?>

    <tr>
        <td>
            <input type="text" name="name[]" value="<?=$sub['name'];?>">
        </td>
        <td>
            <input type="text" name="href[]" value="<?=$sub['href'];?>">
        </td>
        <td>
            <input type="checkbox" name="del[]" value="<?=$sub['id'];?>">
            <input type="hidden" name="id[]" value="<?=$sub['id'];?>">
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<div>
<input type="submit" value="修改確定">
    <input type="reset" value="重置">
    <!-- 建立onclick呼叫more函式 -->
    <input type="button" value="更多次選單" onclick="more()">
</div>
</form>
<script>
    function more(){
        //建立新的次選單表單欄位字串
        //注意欄位名稱不一樣 以方便api做識別

        let row=`<tr>
                <td><input type="text" name="name2[]"></td>
                <td><input type="text" name="href2[]"></td>
                <td></td>
                </tr>`
        
        //js 的append()插入表單後
        $("#sub").append(row);
    }
</script>