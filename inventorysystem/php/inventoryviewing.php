<?php
    require 'phpcallers.php';
    require 'protection.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="../css/config.css">
        <link rel="stylesheet" href="../css/salesandviewing.css">
        <script src="../js/jquery-3.2.1.js"></script>
        <title>Inventory List | Voltus Technology</title>
        <style>
            .viewing table img {
                width: 80px;
            }
            #body table img{
                width: 80px;
                height: 80px;
            }
        </style>
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
                        <div class="viewing">
                           <div class="navigation-tool">
                               <h3 class="h-title">Item Viewing</h3>
                               <input type="text" placeholder="search here" id="searchbar">
                           </div>
                            <table>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Product Original Price</th>
                                    <th>Product Sell Price</th>
                                    <th>Product Quantity</th>
                                    <th>Product Comment:</th>
                                    <th>Action</th>
                                </tr>
                                <tbody id="body">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                                       
                    <div class="side-2 flex-2">
                       <div style="text-align:right;"><a href="#" class="butn butn-sm" id="close">&times;</a></div>
                        <div class="tbl-sm" >
                            <form id="item_viewing" method="post">
                                
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="footer">
                    <?php
                        include 'footer.php';
                    ?>
                </div>
        </div>
        <script>
            $(function(){
                 $.ajax({
                        type :'POST',
                        url:'itemview.ajax.php',
                        data:{
                            'code':'null'
                        },
                        success : function(data){
                            $("#body").html(data);
                        }
                    });
                /*
                #$("#body").html("FUCKKK UOU");
                */
                $("#searchbar").on("keyup",function(){
                    var lngth = $("#searchbar").val();
                    if(lngth.length > 0) {
                       $.ajax({
                        type :'POST',
                        url:'itemview.ajax.php',
                        data:{
                            'code':lngth
                        },
                        success : function(data){
                            $("#body").html(data);
                        }
                    });   
                    }
                    else{
                      $.ajax({
                        type :'POST',
                        url:'itemview.ajax.php',
                        data:{
                            'code':'null'
                        },
                        success : function(data){
                            $("#body").html(data);
                        }
                    });  
                    }
                });
                
            });
            $("#close").on("click",function(){
               $(".side-2").hide(); 
            });
        </script>
    </body>
   <?php
        if(isset($_GET['delete'])){
            $code = $_GET['cval'];
            $sql = "INSERT INTO table_report(item_code,date,qty,oprice,sprice,action)".
                    " SELECT item_code ,item_date,item_qty,item_price,item_sell_price,2".
                    " from inventory_items_table where item_code ='$code'";
            $exe = $voltex->query($sql);
            if($exe == true){
               $code = $_GET['cval'];
                $sql = "DELETE FROM inventory_items_table where item_code = '$code'";
                $exe = $voltex->query($sql);
            }
            else{
                echo "FALSE";
            }
        }
                                  
                                        
                                
     if(isset($_POST['submit'])){
        $code =  $_POST['pcode'];
        $name = $_POST['p_name'];
        $oprice = $_POST['oprice'];
        $sprice = $_POST['sprice'];
        $qty = $_POST['qty'];
        $status  = $_POST['status'];
        
        $sql = "INSERT INTO table_report(item_code,date,qty,oprice,sprice,action)".
                    " SELECT item_code ,item_date,item_qty,item_price,item_sell_price,3".
                    " from inventory_items_table where item_code ='$code'";
         $exe = $voltex->query($sql);
            if($exe == true){
               $sql = "UPDATE inventory_items_table SET item_name = '$name', 
                       item_price = '$oprice' , item_sell_price = '$sprice', item_qty = '$qty',
                       item_status = '$status' where item_code = '$code'";
                $exe = $voltex->query($sql);
                ?> 
                    <script>
                        alert("Updated");
                    </script>
                <?php
            }
            else{
                echo "FALSE";
            }
       
     } 
    ?>
          
</html>