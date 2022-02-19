<fieldset>
    <legend>忘記密碼</legend>
    <div>請輸入信箱以查詢密碼</div>
    <div><input type="text" name="email" id="email"></div>
    <div id="result"></div>
    <div><button onclick='f()'>尋找</button></div>
</fieldset>

<script>
    function f() {
        $.post("api/forget.php",{email:$("#email").val()},(result)=>{
            $("#result").text(result);
        })
    }

</script>