<?php
    require 'phpcallers.php';
    require 'protection.php';
function salesReport($con){
            $datas = array();
                /*
                    $sql="SELECT tr.item_code,item_name,action ,date from table_report as tr
                    LEFT join inventory_items_table as ae 
                    on tr.item_code = ae.item_code LIMIT 4";
                */
            $sql = "SELECT * from sales_report order by date ";
            $execute = $con->query($sql);
            if($execute == true){
                if($row = $execute->num_rows > 0 ){
                    while ($r = $execute->fetch_assoc()){
                        $datas[] = $r;
                    }
                }
                else{
                    $datas = "noitem";
                }
            }
            return $datas;
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="../css/config.css">
        <script src="../js/jquery-3.2.1.js"
        ></script>
        <style>
            table{
                width: 100%;
                display: block;
                font-family: "tahoma";
            }
            table td {
                width: 10%;
                padding: 2px 10px;
                border-bottom: 1px solid #666;
            }
            .snostyle{
                list-style: none;
                padding: 0px;
                margin: 0px auto;
                text-align: center;
            }
            .snostyle img{
                width: 150px;
            }
            .snostyle li {
                font-size: 12pt;
                font-family: "tahoma";
                color: #014782;
                margin: 5px;
            }
            thead td{
                color: #d83c00;
                font-weight: bold;
            }
            .headers{
                width: 100%;
                margin-bottom: 50px;
            }
            .middle{
                padding: 20px;
            }
            .headers label{
                font-size: 15pt;
                color: #014782;
                font-weight: bold;
            }
            .headers  button {
               text-align: right;
            }
        </style>
        <title>Sales And Reports | Voltus Technology</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="navigation">
                <?php
                    include 'navigation.php';
                ?>
            </div>
                <div class="content" style="margin-top:60px;">
                    <div class="row">
                    <div class="middle flex-4">
                      <div class="headers"><label>Sales Report</label>
                      <a href='inventorysalesreport.php?view=iframeinseritem' class="butn butn-warning butn-sm" style="float:right;">Add Item</a>
                      </div>
                      <div>
                          <table>
                          <thead>
                          <td>Product Code</td>
                          <td>Client</td>
                          <td>Email</td>
                          <td>Contact</td>
                          <td>Status</td>
                          <td>Quantity:</td>
                          <td>Date:</td>
                          </thead>
                          <?php
                              $res = salesReport($voltex);
                              if($res == "noitem"){
                                  echo '<td>No Item</td>';
                              }
                              else{
                                  for($i = 0 ; $i < count($res) ; $i++) :?> 
                                  <tr>
                                      
                                      <td>
                                    <a href="inventorysalesreport.php?view=<?php echo $res[$i]['item_code']?>">
                                      <?php echo $res[$i]['item_code']?>
                                  </a></td>
                                  <td><?php echo $res[$i]['buyer']?></td>
                                  <td><?php echo $res[$i]['buyeremail']?></td>
                                  <td><?php echo $res[$i]['buyerphone']?></td>
                                  <td><?php echo $res[$i]['transactionstatus']?></td>
                                  <td><?php echo $res[$i]['qty']?>:</td>
                                  <td><?php echo $res[$i]['date']?></td>
                                  </tr>
                                  <?php endfor;
                              }
                          ?>

                          </table>
                      </div>
                    </div>
                    <div class="side-2 flex-4">
                       <?php
                         if(isset($_REQUEST['view'])){
                             if($_REQUEST['view'] == "iframeinseritem"){
                                 ?> 
                                 <iframe src="inventoryadditemwidget.php" width="100%" height="100%"></iframe>
                                 <?php
                             }
                             else{
                                 echo '<ul class="snostyle">';
                            $src = $_REQUEST['view'];
                            $sql = "SELECT * FROM inventory_items_table where item_code = '$src' GROUP BY item_code ORDER BY item_code , item_name,item_status,item_price";
                            $exe = $voltex->query($sql);
                             if($exe == true){
                                 if($row = $exe->num_rows > 0 ){
                                     while ($r = $exe->fetch_assoc()) : ?>
                                 <li><img src="../assets/<?php echo $r['item_image']?>"></li>
                                 <li>Item Code:<?php echo $r['item_code']?></li>
                                 <li>Item Name:<?php echo $r['item_name']?></li>
                                 <li>Item Status:<?php echo $r['item_status']?></li>
                                 <li>Item Price:<?php echo $r['item_price']?></li>
                                 <li>Item Sell Price:<?php echo $r['item_sell_price']?></li>
                                 <li>Item Quantity:<?php echo $r['item_qty']?></li>
                                 <li>Item Comment:<?php echo $r['item_status']?></li>
                                 <li><button class="butn butn-primary butn-lg" onclick="jumpMe()">Item Viewing</button></li>
                                 <?php endwhile;
                                 }
                                 else{
                                     echo " <li>Noitem</li>";
                                 }
                             }
                             echo '</ul>';
                             }
                        }
                        ?>
                    </div>
                    </div>
                </div>
                <div class="footer"></div>
        </div>
        <script>
            function jumpMe(){
                window.location = "inventoryviewing.php";
            }
        </script>
    </body>
</html>