<?php
    require 'connection.php';
    $datas = array();
    $sql = "SELECT ad.item_code as icode , date , item_name from add_item_report as ad 
LEFT join inventory_items_table as ae 
 on ad.item_code = ae.item_code";
    $execute = $voltus->query($sql);
    if($execute == true){
        if($row = $execute->num_rows > 0){
            while($r = $execute->fetch_assoc()){
                    $action =="";
                    if($r['action'] == "1"){
                        #added
                        $action = "Added";
                    }
                    else if ($r['action'] == "2"){
                        #deleted
                        $action = "Deleted";
                    }
                    else{
                        #updated
                        $action = "Updated";
                    }
                echo "<li>";
                echo "<p>".'<strong>'$row['icode']'<strong>'."Has been ".$action. " on " . $r['date']."</p>";
                echo "</li>";
            }
        }
        else{
            echo "noitem";
        }
    }
?>