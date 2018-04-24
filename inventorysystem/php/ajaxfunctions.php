<?php
require 'connection.php';
function My_searcher($con,$table_name,$field,$code){
            $result;
            $sql = "SELECT * FROM `$table_name` where $field = '$code'";
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

My_searcher
?>