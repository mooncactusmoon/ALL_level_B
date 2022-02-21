<fieldset>
    <legend>目前位置: 首頁 > 問卷調查</legend>
    <table width="100%">
        <tr>
            <td>編號</td>
            <td>問卷題目</td>
            <td>投票總數</td>
            <td>結果</td>
            <td>狀態</td>
        </tr>
        <?php
        $que=$Que->all(['parent'=>0]);
        foreach($que as $key=>$q){
        ?>
        <tr>
            <td><?=$key+1;?></td>
            <td><?=$q['text'];?></td>
            <td><?=$q['count'];?></td>
            <td>
                <a href="?do=result&id=<?=$q['id'];?>">結果</a>
            </td>
            <td>
                <?php
                if(!isset($_SESSION['login'])){
                    echo "請先登入";
                }else{
                    echo "<a href='?do=vote&id={$q['id']}'>參與投票</a>";
                    
                }
                ?>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</fieldset>