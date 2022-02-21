<fieldset>
    <legend>目前位置: 首頁 > 人氣文章區</legend>
    <table>
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
            <td>人氣</td>
        </tr>
        <?php
        $all = $News->math('count', '*', ['sh' => 1]);
        $div = 5;
        $pages = ceil($all / $div);
        $now = $_GET['p'] ?? '1';
        $start = ($now - 1) * $div;
        $rows = $News->all(['sh' => 1], " ORDER BY `good` desc limit $start,$div");
        foreach ($rows as $key => $row) {
        ?>
            <tr>
                <td class="switch clo"><?= $row['title']; ?></td>
                <td class="switch">
                    <div class="short"><?= mb_substr($row['text'], 0, 20); ?>...</div>
                    <div class="full pop" style="display:none;">
                        <h2 style="color:skyblue"><?= $row['title']; ?></h2>
                        <?= nl2br($row['text']); ?>
                    </div>
                </td>
                <td>
                    <?= $row['good']; ?>個人說<img src="./icon/02B03.jpg" style="width:20px">
                    <?php
                    if (isset($_SESSION['login'])) {
                        $ck = $Log->math('count', '*', ['news' => $row['id'], 'user' => $_SESSION['login']]);
                        if ($ck > 0) {
                            echo "<a class='g' data-news='{$row['id']}' data-type='1'>-收回讚</a>";
                        } else {

                            echo "<a class='g' data-news='{$row['id']}' data-type='2'>-讚</a>";
                        }
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php
    if (($now - 1) > 0) {
        $prev = $now - 1;
        echo "<a herf='?do=pop&p=$prev'> < </a>";
    }
    for ($i = 1; $i <= $pages; $i++) {
        $fz = ($now == $i) ? "20px" : "16px";
        echo "<a href='?do=pop&p=$i' style='font-size:$fz'>$i</a>";
    }
    if (($now + 1) <= $pages) {
        $next = $now + 1;
        echo "<a href='?do=pop&p=$next'> > </a>";
    }

    ?>

</fieldset>

<script>
    $(".switch").hover(function(){
        $(this).parent().find(".pop").toggle();
    })
    $(".g").on("click", function() {
        let type = $(this).data('type');
        let news = $(this).data('news');
        $.post("api/good.php", {
            type,
            news
        }, () => {
            switch (type) {
                case 1: //已經讚讚要收回讚
                    $(this).text("讚");
                    $(this).data('type', 2);
                    break;
                case 2: //還沒讚讚
                    $(this).text("收回讚");
                    $(this).data('type', 1);
                    break;
            }
            location.reload();
        })
    })
</script>