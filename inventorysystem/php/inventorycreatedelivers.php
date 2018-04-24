<?php
    require 'phpcallers.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="../css/config.css">
        <script src="../js/jquery-3.2.1.js"></script>
        <title>Settings | Voltus Technology</title>
        <style>
            .divform{
                margin-top: 5%;
            }
            .lform{
                width: 30%;
                margin: 0px auto;
                padding: 30px;
                background: #fff;
                border-radius: 5px;
                padding-bottom: 10px;
            }
            .lform div input[type="text"],.lform div input[type="password"]{
                width: 100%;
                height: 50px;
                padding: 4px 10px;
                font-size: 12pt;
                border-radius: 5px;
                border: 1px solid #666;
                box-shadow: 0px;
            }
            .lform div label{
                font-size: 11pt;
                color: #595959;
            }
            .lform div{
                margin-bottom: 15px;
            }
            .right{
                text-align: right;
            }
            .center{
                text-align: center;
                font-weight: bold;
                font-size: 15pt;
                color: #004881;
            }
            .alert{
                background-color: #d83c00;
                padding: 10px;
                text-align: center;
                display: none;
            }
            #malert{
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
                <div class="content">
                    <div class="divform">
                   <div class="center">
                       <p>Create deliverers</p>
                   </div>
                        <form class="lform" method="post" action="<?php $_PHP_SELF;?>">
                           <div class="alert">
                                <label id="malert"></label>
                            </div>
                            <div>
                                <label>Deliverer Name:</label>
                                <input type="text" placeholder="Deliverer Name" name="dev_name" id="uname">
                            </div>
                            <div>
                                <label>Deliverer Address:</label>
                                <input type="text" placeholder="Deliverer Address" name="dev_adrs" id="upass">
                            </div>
                            <div>
                                <label>Deliverer Email:</label>
                                <input type="text" placeholder="Deliverer Email" name="dev_email" id="upass">
                            </div>
                            <div>
                                <label>Deliverer Number:</label>
                                <input type="text" placeholder="Deliverer Number" name="dev_tel" id="upass">
                            </div>
                            
                            <div class="right">
                                <input type="submit" name="submit" placeholder="Username" class="butn butn-primary butn-md" value="Save Information">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="footer"></div>
        </div>
        <script>
            $("input[type='submit']").on('click',function(e){
                var uname = $("#uname").val();
                var upass = $("#upass").val();
                if(uname == "" || upass==""){
                    e.preventDefault();
                    $(".alert").slideDown('fast').show(1000).delay(2000).slideUp('fast').hide(2000);
                    $("#malert").html("Empty fields.");
                }
                else if (uname.length < 5 || upass.length < 5 ){
                     e.preventDefault();
                    $(".alert").slideDown('fast').show(1000).delay(2000).slideUp('fast').hide(2000);
                    $("#malert").html("Empty fields.");   
                }
                else{
                    $("form").submit();
                }
            });
        </script>
        <?php
           if(isset($_POST['submit'])){
        srand(microtime() *(1000000));
        $code = "codeair".rand()*rand();
        $dev_code = $code;
        $dev_name = $_POST['dev_name'];
        $dev_adrs = $_POST['dev_adrs'];
        $dev_email = $_POST['dev_email'];
        $dev_tel = $_POST['dev_tel'];
        if(empty($dev_code) || empty($dev_name)){
            PrependHTML("Fields with warning signs are all required","prepend");
            return false;
        }
        else{
            $add = FUNC_addCompany($voltex,$dev_code,$dev_name,$dev_adrs,$dev_email,$dev_tel);
            if($add == true){
                ?> 
                    <script>
                            alert("Registered");
                            window.location="inventoryviewing.php";
                    </script>
                <?php
            }
            else{
                ?> 
                    <script>
                            alert("Duplicate data entry.");
                    </script>
                <?php
            }
        }
           }
        
        ?>
    </body>
</html>