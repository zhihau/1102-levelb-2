<?php
include_once "../base.php";

// 題組一
// $res=$Admin->math('count','*,['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);
// if($res>0){
// 	$_SESSION['login']=$_POST['acc'];
// 	to('../back.php?do=title');
// }else{
// 	echo "<script>";
// 	echo "alert('帳號或密碼錯誤');";
// 	echo "</script>";
// 	echo "location.href='index.php?do=login';";
// }

$chk=$User->math('count','*',$_POST);
if($chk>0){
    echo 1;
}else{
    echo 0;
}
// 用ajax不用導頁，導頁把之前的操作都重置了
// to('../index.php?do=login');