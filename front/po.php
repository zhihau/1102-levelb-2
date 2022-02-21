<div>目前位置：首頁 > 分類網誌 > <span id="navtype"></span></div>
<div style="display:flex">

<fieldset style="width:20%">
    <legend>分類網誌</legend>
    <p class="type" id="type1">健康新知  </p>
    <p class="type" id="type2">菸害防治</p>
    <p class="type" id="type3">癌症防治</p>
    <p class="type" id="type4">慢性病防治</p>
</fieldset>
<fieldset style="width:70%">
    <legend>文章列表</legend>
    <div id="list"></div>
   <div id="news"></div>
</fieldset>
</div>
<script>
    // 類似main.php的分頁功能
    getlist(1);
    $('.type').on('click',function(){
        $('#navtype').text($(this).text());
        let type=$(this).attr('id').replace('type','');
        getlist(type);
    })
    function getlist(type){
        $.post('../api/getlist.php',{type},function(list){
            $('#list').html(list);
            $('#list').show();
            $('#news').hide();

        })
    }
    function getpost(id){
        $.post('../api/getnews.php',{id},function(post){
            $('#news').html(post);
            $('#list').hide();
            $('#news').show();

        })
    }
</script>