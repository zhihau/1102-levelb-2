<?php
include_once "../base.php";

$row=$News->find($_POST);
// 把文章加上斷行br
    echo nl2br($row['text']);
