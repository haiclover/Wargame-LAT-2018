<html>
	<head>
		<style>
			*{
				padding: 0;
				margin: 0;
			}
			img{
				background-repeat: no-repeat;
				background-size: cover;
				width: 100%;
			}
		</style>
	</head>
</html>
<?php 
if($_GET['view']=='jpg')
{
	echo '<img src="pic.jpg" alt="icon" />';
   
}
else if($_GET['view']=='txt')
{
	echo file_get_contents('pic.txt');
}
?>