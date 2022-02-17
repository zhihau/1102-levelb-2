<style>
    .tag-list{
display:flex;
margin-left:1px;
    }
    .tag{
padding:5px 8px;
margin-left:-1px;
border:1px solid #555;
cursor: pointer;
background :#ddd;
    }
    .tag:hover{
        background :#ccc;
        color:white;
    }
    .text{
        padding:5px 8px;
margin-left:-1px;
border:1px solid #555;
width:95%;
display: none;
    }
    .active{
background:white;
border-bottom-color:white;
    }
</style>

<style>
    /* .tag-list{
display:flex;
margin-left:1px;
    }
    .tag{
padding:5px 8px;
margin-left:-1px;
border:1px solid #555;
background:#ddd;
cursor:pointer;
    }
    .tag:hover{
background:#ccc;
color:white;
    }
    .text{

padding:5px 8px;
border:1px solid #555;
margin-top:-1px;
width:95%;
display: none;
    }
    .active{
background:white;
border-bottom-color:white;
    } */
</style>
<div class="tag-list">
   
        <div class="tag" id="tag1">健康新知</div>
        <div class="tag" id="tag2">菸害防治</div>
        <div class="tag" id="tag3">癌症防治</div>
        <div class="tag" id="tag4">慢性病防治</div>
      
    
</div>
<?php
    $rows=$News->all();
    foreach($rows as $k=>$row){
        ?>
<div class="text" id="text<?=$k+1?>">
    <div><?=$row['title']?></div>
    <pre><?=$row['text']?></pre>
</div>
<?php
    }
    ?>
<script>
    showText(1);
    $('.tag').on('click',function(){
let id=$(this).attr('id').replace('tag','');
console.log(id);
showText(id);
    })
    function showText(id){
        $('.text').hide();
        $('.tag').removeClass('active');
        $('#tag'+id).addClass('active');
        $('#text'+id).show();
    }
</script>