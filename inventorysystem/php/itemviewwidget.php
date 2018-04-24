<?php
    require 'connection.php';
    require 'functions.php';
    $code = $_POST['code'];
    $res = FUNC_getAllItem($voltex,$code,null,false);
    for($i=0; $i < count($res) ; $i++) : ?>
     <table>
                         <th colspan="2">Product Code :<?php echo $res[$i]['item_code']?> </th>
                        <tr>
                            <th colspan="2">Delivered By :<?php echo $res[$i]['item_delivered_by']?> </th>
                        </tr>
                            <tr style="text-align:center;">
                            <td colspan="2"><img src="../assets/<?php echo $res[$i]['item_image']?>"
                            style="width:300px;"></td>
                            </tr>
                            <tr>
                            <td>Product Name</td>
                            <input type="hidden" value="<?php echo $res[$i]['item_code']?>" name="pcode">
                            <td><input type="text" placeholder="Product Name:" name="p_name"  value="<?php echo $res[$i]['item_name']?>"></td><tr>
                            <tr><td>Product Original Price</td>
                            <td>
                            <input type="text" placeholder="original price:" name="oprice"  value="<?php echo $res[$i]['item_price']?>">
                            </td><tr>
                            <tr><td>Product Sell Price</td>
                            <td>
                            <input type="text" placeholder="sell price:" name="sprice"  value="<?php echo $res[$i]['item_sell_price']?>">
                            </td><tr>
                            <tr><td>Product Quantity</td>
                            <td>
                                <input type="text" placeholder="quantity" name="qty"  value="<?php echo $res[$i]['item_qty']?>">
                            </td><tr>
                            <tr><td>Product Status:</td>
                            <td>
                                <input type="text" placeholder="status:" name="status"  value="<?php echo $res[$i]['item_status']?>">
                            </td><tr>
                            <tr style="text-align:right">
                            <td colspan="2">
                                <input type="submit" class="butn butn-success butn-md" value="Update" name="submit">
                            </td>
                            </tr>
     </table>
    <?php endfor;
                            
                          
                                
                                
                                
?>