<?php if(isset($_SESSION['wrongpass']))
{
	echo '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
	Mật khẩu bạn nhập sai! Mời nhập lại nào <img src="'.base_url().'icon/smile.png" alt="#smile" width="25px">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	</div>';
} 
?>