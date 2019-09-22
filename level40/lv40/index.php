<?php 
include("../die.php");
exec("chmod 777 index.php");
exec("chmod 777 css");
exec("chmod 777 js");
exec("chmod 777 term.php");
exec("chmod 644 .htaccess");

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>L.A.T Terminal</title>
    <link rel="stylesheet" href="css/screen.css">
</head>

<body>
    <div id="terminal">
        <div id="output">
            <p>Type "help" to show command</p>
            <br/>
            <p>Type "clear" to clear code</p>
            <span>
                <pre>
     __         ______     ______     
    /\ \       /\  __ \   /\__  _\    
    \ \ \____  \ \  __ \  \/_/\ \/    
     \ \_____\  \ \_\ \_\    \ \_\    
      \/_____/   \/_/\/_/     \/_/    

                </pre>
            </span>
        </div>

        
        <div id="command">
            <input type="text" autocapitalize="off" id="console" autofocus="" placeholder="Refresh after login">
            <span id="send"></span>
        </div>
    </div>
    
    <script src="js/jquery-1.8.2.js"></script>
    <script src="js/system.js"></script>

</body>
</html>
