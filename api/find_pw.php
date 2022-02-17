<?php
include_once "../base.php";

// dd($_POST);
$res=$User->find($_POST);
if($res){
echo "您的密碼為：".$res['pw'];
}else{
echo "查無此資料";
}
