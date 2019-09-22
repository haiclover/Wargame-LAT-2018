<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title pw="Pass: F9uqLWHNwJ8hM0uUMpWqw8iAYstz">Error</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
    background-color: #fff;
    margin: 40px;
    font: 13px/20px normal Helvetica, Arial, sans-serif;
    color: #4F5155;
}

a {
    color: #003399;
    background-color: transparent;
    font-weight: normal;
}

h1 {
    color: #444;
    background-color: transparent;
    border-bottom: 1px solid #D0D0D0;
    font-size: 19px;
    font-weight: normal;
    margin: 0 0 14px 0;
    padding: 14px 15px 10px 15px;
}

code {
    font-family: Consolas, Monaco, Courier New, Courier, monospace;
    font-size: 12px;
    background-color: #f9f9f9;
    border: 1px solid #D0D0D0;
    color: #002166;
    display: block;
    margin: 14px 0 14px 0;
    padding: 12px 10px 12px 10px;
}

#container {
    margin: 10px;
    border: 1px solid #D0D0D0;
    box-shadow: 0 0 8px #D0D0D0;
}
#password
{
    border:0;
}
.input-group
{
    bottom: 0;
    position: absolute;
    right: 140px;
}
.alert
{
    bottom: 0;
    position: absolute;
    left: 0;
}
p {
    margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
<div id="container">
        <h1>An Error Was Encountered</h1>
        <p>Unable to load the requested file: 25.php</p>    
</div>

        <div class="container mt-5" style="margin-top: 1rem!important;">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card mt-2">
                       
                        
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>Level/submit/25" method="POST" id="form">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                    <input type="text" class="form-control" name="password" id="password" autocomplete="off" required size="6">
                                  
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php include('wrong.php'); ?>
                </div>
            </div>
        </div>
</body>
</html>
