<?php
include_once "../base.php";
?>
<h3>新增管理者帳號</h3>
<hr>
<form action="api/add.php?do=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>帳號:</td>
            <td>
                <input type="text" name="acc">
            </td>
        </tr>
        <tr>
            <td>密碼:</td>
            <td>
                <input type="text" name="pw" >
            </td>
        </tr>
        <tr>
            <td>確認密碼:</td>
            <td>
                <input type="text">
            </td>
        </tr>
    </table>
    <div>
    <input type="submit" value="新增">
    <input type="reset" value="重置">
    </div>
</form>