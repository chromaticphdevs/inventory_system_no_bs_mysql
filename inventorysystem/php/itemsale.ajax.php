<?php
    require 'connection.php';
    require 'functions.php';
    $code = $_POST['code'];
    if($code == "null"){
        $res = FUNC_getAllItem($voltex,null,10,false);
        if($res == "noitem")
            echo "noitem";
        else{
            $i = 0;
            while ($i < count($res) ) : ?>
            <tr>
                <td><img src="../assets/<?php echo $res[$i]['item_image']?>"></td>
                <td><?php echo $res[$i]['item_code']?></td>
                <td><?php echo $res[$i]['item_name']?></td>
                <td><?php echo $res[$i]['item_price']?></td>
                <td><?php echo $res[$i]['item_sell_price']?></td>
                <td><?php echo $res[$i]['item_qty']?></td>
                <td><?php echo $res[$i]['item_status']?></td>
                <td>
               <form method="get" id="myformXD">
                   <input type="hidden" name="cval" value="<?php echo $res[$i]['item_code'];?>">
                    <button class="butn butn-success butn-sm" 
                    id="<?php echo $res[$i]['item_code'];?>">
                        Buy
                    </button>      
                </form>
                </td>
                
            </tr>
            
            <?php $i++; endwhile;
        }
    }
    else{
        $res = FUNC_getAllItem($voltex,$code,10);
        
        if($res == "noitem")
            echo "noitem";
        else{
            $i = 0;
            while ($i < count($res) ) : ?>
            <tr>
                <td><img src="../assets/<?php echo $res[$i]['item_image']?>"></td>
                <td><?php echo $res[$i]['item_code']?></td>
                <td><?php echo $res[$i]['item_name']?></td>
                <td><?php echo $res[$i]['item_price']?></td>
                <td><?php echo $res[$i]['item_sell_price']?></td>
                <td><?php echo $res[$i]['item_qty']?></td>
                <td><?php echo $res[$i]['item_status']?></td>
                <td>
                  <form method="get" id="myformXD">
                   <input type="hidden" name="cval" value="<?php echo $res[$i]['item_code'];?>">
                    <button class="butn butn-success butn-sm" 
                    id="<?php echo $res[$i]['item_code'];?>">
                        Buy
                    </button>      
                </form>
                </td>
            </tr>
            
            <?php $i++; endwhile;
        }
    }
?>

<script>
    $(function(){
      $("button").click(function(e){
        e.preventDefault();
        var thisbtn = this.id;
          $.ajax({
                        type :'POST',
                        url:'itemsalewidget.php',
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
<!-- 

//fethcing datas
        function FUNC_getAllItem($con,$param=null,$limit=null){
-->