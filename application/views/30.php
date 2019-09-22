<?php include('header.php'); ?>

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
                            Level 30
                        </div>
                        
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>Level/submit/30" method="POST" id="form">
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

                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="card-text">
                                <kbd><a href="<?php echo base_url() ?>files/level30.php">File Password Level 30</a></kbd>
                            </div>
                            <button type="button" class="btn btn-lg btn-danger mt-2" data-toggle="popover" data-placement="bottom" title="Hướng Dẫn" data-content='Gợi ý :Chúng ta tồn tại nhờ những gì ta nhận nhưng chúng ta sống nhờ những gì cho đi – Winston Churchill'>Xem hướng dẫn</button>
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
</body>
</html>
