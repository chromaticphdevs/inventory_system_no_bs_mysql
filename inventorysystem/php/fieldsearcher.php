<?php
require 'connection.php';
require 'functions.php';
$table_name = $_POST['table_name'];
$field_name = $_POST['field_name'];
$tofind = $_POST['tofind'];

$res = My_searcher($voltex,$table_name,$field_name,$tofind,true);
if($res == false){
    echo "false";
}
else{
    echo "true";
}
?>