<div>目前位置: 首頁 > 分類網誌 > <span id="navTag">健康新知</span></div>
<div style="display:flex">
    <fieldset style="width:20%;align-self:baseline">
        <legend>分類網誌</legend>
        <p class="type" id="t1">健康新知</p>
        <p class="type" id="t2">菸害防治</p>
        <p class="type" id="t3">癌症防治</p>
        <p class="type" id="t4">慢性病防治</p>
    </fieldset>
    <fieldset style="width:75%">
        <legend>文章表列</legend>
        <div id="newList"></div>
        <div id="news"></div>
    </fieldset>
</div>

<script>
    getlist(1)

    $(".type").on("click",function(){
        $("#navtype").text($(this).text());
        let type=$(this).attr('id').replace('t','');
        getlist(type)
    })
    function getlist(type){ //取得分類
        $.get("api/getlist.php",{type},(list)=>{
            $("#newsList").html(list);

            $("#newsList").show();
            $("#news").hide()
        })
    }
    function getnews(id){ //取得指定內容
        $.get("api/getnews.php",{id},(news)=>{
            $("#news").html(news);
            $("#newsList").hide();
            $("#news").show();
        })
    }
</script>