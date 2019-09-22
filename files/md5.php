<?php 
$pw = "Điền mã md5";
if(isset($_POST['submit']))
{
	if($_POST['md5']=="46cbb91032cb24329ee89138aef65039")
	{
		$pw = "Passwordis\"none\":)";
	}
	else
	{
		$pw = "I cannot decode";
	}
}
?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center mt-5">
			<form action="" method="post">
				<div class="form-inline">
					<input type="text" name="md5" value="" placeholder='<?php echo $pw; ?>' class="form-control">
					<input type="submit" name="submit" value="DECODE" class="btn btn-outline-secondary">
				</div>
			</form>
		</div>
	</div>
</body>
</html>
