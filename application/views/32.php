<?php include('header.php'); ?>
<style>#pw{width:100%;height:100%;position:fixed;top:0;left:0;right:0;background:0 0;z-index:9999;user-select: none;cursor: none;}</style>
<body>
    
<?php include('nav.php'); ?>
 <div class="row justify-content-center">
 <?php if ($this->facebook->is_authenticated()) : ?>
    <kbd style="font-size:12px"><span>Xin Chào,</span>  <?php foreach ($mydata as $key => $value) : ?><a href='<?php echo "https://www.facebook.com/app_scoped_user_id/".$value['id'] ?>' style="font-size:12px"><?php echo $value['name'] ?></a>  <?php endforeach; ?></kbd>
<?php endif ?>
 </div>
        <div class="container mt-5" style="margin-top: 1rem!important;">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card mt-2">
                        <div class="card-header text-white" style="background: #880000;">
                            Level 32
                        </div>
                        
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>Level/submit/32" method="POST" id="form">
                                <h4>Nhập mật khẩu đúng để sang level tiếp theo</h4>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Mật khẩu..." autocomplete="off"  autofocus required>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-dark ml-2"><i class="far fa-check-circle"></i> Kiểm tra</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="pw"></div>
					<div class="card mt-2" >
						<div class="card-body" style="user-select: none;">
							Password: SDOE5y4qSkex6uoYF7ALvenNFqrx67OP0NnI3fOAFEMIi4zbYT48c6ortnB9j4qVVon3FSwzAKu7dQuQ
						</div>
					</div>	
                    <?php include('wrong.php'); ?>
                </div>
            </div>
        </div>
<script>$(function () {
  $('[data-toggle="popover"]').popover()
})
</script>
<script src="<?php echo base_url(); ?>js/csrf.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>


$(document).keypress(function(e) {
    return false;
});
$(document).ready(function(){
    $(document).keydown(function(event) {
        if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
            // alert('Đừng cố!');
            event.preventDefault();
         }
    });
});
$(document).ready(function()
{ 
   $(document).bind("contextmenu",function(e){
          return false;
   }); 
})
function kill(event)
{
    event.preventDefault();
    event.stopPropagation();
    return false;
}
</script>
</body>
</html>
