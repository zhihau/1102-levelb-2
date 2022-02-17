<?php
include_once "../base.php";

$chk=$User->math('count','*',$_POST);
if($chk>0){
    echo 1;
}else{
    echo 0;
}