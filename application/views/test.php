<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/nav.css">
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <style>
        html,body
        {
            background: url("<?php echo base_url(); ?>img/bg-min.png");
        }
    </style>
</head>
<body>
    
<ul class="navbar">
  <li><a class="<?php echo base_url(); ?>" href="#"><img src="<?php echo base_url(); ?>img/logo.png" style="width: 158px;" alt=""></a></li>
  <li><a href="<?php echo base_url(); ?>" class="fas fa-home"></a></li>
  <li><a href="<?php echo base_url(); ?>ranking" class="fas fa-code"></a></li>
  <li><a href="<?php echo base_url(); ?>logout" class="fas fa-sign-out-alt"></a></li>
</ul>
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
                            Level 1
                        </div>
                        
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>Level/submit/1" method="POST" id="">
                                <h4>Nhập mật khẩu đúng để sang level tiếp theo</h4>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Mật khẩu..." autocomplete="off" autofocus required>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-dark ml-2"><i class="far fa-check-circle"></i> Kiểm tra</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body">
                           
                            <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" data-placement="bottom" title="Hướng Dẫn" data-content="Những gì bạn nhìn thấy trên màn hình hiện tại là do trình duyệt đã biên dịch mã nguồn của trang web. Hãy thử tìm hiểu những gì ẩn chứa phía sau nó!">Xem hướng dẫn</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>$(function () {
  $('[data-toggle="popover"]').popover()
})</script>
<script src="<?php echo base_url(); ?>/js/csrf.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
