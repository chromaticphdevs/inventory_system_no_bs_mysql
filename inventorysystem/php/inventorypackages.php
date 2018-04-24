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
        <script src="../js/jquery-3.2.1.js"></script>
        <style>
            table {
                width: 100%;
                font-family: "tahoma";
                font-size: 10pt;
                font-weight: bold;
                color: #004881;
                padding: 10px;
            }
            table img{
                width: 70px;
            }
            .flex-1,.flex-4{
                padding: 10px;
            }
            .side-1 div{
                margin-bottom: 10px;
            }
            .middle> ul{
                list-style: none;
                margin: 0px;
                padding: 0px;
                height: auto;
            }
            .middle >ul li{
                width: 100%;
                display: block;
                margin-bottom:10px;
                height: 30px;
            }
            .middle >ul li a {
                display: block;
                width: 100%;
                font-size: 10pt;
                padding: 10px 5px;
                height: auto;
                background-color: #e6e6e6;
            }
            .code{
                font-weight: bold;
                color: #f65314;
            }
            .red{
                color: #ba0004;
            }
            #elements{
                min-height: 100px;
                max-height: 600px;
                overflow-y: scroll;
            }

            #elements tr:first-child{
                background-color: #004881;
            }
            #elements tr:nth-child(even){
                background-color: #ededed;
            }
            #sideView{
                display: none;
            }
            .inline li{
                display: inline-block;
            }
            .information{
                margin: 0px;
                padding: 0px;
                border: 1px solid red;
                width: 100%;
                padding: 5px;
            }
            .information li{
               display: inline-block;
               margin-right: 10px;
                color: #fff;
                padding: 2px 10px;
            }
        </style>
        <title>Default Webpage</title>
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
                    <div class="middle flex-1 side-1">
                        <?php
                        $sql = "SELECT * FROM `package_delivery_items` GROUP By dev_pac_code";
                        $packageCount = array();
                        $exe = $voltex->query($sql);
                        if($exe == true){
                            if($row  = $exe->num_rows > 0){
                                while($r = $exe->fetch_array()){
                                    $packageCount[] = $r;
                                }
                            }
                            else{
                                $packageCount = "noitem";
                            }
                        }
                        ?>
                        <ul>
                        <?php
                            
                        for($i = 0 ; $i < count($packageCount); $i++) : ?>
                        <li><a href="#" id="<?php echo $packageCount[$i]['dev_pac_code']?>">
                        Package Code: <span class="code"><?php echo $packageCount[$i]['dev_pac_code']?></span></a></li>
                        <?php endfor;
                            ?>
                        </ul>
                    </div>
                    <div class="flex-4 side-1">
                       <div style="text-align:center">

                           <label><span id="package"></span></label>
                       </div>
                        <form>
                            <table id="elements">
                            </table>
                        </form>
                    </div>
                    <div class="side-2 flex-2" id="sideView">
                       <div style="text-align:right;"><a href="#" class="butn butn-sm" id="close">&times;</a></div>
                        <div class="tbl-sm">
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
                 $("#elements").html("Click on the packages ");
               $("a").click(function(){
                   var randid = $(this).attr('id');
                   $.ajax({
                        type :'POST',
                        url:'packageditems.ajax.php',
                        data:{
                            'code':randid
                        },
                        success : function(data){
                            $("#elements").html(data);
                            $("#package").html("Package:"+randid);
                        }
                    }); 
               });
                $("#close").on("click",function(e){
                e.preventDefault();
                $(".side-2").hide(); 
            });
            });
        </script>
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
    </body>
</html>