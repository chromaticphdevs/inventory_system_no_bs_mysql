<script>
            $(function(){
               $("#submit").on('click',function(e){
                   var properties=[$("#dev_code").val(),$("#item_code").val(),$("#item_name").val(),$("#deliveredBy").val()
                                  ,$("#org_price").val(),$("#sel_price").val(),$("#item_status").val(),$("#item_qty").val()
                                  ,$("#dev_date").val(),$("#fileToUpload").val()];
                   var filename = $('#fileToUpload').val().split('\\').pop();
                   if(properties[0]=="" || properties[1]==""){
                       e.preventDefault();
                       $("#myalert").html('<p>'+"Product Code, ItemCode and Date Are all required"+'</p>'); 
                                $("#myalert").slideDown('fast').show(1000).delay(2000).slideUp('fast').hide(1000);
                   }
                   else{
                       $.ajax({
                        type :'POST',
                        url:'fileupload.php',
                        data:{
                        'dev_code': properties[0],
                            'item_code': properties[1],
                            'item_name': properties[2],
                            'deliveredBy': properties[3],
                            'org_price': properties[4],
                            'sel_price': properties[5],
                            'item_status': properties[6],
                            'item_qty': properties[7],
                            'item_date': properties[8],
                            'image': filename,
                            'fileToUpload':properties[9]
                        },
                        success : function(data){
                           console.log(data);
                            if(data=="true"){
                                $("#myalert").html('<p>'+"Added Item to the Package"+'</p>');
                                $("#myalert").show(1000).delay(500).hide(1000);
                            }
                            else if (data=="updated"){
                               $("#myalert").html('<p>'+"Item is Updated since its already Existed"+'</p>'); 
                                $("#myalert").show(1000).delay(500).hide(1000);
                            }
                            else{
                                $("#myalert").html('<p>'+"Unknown Error Occured"+'</p>'); 
                                $("#myalert").show(1000).delay(500).hide(1000);
                            }
                            
                        }
                    });
                   }
                             e.preventDefault();
               });
               $("#dev_code").on("change",function(){
                 
               });
            });
        </script>