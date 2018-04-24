<?php
    require 'connection.php';
    require 'functions.php';
    $code = $_POST['code'];
    $datas = array();
    ###########

    $sql2 = "SELECT pac_dev_from,pd.pac_dev_date , td.* from package_delivery as pd 
    join tbl_deliverer td ON pd.pac_dev_from = td.dev_id where pd.pac_dev_code = '$code';"; 
    $exe2 = $voltex->query($sql2);
    
    ################



    $sql = "";
    $sql = "SELECT pd.dev_pac_code , pd.item_code ,it.* from package_delivery_items as pd 
    right join inventory_items_table as it on it.item_code = pd.item_code where pd.dev_pac_code = '$code'"; 
    $exe = $voltex->query($sql);
    if($exe == true){ 
        while($res2 = $exe2->fetch_assoc()) :?>
           <tr>
            <td colspan="8">
                <ul class="information">
                <li>From: <?php echo $res2['dev_name']?></li>
                <li>address: <?php echo $res2['dev_adrs']?></li>
                <li>Email: <?php echo $res2['dev_emails']?></li>
                <li>Phone: <?php echo $res2['dev_phones']?></li>
                <li>On: <?php echo $res2['pac_dev_date']?></li>
            </ul>
            </td>
           </tr>
        <?php endwhile;
        
        
         while($res = $exe->fetch_assoc()) : ?>
           <tr>
                <td><img src="../assets/<?php echo $res['item_image']?>"></td>
                <td><?php echo $res['item_code']?></td>
                <td><?php echo $res['item_price']?></td>
                <td><?php echo $res['item_sell_price']?></td>
                <td><?php echo $res['item_qty']?></td>
                <td><?php 
                        if($res['item_status'] == ""){
                            echo '<label class="red">'."Not Avaliablable".'</label>';
                        }else{
                            echo $res['item_status'];
                        }
                    ?></td>
                <td>
                <form method="get" id="myformXD" action="<?php $_PHP_SELF;?>">
                   <input type="hidden" name="cval" value="<?php echo $res['item_code'];?>">
                    <button class="butn butn-primary butn-sm" 
                    id="<?php echo $res['item_code'];?>">
                        View
                    </button>
                <input type="submit" value="Delete" class="butn butn-danger butn-sm" name="delete">       
                </form>
                </td>
            </tr>
       <?php endwhile;
    }
    else{
        echo "FALSE";
    }
?>
<script>
    $(function(){
      $("button").click(function(e){
        e.preventDefault();
        var thisbtn = this.id;
         $.ajax({
                        type :'POST',
                        url:'itemviewwidget.php',
                        data:{
                            'code':thisbtn
                        },
                        success : function(data){
                            $("#item_viewing").html(data);
                            $(".side-2").show();
                        }
                    });
      });
    });
</script>