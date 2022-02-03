<div class="di"
	style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
	<?php include "marquee.php"; ?>	
</marquee>
	<div style="height:32px; display:block;"></div>
	<span class="t botli">更多最新消息顯示區</span>

	<?php
	$all=$News->math('count',"*");//總比數
	$div=5; //每頁5個
	$pages=ceil($all/$div); //總頁數
	$now=$_GET['p']??1; //當前頁碼
	$start=($now-1)*$div;//計算從哪開始撈資料

	?>
	<ol style="list-style-type:decimal" start="<?=($now-1)*$div+1;?>">
	
	<?php

	$rows=$DB->all(" limit $start,$div");
	foreach($rows as $n){
		echo "<li class='ssww'>";
		echo mb_substr($n['text'],0,20);
		echo "<div class='all' style='display:none'>{$n['text']}</div>";
		echo "</li>";
	}
	?>
	</ol>

	<!--正中央-->
	<div style="text-align:center;">
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
</div>
<!-- 抓index的js 把.sswww改成.ssww -->
<div id="alt" style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
<script>
    $(".ssww").hover(

        function() {
            $("#alt").html("<pre>" + $(this).children(".all").html() + "</pre>").css({
                "top": $(this).offset().top - 50
            })
            $("#alt").show()
        }
    )
    $(".ssww").mouseout(
        function() {
            $("#alt").hide()
        }
    )
</script>