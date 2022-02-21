<?php
$que=$Que->find($_GET['id']);

?>
<fieldset>
    <legend>目前位置: 首頁 > 問卷調查 > <?=$que['text']?></legend>
<div><?=$que['text'];?></div>
<form action="api/vote.php" method="post">
    <?php
    $opts=$Que->all(['parent'=>$que['id']]);
    foreach($opts as $opt){
    ?>
        <p>
            <input type="radio" name="opt" value="<?=$opt['id'];?>">
            <?=$opt['text'];?>
        </p>
    <?php
    }
    ?>
    <div class="ct">
        <input type="submit" value="我要投票">

    </div>
</form>
</fieldset>