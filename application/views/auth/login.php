<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/favicon.ico">

    <title>Anjum Metal Ind. Admin - Log in </title>
  
  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugin/bootstrap/css/bootstrap.min.css">
  
  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugin/bootstrap/css/bootstrap-extend.css">
  
  <!-- Theme style -->
   <link rel="stylesheet" href="<?=base_url()?>assets/css/master_style.css">

  <!-- MinimalPro Admin Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/skins/_all-skins.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url()?>"><b>Anjum</b>Metal Ind.</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <p id="mess" class="bg-warning" style="">
        <?php
        
            $alert = $this->session->flashdata('alert');
            if($alert!=''){
                echo '<span style="padding:10px;">'.$alert.'</span>';
            }
        ?>
        
    </p>
    
        <?php
            echo form_open(base_url().'authentication/login', array('class'=>'form-element', 'id'=>'login_form','method'=>'post'));
        ?>
        
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="ion ion-email form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="ion ion-locked form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="checkbox">
            <input type="checkbox" id="basic_checkbox_1" >
      <label for="basic_checkbox_1">Remember Me</label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-6">
         <div class="fog-pwd">
            <br>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-info btn-block margin-top-10">SIGN IN</button>
        </div>
        <!-- /.col -->
      </div>
   <?php echo form_close(); ?>

    <div class="social-auth-links text-center">
      <!-- <p>- OR -</p> -->
      <!-- <a href="#" class="btn btn-social-icon btn-circle btn-facebook"><i class="fa fa-facebook"></i></a>
      <a href="#" class="btn btn-social-icon btn-circle btn-google"><i class="fa fa-google-plus"></i></a> -->
    </div>
    <!-- /.social-auth-links -->

    <div class="margin-top-30 text-center">
      <p></p>
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


  <!-- jQuery 3 -->
   <script src="<?=base_url()?>assets/plugin/jquery/dist/jquery.min.js"></script>
  
  <!-- popper -->
   <script src="<?=base_url()?>assets/plugin/popper/dist/popper.min.js"></script>
  
  <!-- Bootstrap 4.0-->
   <script src="<?=base_url()?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
       
       <script>
           $(document).ready(function(){
                 $('#login_form').on('submit',function(){
                
                 $("#mess").html('<div class="">Loading</div>');
                 
                 $.post('<?=base_url()?>authentication/login',$(this).serialize(),function(resp){
                     //var obj = jQuery.parseJSON(resp);
                     if(resp.rs== 1){
                         window.location.href = resp.msg;
                     }else{
                        
                       $("#mess").html('<span style="padding:10px;">'+resp.msg+'</span>');
                     }
                     
                 });
                 
                return false;
            });
        }); 
           
           
           
       </script>
       



</body>
</html>
