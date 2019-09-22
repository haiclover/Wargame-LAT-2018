<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>WarGame-L.A.T</title>
 <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/components/icon.min.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
  <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/nav.css">
  <style>
      html,body
      {
          background: url("<?php echo base_url(); ?>img/bg-min.png");
      }
      .table-ranking
      {
        border-left: 1px dashed #dee2e6;
      }

  </style>
</head>
<body>
	<?php include('nav.php'); ?>
  <div class="card">
    <div class="card-header" style="font-size: 35px;">
     <i class="flag checkered icon"></i> Bảng xếp hạng Top 100
    </div>
    <div class="card-body">
      <table class="table table-striped table-light table-hover">
      <thead>
        <tr>
          <th scope="col" class="table-ranking">#</th>
          <th scope="col" class="table-ranking">Tên</th>
          <th scope="col" class="table-ranking">Level</th>
          <th scope="col" class="table-ranking">Time</th>
          <!-- <th scope="col">Handle</th> -->
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php while($i<=1){ ?>  
        <?php foreach ($mangdl as $key => $value): ?>
        

        <tr>
          <th scope="row" class="table-ranking"><?php echo $i;$i++?></th>
          <td class="table-ranking"><a href='<?php echo "https://www.facebook.com/app_scoped_user_id/".$value["idfb"] ?>'><?php echo $value['name']; ?></a></td>
          <td class="table-ranking"><?php echo $value['rank']; ?></td>
          <td class="table-ranking"><?php echo $value['time']." "; ?><?php echo " ".$value['date']; ?></td>
        </tr>

      <?php endforeach ?>
      <?php } ?>  
      </tbody>
      </table>
    </div>
  </div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap-notify.min.js"></script>
<script src="<?php echo base_url(); ?>js/csrf.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

$.notify("<b>Thông báo</b>: Phần xử lí ranking wargame vừa được cập nhật", {
animate: {
  enter: 'animated zoomInDown',
  exit: 'animated zoomOutUp',
  type: 'warning',
},
placement: {
  align: "center",
},
offset: {
    y: 170
  }
});


$.notify({
  icon: 'https://www.emojicool.com/assets/img/emoji/1f60e.png',
  title: 'Hint: ',
  message: 'Chuyện đơn giản,nghĩ sâu ra thì sẽ thành phức tạp.<br/>Chuyện phức tạp, nhìn thoáng đi thì sẽ giản đơn.'
},{
  type: 'success',
  delay: 5000,
  icon_type: 'image',
  template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
    '<img data-notify="icon" class="img-circle pull-left" style="width:20px">' +
    '<span data-notify="title">{1}</span>' +
    '<span data-notify="message">{2}</span>' +
  '</div>'
});

// $.notify("Chuyện đơn giản,nghĩ sâu ra thì sẽ thành phức tạp.<br/>Chuyện phức tạp, nhìn thoáng đi thì sẽ giản đơn.", {
//   animate: {
//     enter: 'animated zoomInDown',
//     exit: 'animated zoomOutUp'
//   }
// });

</script>
<script src="http://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous" pw="latcompany"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

</body>
</html>
