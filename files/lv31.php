<?php 
$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
if ($iPhone || $iPod || $iPad || $Android) {
	echo "Password: gNSD4GGFSOqc6jA9i7kCLyUSSzz4ux89QxJ6a2wVHQM65IUz8rR689QxrYqn5GeE05xmkb1O8tv4E7E";
}
else {
	echo "Bạn đang sử dụng PC/Laptop.Hãy sử dụng thiết bị khác";
}
?>