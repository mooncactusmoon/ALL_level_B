<fieldset>
    <legend>最新文章管理</legend>
    <form action="api/news.php" method="post">
        <table width="90%">
            <tr>
                <td width="15%">編號</td>
                <td width="55%">標題</td>
                <td width="10%">顯示</td>
                <td width="10%">刪除</td>
            </tr>
            <?php
            $all=$News->math('count','*');
            $div=3;
            $pages=ceil($all/$div);
            $now=$_GET['p']??'1';
            $start=($now-1)*$div;
            $rows=$News->all(" limit $start,$div");
            foreach($rows as $key=> $row){

                $check=($row['sh']==1)?"checked":"";
            ?>
            <tr>
                <td class="clo"><?=$start+$key+1;?></td>
                <td><?=$row['title'];?></td>
                <td>
                    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$check;?>>
                </td>
                <td>
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div class="ct">
            <?php
            if(($now-1)>0){
                $prev=$now-1;
                echo "<a href='?do=news&p=$prev'> < </a>";
            }
            for($i=1;$i<=$pages;$i++){
                $f=($now==$i)?"20px":"16px";
                echo "<a href='?do=news&p=$i' style='font-size:$f'>$i</a>";
            }
            if(($now+1)<=$pages){
                $next=$now+1;
                echo "<a href='?do=news&p=$next'> > </a>";
            }
            ?>
        </div>
        <div class="ct">
            <input type="submit" value="確定修改">
        </div>
    </form>
</fieldset>