<fieldset>
    <div>請輸入信箱以查詢密碼</div>
    <input type="text" name="email" id="email">
    <div id="result"></div>
    <button onclick="find()">尋找</button>
</fieldset>
<script>
    function find(){
        $.post("../api/find_pw.php",{email:$('#email').val()},function (res){
            $('#result').html(res);
        })
    }
</script>