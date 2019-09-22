<?php include('header.php'); ?>
    
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
                            Level 13
                        </div>
                         <?php 
                         setcookie('user','admin',time()+3600);
                         ?>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>Level/submit/13" method="POST" >
                                <fieldset>
                                    <legend style="border:1px solid black">Welcome</legend>
                                    Bạn không là <i>admin</i> ! Chỉ có <i>admin</i> mới có thể sang level tiếp theo
                                </fieldset>
                                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                <button type="submit" class="btn btn-dark ml-2"><i class="far fa-check-circle"></i> Nếu là admin thì click vào đây</button>
                            </form>
                        </div>
                    </div>
                    
                   
                    <?php if(isset($_SESSION['wrongpass']))
                    {
                        echo '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        Bạn không phải là admin <img src="'.base_url().'icon/smile.png" alt="#smile" width="25px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                        } 
                    ?>
                </div>
            </div>
        </div>
























<!-- /// -->
























<!-- /// -->






















<!-- /// -->



























<!-- admin-admin -->



















<!-- /// -->


































<!-- /// -->















































<!-- /// -->





































<script>$(function () {
  $('[data-toggle="popover"]').popover()
})</script>
<script src="<?php echo base_url(); ?>/js/csrf.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
