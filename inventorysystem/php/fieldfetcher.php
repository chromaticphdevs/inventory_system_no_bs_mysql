<?php
require 'connection.php';
require 'functions.php';
$table_name = $_POST['table_name'];
$field_name = $_POST['field_name'];
$tofind = $_POST['tofind'];

$res = My_searcher($voltex,$table_name,$field_name,$tofind,true);
if($res == false){
    echo json_encode("false");
}
else{
    $datas = array();
    $sql = "SELECT * from $table_name where $field_name like '%$tofind%'";
    $execute = $voltex->query($sql);
    if($execute == true){
        while($r = $execute->fetch_assoc()){
            $datas[] = $r;
        }
    }
    echo json_encode($datas);
}
?>