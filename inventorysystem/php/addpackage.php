<?php

require 'connection.php';
require 'functions.php';
    $pac_code = $_POST['pac_code'];
    $pac_from = $_POST['pac_from'];
    $pac_rev = $_POST['pac_rev'];
    $pac_ref = $_POST['pac_ref'];
    $pac_date = $_POST['pac_date'];
    $pac_expect = $_POST['pac_expect'];
    $pac_status = $_POST['pac_status'];
    $pac_text = $_POST['pac_text'];

$package = FUNC_getPackageDelivery($voltex , $pac_code);

if($package == "noitem"){
    
    $res = FUNC_addDelivery($voltex,$pac_code,$pac_date,$pac_ref,$pac_from,$pac_rev,$pac_expect,$pac_status,$pac_text);
if($res == true){
    echo "Package processed";
    header("Refresh:1;url=inventoryaddpackage.php");
}
    
    
else{
    echo "Not Inseted";
    header("Refresh:1;url=inventoryaddpackage.php");
}
    
}
else{
    echo "Multiple data package found";
    header("Refresh:1;url=inventoryaddpackage.php");
}
 
?>