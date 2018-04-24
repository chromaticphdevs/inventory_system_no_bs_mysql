<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <script src="../js/jquery-3.2.1.js"></script>
        <title>Default Webpage</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="navigation">
                <div>navigation</div>
            </div>
                <div class="content">
                    <div class="row">
                    <div class="side-1">
                        <form id="mform" name="form" action="testfile.php">
                            <input type="text" name="name" id="name" placeholder="pass">
                            <input type="text" name="pass" id="pas" placeholder="pass">
                            <button type="submit" id="btn">Send</button>
                        </form>
                    </div>
                    <div class="middle">
                        <p>side 2- </p>
                    </div>
                    <div class="side-2">
                        <p>side 3- </p>
                    </div>
                    </div>
                </div>
                <div class="footer"></div>
        </div>
        <script>
           $(function(){
               $("#btn").on('click',function (e){
                   e.preventDefault();
                   if($("#name").val().length > 1){
                      $("#mform").submit(); 
                   }
               });
           });
        </script>
    </body>
</html>