<?php
    require 'connection.php';
    require 'functions.php';
    $code = $_POST['code'];
    $res = FUNC_getAllItem($voltex,$code,null,false);
    for($i=0; $i < count($res) ; $i++) : ?>
     <table>
                            <th colspan="2">Product Code :<?php echo $res[$i]['item_code']?> </th>
                            <tr style="text-align:center;">
                            <td colspan="2"><img src="../assets/<?php echo $res[$i]['item_image']?>"
                            style="width:300px;"></td>
                            </tr>
                            <tr>
                                <td>Date Bought</td>
                                <td><input type="date" name="datesold"></td>
                            </tr>
                            <tr>
                            <td>Product Name</td>
                            <input type="hidden" value="<?php echo $res[$i]['item_code']?>" name="pcode">
                            <td><strong><?php echo $res[$i]['item_name']?></strong></td>
                            </tr>
                            <tr><td>Sold To:</td>
                            <td>
                            <input type="text" placeholder="Client Name:" name="client">
                            </td>
                           </tr>
                           <tr>
                               <td>Quantity</td>
                                <td><input type="text" name="qty" placeholder="Quantity"></td>
                           </tr>
                            <tr><td>Email:</td>
                            <td>
                            <input type="text" placeholder="Client Email:" name="email">
                            </td><tr>
                            <tr><td>Phone Number:</td>
                            <td>
                                <input type="text" placeholder="Cient Phonenumber" name="number">
                            </td><tr>
                            <tr><td>Sale Comment:</td>
                            <td>
                                <input type="text" placeholder="Comment" name="status">
                            </td><tr>
                            <tr style="text-align:right">
                            <td colspan="2">
                                <input type="submit" class="butn butn-success butn-md" value="Approved" name="submit">
                            </td>
                            </tr>
     </table>
    <?php endfor;
                            
                          
                                
                                
                                
?>