<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">頁尾版權資料管理管理</p>
    <form method="post"  action="./api/bottom.php">
        <table width="50%" style="margin:auto">
            <tr class="yel">
                <td width="50%">進站總人數:</td>
                <td width="50%">
                    <input type="text" name="bottom" value="<?=$Bottom->find(1)['bottom'];?>">
                </td>
            </tr>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tr>
                <td width="200px">
                        
                </td>
                <td class="cent">
                    <input type="submit" value="修改確定">
                    <input type="reset" value="重置">
                </td>
            </tr>
        </table>

    </form>
</div>