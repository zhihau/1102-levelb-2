<?php
include_once "../base.php";

$rows=$News->all($_POST);
foreach($rows as $row){
    echo "<p><a href='#' onclick='getpost({$row['id']})'>{$row['title']}</a></p>";
}