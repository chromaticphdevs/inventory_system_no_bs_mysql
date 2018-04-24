<?php
    require 'phpcallers.php';
    $total = table_counter($voltex,'table_report');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="../css/config.css">
        <style>
            table{
                vertical-align: baseline;
                border: 1px solid black;
                display: block;
                width: 80%;
                margin: 0px auto;
                font-family: "Trebuchet MS","Tahoma",sans-serif;
            }
            table td {
                padding: 10px;
                border-bottom: 1px solid black;
                width: 100%;
            }
            table tr {
                padding: 10px;
                border-bottom: 1px solid black;
            }
            table div{
                padding: 10px;
            }
            .row{
                align-items: center;
                align-content: center;
                align-self: center;
            }
            .side-1{
                overflow: scroll;
                height: 600px;
            }
            .center{
                text-align: center;
            }
        </style>
        <title>Inventory Activity Log | Voltus Technology</title>
    </head>
    <body>
        <div class="wrapper">
                <div class="content">
                    <div class="row">
                    <div class="side-1 flex-1">
                        <div class="form">
                           <div class="center"><h2>Inventory Log Records</h2>
                           <span>Total records : <?php echo $total;?></span>
                           </div>
                            <table>
                               <?php
                                    $res = getReport($voltex);
                                    if($res == "noitem"){
                                        echo '<div>'."NO RECORDS YET".'</div>';
                                    }
                                    else{
                                        for($i = 0 ; $i < count($res) ; $i++) {
                                            $action = "";
                                            if($res[$i]['action'] == 1){
                                                $action = "Added";
                                            }
                                            else if($res[$i]['action'] == 2){
                                                $action = "Deleted";
                                            }
                                            else{
                                               $action = "Updated"; 
                                            }
                                            
                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<div>';
                                            echo '<p>' . $res[$i]['item_code'] . "has Been " . 
                                                '<strong>'.$action.'</strong>'.
                                                " on " .$res[$i]['date'] ."</p>";
                                            echo '</div></td>';
                                            echo '<td style="text-align:left;">';
                                            echo '<div>';
                                            echo "<label>Last Information</label>";
                                            echo '<ul>';
                                            echo '<li>'. "Quantity:" .  $res[$i]['qty'].'</li>'.
                                                 '<li>'. "Original Price:" .$res[$i]['oprice'].'</li>'.
                                                 '<li>'. "Sell Price:" .$res[$i]['sprice'].'</li>'."</ul>";
                                            echo '</div> </td>'.'</tr>';
                                        }
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                    
                    </div>
                </div>
                <div class="footer"></div>
        </div>
    </body>
</html>