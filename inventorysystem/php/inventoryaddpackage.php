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
        <script src="../js/jquery-3.2.1.js"> </script>
        <title>Inventory Packaging | Voltus Technology</title>
        <style>
            #myrow{
                justify-content: space-around;
            }
            .title{
                padding: 20px;
            }
            #myalert{
                width: 100%;
                text-align: center;
                border: 1px solid red;
                margin-bottom: 10px;
                display: none;
                text-transform: capitalize;
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
                    <div class="col">
                    <div class="side-1 flex-1">
                        <h3 class="h-title title">Package Creator</h3>
                                <div class="alert" id="myalert">
                                    <p id="myAlertMessage">This is an alert Message</p>
                                </div>
                        <div class="row" id="myrow">
                            <div class="row">
                               <div class="flex-1 side-1">
                                   <form class="form" id="myform" method="post" action="addpackage.php">
                                       <table>
                                        <tr style="text-align:left;">
                                            <th colspan="2">Product Information</th>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Package Code : </label></td>
                                            <td><input type="text" name="pac_code" id="pac_code" placeholder="Package Code">
                                            <span class="inputwarning"><label class="label" id="pac_code_mes"></label></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">From: </label> </td>
                                            <td>
                                               <select name="pac_from" id="pac_from">
                                                <?php
                                                $res = get_tbl_deliverers($voltex);
                                                if($res == "noitem")
                                                {
                                                    echo '<option>' .$res. '</option>';
                                                }
                                                else{
                                                    for($i = 0 ; $i < count($res) ; $i++) : ?>
                                                    <option value="<?php echo $res[$i]['dev_id']?>"><?php echo $res[$i]['dev_name']?></option>
                                                    <?php endfor;
                                                }
                                                ?>
                                               </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Reciever </label></td>
                                            <td><input type="text" name="pac_rev" id="pac_rev" placeholder="Reciever"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Reference : </label> </td>
                                            <td><input type="text" name="pac_ref" id="pac_ref" placeholder="Reference"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Date : </label> </td>
                                            <td><input type="date" name="pac_date" id="pac_date"></td>
                                        </tr>
                                    </table>
                               </div>
                               <div class="flex-1 side-2">
                                       <div class="form">
                                           <table>
                                        <tr style="text-align:left;">
                                            <th colspan="2">Product Reminder</th>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Expected Items : </label></td>
                                            <td><input type="text" name="pac_expect" id="pac_expect" placeholder="Expected Items"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Status: </label> </td>
                                            <td>
                                               <select name="pac_status" id="pac_status">
                                                <option value="1">Finished</option>
                                                <option value="0">UnFinished</option>
                                               </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="label">Comment: </label></td>
                                            <td>
                                                <textarea class="txtarea" style="height:30px;" rows="3" name="pac_text" id="pac_text" > </textarea>
                                            </td>
                                        </tr>
                                        <tr style="text-align:right">
                                            <td colspan="2"><button  type="submit" id="submit" name="input" class="butn butn-primary butn-md">Add Package</button></td>
                                        </tr>
                                    </table>
                                       </div>
                                   </form>
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
            $(function(){
             /*
             $("#pac_code").on("keyup",function()
             {
                var myvar = $("#pac_code").val().toLowerCase();
                if(myvar != ""){
                    $.ajax({
                        type :'POST',
                        url:'fieldsearcher.php',
                        data:{
                            'table_name' : 'package_delivery',
                            'field_name' : 'pac_dev_code',
                            'tofind': myvar
                        },
                        success : function(data){
                            if(data == "false")
                                $("#pac_code_mes").text("NewRecord");
                            else
                                $("#pac_code_mes").text("RecordExists");
                        }
                    });
                }
                else{
                    $("#pac_code_mes").text("");
                }
            }); 
             */
            $("#submit").on('click',function(e){
                   if($("#pac_code").val() == ""){
                       e.preventDefault();
                     $("#myAlertMessage").text("Package code cannot be empty");
                     $("#myalert").slideDown('fast').show(1000).delay(2000).slideUp('fast').hide(2000);  
                   }
                   else if($("#pac_code").val().length < 3){
                       var conf = confirm("do you wish to continue");
                       if(conf == false)
                       {
                        e.preventDefault(); 
                        $("#myAlertMessage").text("Canceled");
                        $("#myalert").show(1000).delay(800).hide(2000);
                        }
                       else{
                          if($("#pac_code_mes").text() == "RecordExists"){
                              e.preventDefault();
                              alert("That product code already Exist Try a new one");
                          }
                           else{
                                $("#myform").submit(); 
                           }
                         
                       }
                   }
                else{
                    if($("#pac_code_mes").text() == "RecordExists"){
                              e.preventDefault();
                              alert("That product code already Exist Try a new one");
                          }
                           else{
                                $("#myform").submit(); 
                           }
                }
            });
            });
        </script>
    </body>
</html>