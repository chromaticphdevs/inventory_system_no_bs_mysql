<?php
    require 'connection.php';
    require 'functions.php';
    $dev_code = $_POST['dev_code'];
    $item_code = $_POST['item_code'];
    $item_status = $_POST['item_status'];
    $item_name = $_POST['item_name'];
    $deliveredBy = $_POST['deliveredBy'];
    $org_price = $_POST['org_price'];
    $sel_price = $_POST['sel_price'];
    $item_qty = $_POST['item_qty'];
    $date_delivered = $_POST['item_date'];
    $image = $_POST['image'];
    $fileToUpload = $_POST['fileToUpload'];
    
    #con,a-code,b-name,c-image,d-status,e-price,f-sel-price,g-qty,h-date,i-deliveredby
        $res  = FUNC_addItem($voltex, $item_code,$item_name,$image,$item_status,$org_price,$sel_price,$item_qty,$date_delivered,$deliveredBy);
    if($res == true){
        echo "true";
    }
    else if("updated"){
        echo "updated";
    }
    else{
        echo "false";
    }
?>