<?php
    require 'phpcallers.php';
    require 'protection.php';
?>
<?php
    if(isset($_POST['submit'])){
    $dev_code = $_POST['dev_code'];
    $item_code = $_POST['item_code'];
    $item_status = $_POST['item_status'];
    $item_name = $_POST['item_name'];
    $deliveredBy = $_POST['deliveredBy'];
    $org_price = $_POST['org_price'];
    $sel_price = $_POST['sel_price'];
    $item_qty = $_POST['item_qty'];
    $date_delivered = $_POST['dev_date'];
    $img = $_FILES["fileToUpload"]["name"];
    #con,a-code,b-name,c-image,d-status,e-price,f-sel-price,g-qty,h-date,i-deliveredby
        $res  = FUNC_addItem($voltex, $item_code,$item_name,$img,$item_status,$org_price,$sel_price,$item_qty,$date_delivered,$deliveredBy);
    if($res == true){
        $sql= "INSERT INTO package_delivery_items " . "VALUES(null,'$dev_code','$item_code')";
        $execute = $voltex->query($sql);
        if($execute == true){
            $report = FUNC_add_item_report($voltex,$item_code,$dev_code,$date_delivered,$item_qty,$org_price,$sel_price,1);
            if($report == true){
                 $sql = "INSERT INTO table_report(item_code,date,qty,oprice,sprice,action)".
                    " SELECT item_code ,item_date,item_qty,item_price,item_sell_price,3".
                    " from inventory_items_table where item_code ='$item_code'";
            }
        }
        else{
            echo "<script>". 'alert("Un identified error occured")' . "</script>";
        }
    }
    else{
        echo "<script>". 'alert("Un identified error occured")' . "</script>";
    }
       if(empty($_FILES["fileToUpload"]["name"])){
           
       }
        else{
             require 'fileupload.php';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="../css/config.css">
        <script src="../js/jquery-3.2.1.js"></script>
        <title>Add Items | Voltus Technology</title>
        <style>
            .navi{
                margin: 0px;
                padding: 0px;
            }
            .nostyle > li {
                list-style: none;
                display: block;
                padding: 10px;
            }
            #myalert{
                width: 100%;
                text-align: center;
                border: 1px solid red;
                margin-bottom: 10px;
                display: none;
                text-transform: capitalize;
            }
            .title{
                padding: 20px;
            }
            .report li{
                border-bottom: 1px solid #fff;
                padding: 2px 5px;
                margin-bottom: 5px;
            }
            #reports table td{
                border-bottom: 1px solid #000;
                font-family: "tahoma";
                font-size: 10pt;
            }
            #reports{
                font-family: "tahoma";
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
                <div class="content">
                     <div class="col">
                    <div class="side-1 flex-1">
                       <br/>
                       <br/>
                        <h3 class="title h-title" >Fill Package</h3>
                        <div class="alert" id="myalert">
                                    <p id="myAlertMessage">This is an alert Message</p>
                                </div>
                        <div class="row" id="myrow">
                            <div class="row">
                               <div class="flex-2 side-1">
                                   <form class="form" method="post" id="myform" enctype="multipart/form-data" action="<?php $_PHP_SELF;?>">
                                       <div class="flex-row">
                                           <div class="flex-1 side-1">
                                               <table>
                                        <tr style="text-align:left;">
                                            <th colspan="2">Add Item into Selected Package</th>
                                        </tr>
                                        <tr>
                                                <td><label class="label">Delivery Code:</label></td>
                                                <td>
                                                    <select name="dev_code" id="dev_code">
                                                    <?php
                                                    $res = FUNC_getPackageDelivery($voltex);
                                                    if($res=="noitem"){
                                                        echo '<option>'."NO ITEM".'</option>';
                                                    }
                                                    else{
                                                        for($i=0; $i< count($res) ; $i++) : ?>
                                                        
                                                        <option value="<?php echo $res[$i]['pac_dev_code']?>"><?php echo $res[$i]['pac_dev_code']?></option>
                                                        <?php endfor;
                                                    }
                                                    ?>
                                                    </select>
                                                </td>
                                        </tr>
                                        <!-- for ajax -->
                                        <!-- for ajax -->
                                        <tr>
                                            <td><label class="label">Item Code:</label></td>
                                                <td><input type="text" id="item_code" name="item_code" placeholder="Item Code:">
                                                <span id="mes_item_code"></span>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Item Name:</label></td>
                                                <td><input type="text" id="item_name" name="item_name" placeholder="Item Name:">
                                                <span><label id="item_name_alert" class="label"></label></span>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Delivered By:</label></td>
                                                <td><input type="text" id="deliveredBy" name="deliveredBy" placeholder="Item Delivered By">
                                                <span><label id="item_name_alert" class="label"></label></span>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Original Price:</label></td>
                                                <td><input type="text" id="org_price" name="org_price" placeholder="Original Price">
                                                </td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Sell Price:</label></td>
                                                <td><input type="text" id="sel_price" name="sel_price" placeholder="Sell Price">
                                                </td>
                                        </tr>
                                    </table>
                                        <table></table>
                                           </div>
                                       </div>
                               </div>
                               <div class="flex-2 side-1">
                                   <div class="form">
                                       <table>
                                        <th colspan="2">Report Information</th>
                                        <tr>
                                            <td><label class="label">Item Status:</label></td>
                                                <td>
                                                    <input type="text" placeholder="Type your Status Note Here" name="item_status" id="item_status"> 
                                                </td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Item Quantity:</label></td>
                                                <td>
                                                    <input type="text" placeholder="Quantity" name="item_qty" id="item_qty"> 
                                                </td>
                                        </tr>
                                           <tr>
                                            <td><label class="label">Date Delivered:</label></td>
                                                <td>
                                                    <input type="date" name="dev_date" id="dev_date"> 
                                                </td>
                                        </tr>
                                        
                                           
                                        <tr>
                                            <td><label class="label">Select Product Picture:</label></td>
                                                <td>
                                                    <input type="file" name="fileToUpload" id="fileToUpload"> 
                                                </td>
                                        </tr>
                                        <tr style="text-align:right">
                                            <td colspan="2">
                                                <button id="submit" class="butn butn-primary butn-md" name="submit">Add Item</button>
                                            </td>
                                        </tr>
                                       </table>
                                   </div>
                                   </form>
                                   
                               </div>
                               <div class="flex-1 side-1">
                                    <div id="currentPackage"></div>
                                   <div class="form" id="reports"> 
                                       
                                   </div>
                               </div>
                            </div>
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
            $("#submit").on("click",function(e){
                var properties = [$("#item_code").val(),$("#dev_code").val(),$("#dev_date").val()];
                    if( properties[0] == "" || properties[1] == "" || properties[2] == "" ){
                        e.preventDefault();
                        $("#myAlertMessage").text("delivery code, item code and date cannot be empty");
                     $("#myalert").slideDown('fast').show(1000).delay(2000).slideUp('fast').hide(2000);  
                        console.log(properties[0]); 
                    }
                    else{
                        $("#myform").submit();
                    }
            });
            $("#dev_code").on('change',function(){
                var dcode = $("#dev_code").val();
                $.ajax({
                        type :'POST',
                        url:'packageitems.php',
                        data:{
                            'code':dcode
                        },
                        success : function(data){
                            $("#reports").html(data);
                            $("#currentPackage").html("Items in :" + '<strong>' +dcode+ '</strong>');
                        }
                    });
            });
            </script>
    </body>
</html>