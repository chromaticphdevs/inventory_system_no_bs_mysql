<?php
    $voltex = new mysqli('127.0.0.1','root','','voltus_inventory_system');
    if(mysqli_connect_error()){
        die(mysqli_connect_error($voltex));
    }
?>