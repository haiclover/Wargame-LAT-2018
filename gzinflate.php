<?php
function encode2($str) {
    for ($i = 1;$i <= $_POST['num'];$i++) {
        $str = 'eval(gzinflate(base64_decode("'.base64_encode(gzdeflate($str)).'")));';
    }
    return $str;
}
function encode3($str) {
    $mh_1 = str_replace("gzinflate", "\$_X", $str);
    $mh_2 = str_replace("base64_decode", "\$_T", $mh_1);
    $mh_3 = "\$_X=strrev(\"etalfnizg\");\$_T=strrev(\"edoced_46esab\");" . $mh_2 . "";
    return $str = $mh_3;
}
function encoding() {
    $code = $_POST['vao'];
    $mh = encode2(encode3(encode2(encode2(encode3(encode2(encode3(encode2(encode2($code)))))))));
    echo "<?php " . $mh . " ?>";
}
?>
<html>
<head>
<title>gzinflate base64 Encode | Decode</title>
<script type="text/javascript">SyntaxHighlighter.all();SyntaxHighlighter.defaults['toolbar']=false;</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Encode PHP Gzinflate</title>
</head>

<body>
<script type="text/javascript" src="jquery-1.js"></script>
<script type="text/javascript" src="challenge.js"></script>
<style type="text/css">
html {width: 100%; height: 100%; overflow: auto;}
body {background-color: rgb(17, 17, 17); margin:0px 0px;}
.textarea {
margin: 0px auto;
background-color: #222222;
resize: none;
color: #ffffff;
font-family: calibri;
font-weight: bold;
text-shadow: -1px -1px 2px #00ffff, 1px 1px 2px #00ffff;
width: 100%;
height: 150px;
overflow: auto;
}
.input {
margin: 0px auto;
color: #ffffff;
background-color: #111666;
border: 1px solid #0000ff;
width: 100%;
color: #ffffff;
font-family: calibri;
font-weight: bold;
text-shadow: -1px -1px 2px #00ffff, 1px 1px 2px #00ffff;
}

</style>
<li class="option"><label><h2><center><font size="8" face="Keania One" style="background: url(&quot;http://cloverdoser.zz.mu/chopnhay.gif&quot;) repeat scroll 0% 0% transparent; color:#fff; text-shadow: 0pt 0pt 0.9em red, 0pt 2pt 0.9em red;">Encode - Code By Cloverdoser</h2></a></label></li>
<form action="" method="post" name="form" id="form"><center>
    <textarea class="textarea" name="vao" id="vao">echo "HAICLOVER";</textarea></br>
		<input name="encode" type="submit" id="encode" value="Mã Hóa PHP">
		<input type="text" name="num" value="3" style="width:60"/></br>
	<textarea class="textarea" name="ra" spellcheck="false">
<?php if (isset($_POST['encode'])) {
    encoding();
} ?>
</textarea><br>

</center></form>
</body>
</html>