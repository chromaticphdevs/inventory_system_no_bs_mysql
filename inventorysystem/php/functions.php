<?php
        /*
        con,a-code,b-name,c-image,d-status,e-price,f-sel-price,g-qty,h-date,i-deliveredby
        */
        function FUNC_addItem($con, $a,$b,$c='null',$d='null',$e='null',$f='null',$g='null',$h,$i){
            $value = $g;
            $status = $d;
            $returned;
            $finder = My_searcher($con,'inventory_items_table','item_code',$a,true);
            if($finder == true)
            { // check if the product exist update if exists otherwise add
                //connection item_code deliverycode, date, qty
                 $updated_item = FUNC_add_qty_val($con,'inventory_items_table','item_qty','item_code',$a,$value);
                    if($updated_item == true){
                        $returned = true;
                    }
                    else{
                        $returned = false;
                    }
            }
            else{
            $sql = "INSERT INTO inventory_items_table "." VALUES(null,'$a','$b','$c','$status','$e','$f','$g','$h','$i')";
            $execute = $con->query($sql);
                if($execute == false){
                    $returned = false;
                }
                else{
                    $returned = true;
                }
            }
            return $returned;
            $conn->close();
        }
        //connection item_code deliverycode, date, qty,action
        function FUNC_add_item_report($con,$a,$b,$c,$d=null,$oprice,$sprice,$action){
            $return;
            $sql = "INSERT INTO table_report "." VALUES(null,'$a','$b','$c','$d','$oprice','$sprice','$action')";
            $execute = $con->query($sql);
            if($execute == true){
              $return = true;
            }
            else{
                $return = false;
            }
            return $return;
            $con->close();
        }

    

            /*
            #con,devcode,devdate,devrefname,devfrom,devrecieve,devexpectitems
            devstat
            devnote
            */
        function FUNC_addDelivery($con,$a,$b,$c,$d,$e,$f,$g,$h){
            $returned;
            $sql = "INSERT INTO package_delivery ". 
                " VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h')";
            $execute = $con->query($sql);
            if($execute == false){
                die(mysqli_error($con));
                $returend =false;
            }
            else{
                $returned = true;
            }
            return $returned;
            $conn->close();
        }

        function referenceMaker(){
            srand( microtime() * 100000000 );
            $num = rand(10,50,1,20);
            return $num;
        }


       function FUNC_addCompany($con,$code,$name,$adrs,$emails,$phone){
           $returned;
           $sql = "INSERT INTO tbl_deliverer " ." VALUES(null,'$code','$name','$adrs','$emails','$phone')";
               $execute = $con->query($sql);
               if($execute == true){
                   $returned = true;
               }
               else{
                   $returned = false;
               }
           return $returned;
           $conn->close();
       }
       function FUNC_addDevContacts($con,$code,$type,$val){
           $returned;
           $sql = "INSERT INTO tbl_deliverer_contacts " ." VALUES(null,'$code','$type','$val')";
           $execute = $con->query($sql);
           if($execute == true){
               $returned = true;
           }
           else{
               $returned = false;
           }
           return $returned;
           $conn->close();
       }

        function getReport($con){
            $datas = array();
                /*
                    $sql="SELECT tr.item_code,item_name,action ,date from table_report as tr
                    LEFT join inventory_items_table as ae 
                    on tr.item_code = ae.item_code LIMIT 4";
                */
            $sql = "SELECT * from table_report order by action ";
            $execute = $con->query($sql);
            if($execute == true){
                if($row = $execute->num_rows > 0 ){
                    while ($r = $execute->fetch_assoc()){
                        $datas[] = $r;
                    }
                }
                else{
                    $datas = "noitem";
                }
            }
            return $datas;
        }
        //fethcing datas
        function FUNC_getAllItem($con,$param=null,$limit=null,$search = true){
            $sql = "";
            $searchtype = "";
            if($search == true){
                $searchtype = " like '%$param%' ";
            }
            else{
                $searchtype = " = '$param' ";
            }
            
            if($param == null){
                if($limit ==null){
                    $sql = "SELECT * FROM inventory_items_table GROUP BY item_code order by item_name , item_code , item_qty";
                }else{
                    $sql = "SELECT * FROM inventory_items_table GROUP BY item_code  order by item_name , item_code , item_qty LIMIT $limit";
                }
            }
            else{
                if($limit == null){
                    $sql = "SELECT * FROM inventory_items_table where item_code $searchtype  GROUP BY item_code ORDER BY item_code , item_name,item_status,item_price";
                }
                else{
                    $sql = "SELECT * FROM inventory_items_table where item_code $searchtype  GROUP BY item_code ORDER BY item_code , item_name,item_status,item_price LIMIT $limit";
                }
            }
            $execute = $con->query($sql);
            $datas = array();
            if($execute == false){
                die(mysqli_error($con));
            }
            else{
                if($row = $execute->num_rows > 0){
                    while($row = $execute->fetch_assoc()){
                    $datas[] = $row;
                }
                }
                else{
                    $datas = "noitem";
                }
            }
            return $datas;
            $conn->close();
        }
        function FUNC_getPackageDelivery($con,$param = null, $limit = null)
        {
            $sql = "";
            if ( $param == null ) 
            {
                if ( $limit == null ) {
                    $sql = "SELECT * FROM package_delivery";
                }else
                {
                    $sql = "SELECT * FROM package_delivery LIMIT $limit";
                }
            }
            else
            {
                if ( $limit == null){
                  $sql = "SELECT * FROM package_delivery WHERE pac_dev_code = '$param'";  
                }else{
                  $sql = "SELECT * FROM package_delivery WHERE pac_dev_code = '$param' LIMIT $limit";    
                }
            }
            $execute = $con->query($sql);
            $datas = array();
            if($execute == true)
            {
                if($row = $execute->num_rows < 1){
                   $datas = "noitem";
                }
                else{
                    while($r = $execute->fetch_assoc()){
                        $datas[] = $r;
                    }
                }
            }
            else{
                $datas = die(mysqli_error($con));
            }
            return $datas;
            $con->close();
        }



        function FUNC_getBundeleditems($con,$param=null,$limit=null)
        {
            if( $param == null )
            {
                if( $limit == null ){
                $sql ="SELECT * , child.dev_pac_code as code from inventory_items_table as parent INNER JOIN package_delivery_items as child on parent.item_code = child.item_code";
                }
                else{
                $sql="SELECT * , child.dev_pac_code as code  from inventory_items_table as parent INNER JOIN package_delivery_items as child on parent.item_code = child.item_code LIMIT $limit";
                }
            }
            else
            {
                if($limit==null){
                 $sql="SELECT * , child.dev_pac_code as code from inventory_items_table as parent INNER JOIN package_delivery_items as child on parent.item_code = child.item_code where child.item_code = '$param'";   
                }
                else{
                   $sql="SELECT * , child.dev_pac_code as code from inventory_items_table as parent INNER JOIN package_delivery_items as child on parent.item_code = child.item_code where child.item_code = '$param' LIMIT $limit";  
                }
            }
          $execute = $con->query($sql);
          $datas = array();
          if($execute == true)
          {
              if($row= $execute->num_rows > 0){
                  while($r = $execute->fetch_assoc()){
                      $datas[]= $r;
                  }
              }
              else{
                  $datas = "noitem";
              }
          }
          else{
             $datas=die(mysqli_error($con));
          }
        return $datas;
            $con->close();
        }        
        
    
        function get_tbl_deliverers($con){
            $datas = array();
            $sql = "SELECT * FROM tbl_deliverer";
            $execute = $con->query($sql);
            if($execute == true){
                $counter = table_counter($con,'tbl_deliver');
                if($counter != "noitem"){
                    while($row = $execute->fetch_assoc()){
                    $datas[]= $row;
                    }
                }
                else{
                    $datas = "noitem";
                }
            }
            else{
                $datas = false;
            }
            return $datas;
        }

    //
        function table_counter($con,$table_name){
            $return;
            $sql = "SELECT COUNT(*) as total from $table_name";
            $execute = $con->query($sql);
            if($execute == true){
                if($row = $execute->num_rows > 0){
                   while($r = $execute->fetch_assoc()){
                       $row = $r['total'];
                   }
                    $return = $row;
                }
                else{
                    $return = "noitem";
                }
            }
            else{
                $return  = mysqli_error($con);
            }
            return $return;
            $con->close();
        }      
        function My_searcher($con,$table_name,$field,$code,$param=false){
            $result;
            $condition = "";
            if($param == true)
                $condition = " Like '%$code'";
            else
            {
                $condition = " = " . $code; 
            }
            $sql = "SELECT * FROM `$table_name` where $field $condition";
            $execute = $con->query($sql);
            if($execute == true)
            {
                if($r = $execute->num_rows> 0 ){
                    $result =true;
                }
                else{
                    $result =false;
                }
            }
            else{
                $result = die(mysqli_error($con));
            }
            return $result;
            $con->close();
        }        
                     
                
//con itemselected,code,name,price,itemselprice,itemimage/qty
#updated march 6 2018
    function FUNC_updateItem($con,$item,$a,$b,$c,$d,$e,$f){
        $returned = "";
        $sql = "UPDATE inventory_items_table SET item_code = '$a', item_name = '$b' ,
        item_price = '$c', item_sell_price = '$d', item_image = '$e' , item_qty = '$f'
        WHERE item_code = '$item'";
        $execute = $con->query($sql);
        if($execute == true){
            $returned = true;
        }
        else{
            $returned = false;
        }
        return $returned;
    }
//lastandworking version of update item
/*
   function FUNC_updateItem($con,$item,$a,$b,$c,$d,$e,$f){
        $returned = "";
        $sql = "UPDATE inventory_items_table SET item_code = '$a', item_name = '$b' ,
        item_price = '$c', item_sell_price = '$d', item_image = '$e' , item_qty = '$f'
        WHERE item_code = '$item'";
        $execute = $con->query($sql);
        if($execute == true){
            $returned = true;
        }
        else{
            $returned = false;
        }
        return $returned;
    }
*/
//$co
    function FUNC_add_qty_val($con,$table_name,$field,$reference,$code,$value=0){
        $returned = "";
        $sql = "UPDATE $table_name SET $field = $field + $value where $reference = '$code'";
        $execute = $con->query($sql);
        if($execute == true){
            $returned = true;
        }
        else{
            $returned = false;
        }
        return $returned;
    }

//Non-Sql Related Functions
    function PrependHTML($message,$id){
        $message = "<script>document.getElementById('$id').innerHTML='$message'
            document.getElementById('$id').css.display='block';
        </script>";
        echo $message;
    }
    function SETTER_date(){
        date_default_timezone_set("Asia/Manila");
        $date = date("m-d-Y");//month/date/year
        return $date;
    }
    /*
    function FUNC_addCompany($con,$code,$name,$adrs,$emails,$phone){
           $returned;
           $searcher = My_searcher($con,'tbl_deliverer','dev_code',$code,false);
           if($searcher == true){
              $returned = false;
           }
           else
           {
               $sql = "INSERT INTO tbl_deliverer " ." VALUES(null,'$code','$name','$adrs','$emails','$phone')";
               $execute = $con->query($sql);
               if($execute == true){
                   $returned = true;
               }
               else{
                   $returned = false;
               }
           }
           
           return $returned;
           $conn->close();
       }
    */
    #CREATE JOIN TABLES
?>

