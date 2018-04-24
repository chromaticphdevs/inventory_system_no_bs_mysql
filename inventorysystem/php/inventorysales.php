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
        <title>Sales Management | Voltus Technology</title>
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
                <div class="footer"></div>
        </div>
        <script>
            $(function(){
                 $.ajax({
                        type :'POST',
                        url:'itemsale.ajax.php',
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
                        url:'itemsale.ajax.php',
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
                        url:'itemsale.ajax.php',
                        data:{
                            'code':'null'
                        },
                        success : function(data){
                            $("#body").html(data);
                        }
                    });  
                    }
                });
                 $("#close").on("click",function(){
               $(".side-2").hide(); 
            });
            });
        </script>
        <?php
          if(isset($_POST['submit'])){
            $qty = $_POST['qty'];  
        
            $code =  $_POST['pcode'];
            $date = $_POST['datesold'];
            $client = $_POST['client'];
            $email = $_POST['email'];
            $number  = $_POST['number'];
            $status = $_POST['status'];
            if($qty <=  1){
               ?> 
                   <script>
                        alert("Cannot be processed.");
                   </script>
               <?php 
                return false;
            }
            else{
           $sql = "INSERT INTO sales_report " . " VALUES(null,'$code','$client','$qty','$email','$number','$date','$status')";
           $exe = $voltex->query($sql);
           if($exe == true){
               $sql="UPDATE inventory_items_table SET item_qty = item_qty - '$qty' where item_code = '$code'";
               $exe = $voltex->query($sql);
               if($exe == true){
                   ?> 
                   <script>
                        alert("SOLD.");
                   </script>
               <?php
               }
               else{
                ?> 
                   <script>
                        alert("Unexpected Error Occured.");
                   </script>
               <?php 
               }
           }
           else{
              ?> 
                   <script>
                        alert("Unexpected Error Occured.");
                   </script>
               <?php 
           }   
            }
       
     } 
        ?>
    </body>
</html>