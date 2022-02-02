<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli"><?=$DB->title;?></p>
    <form method="post" action="./api/edit.php?do=<?=$DB->table;?>">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="70%"><?=$DB->header;?></td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                    <td width="10%"></td>
                </tr>
                <?php
                $all=$DB->math('count',"*");//總比數
                $div=3; //每頁三個
                $pages=ceil($all/$div); //總頁數
                $now=$_GET['p']??1; //當前頁碼
                $start=($now-1)*$div;//計算從哪開始撈資料
                $rows=$DB->all(" limit $start,$div");
                foreach($rows as $row){
                    $checked=($row['sh']==1)?'checked':'';
                
                ?>
                <tr>
                    <td>
                        <img src="./img/<?=$row['img'];?>" alt="<?=$row['text'];?>" style="width:100px;height:68px">
                    </td>
                    <td>
                        <input type="checkbox" name="sh[]" value="<?=$row['id']?>"<?=$checked;?>>
                    </td>
                    <td>
                        <input type="checkbox" name="del[]" value="<?=$row['id']?>">
                    </td>
                    <td>
                        <input type="hidden" name="id[]" value="<?=$row['id']?>">
                        <input type="button" value="更新圖片" onclick="op('#cover','#cvr','modal/upload.php?do=<?=$DB->table;?>&id=<?=$row['id'];?>')">
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
            
        </table>

        <!-- 分頁 -->
        <div class="cent">
        <?php
            if(($now-1)>0){
                $p=$now-1; //上頁頁碼
                echo "<a href='?do={$DB->table}&p=$p'>&lt;</a>";
            }
            for($i=1;$i<=$pages;$i++){
                //判斷當前頁面字型大小
                $font=($i==$now)?"24px":"16px";
                echo "<a href='?do={$DB->table}&p=$i'style='font-size:$font'>$i</a>";
            }
            if(($now+1)<=$pages){
                $p=$now+1; //下頁頁碼
                echo "<a href='?do={$DB->table}&p=$p'>&gt;</a>";
            }
        ?>
        </div>

        <!-- 分頁end -->
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px">
                        <input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/<?=$DB->table;?>.php?table=<?=$DB->table;?>&#39;)" value="<?=$DB->button;?>"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</div>