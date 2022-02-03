<?php
if(isset($_SESSION['login'])){
	to("http://127.0.0.1/level_B/web01_school/back.php");
}
if(!empty($_POST)){

	if($Admin->math('count','*',['acc'=>$_POST['acc'],'pw'=>$_POST['pw']])>0){
		$_SESSION['login']=$_POST['acc'];
	
		to("http://127.0.0.1/level_B/web01_school/back.php");
	}else{
		echo "<script>";
		echo "alert('帳號或密碼錯誤')";
		echo "</script>";
	}
}
?>
<div class="di"
	style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
	<?php include "marquee.php"; ?>	
</marquee>
	<div style="height:32px; display:block;"></div>
	<!--正中央-->
	<!-- 修改action 刪除target -->
	<form method="post" action="?do=login">
		<p class="t botli">管理員登入區</p>
		<p class="cent">帳號 ： <input name="acc" autofocus="" type="text"></p>
		<p class="cent">密碼 ： <input name="pw" type="password"></p>
		<p class="cent"><input value="送出" type="submit"><input type="reset" value="清除"></p>
	</form>
</div>
		