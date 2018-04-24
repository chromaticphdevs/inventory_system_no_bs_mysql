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
                margin-top: 15%;
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
                       <p>Change your information</p>
                   </div>
                        <form class="lform" method="post" action="<?php $_PHP_SELF;?>">
                           <div class="alert">
                                <label id="malert"></label>
                            </div>
                            <div>
                                <label>Username:</label>
                                <input type="text" placeholder="Username" name="username" id="uname">
                            </div>
                            <div>
                                <label>Password:</label>
                                <input type="password" placeholder="Password" name="password" id="upass">
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
                $user = mysql_real_escape_string($_POST['username']);
                $pass = mysql_real_escape_string($_POST['password']);
                $crypt = md5($pass);
                $sql = "UPDATE user_account SET user_name = '$user' , user_password = '$crypt' where userid =1";
                $exe = $voltex->query($sql);
                if($exe == true){
                    ?> 
                        <script>
                        window.location="inventoryviewing.php";
                        </script>
                   <?php
                }
               else{
                   ?> 
                        <script>
                        $(".alert").slideDown('fast').show(1000).delay(2000).slideUp('fast').hide(2000);
                        $("#malert").html("No User Account");
                        </script>
                   <?php
               }
           }
        
        ?>
    </body>
</html>