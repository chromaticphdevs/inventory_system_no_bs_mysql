<?php
    require 'connection.php';
    require 'functions.php';
    $code = $_POST['code'];
    $sql = "SELECT pi.item_code FROM package_delivery_items as pi 
RIGHT join inventory_items_table as it
on pi.item_code = it.item_code WHERE pi.dev_pac_code = '$code'";
    $exec = $voltex->query($sql);
    if($exec == true){
        if($row = $exec->num_rows > 0){
            echo ' <table>';
            while($r = $exec->fetch_assoc()){
                echo '<tr>';
                echo '<td>' . $r['item_code'] . " is Inside" . "this package".'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        else{
echo "noitem";
        }
    }
    else{
        
    }
?>