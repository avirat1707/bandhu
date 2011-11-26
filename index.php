<?php
    //header ("Content-type: application/xhtml+xml");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Chatting Freaks</title>
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.16.custom.css" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
    </head>
    <body>
        <div id="wrapper">
            <div title="Chat Box" id="divChatBox">
                <ul>
                    <li class="busy">
                        <img src="css/images/loading.gif" alt="" />
                        <span>Loading...</span>
                    </li>
                </ul>
            </div>
        </div>
        <div id="divHiddenElements">
            <input type="hidden" id="hidFriendList" value="" />
        </div>
        <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                loadChatBox();
                $.ajax({
                    url:"/chatbox/ReceiveMessage.php",
                    type:"POST",
                    cache:false,
                    data:{"name":"tirth","sex":"male"},
                    success:function(msg){
                        alert(msg);
                    }
                    
                });
            });
        </script>
    </body>
</html>
