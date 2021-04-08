<?php  $this->load->view('inc/header'); ?>
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.css"></script>            

<section class="content-header">
<h1>
    Update Users Password
</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="#">Employee</a></li>
</ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-xl-12 col-12 pr-0">
        <div class="">
            <?php 
                    $alert = $this->session->flashdata('alert');
                    $alert_type = $this->session->flashdata('alert_type');
                    
                if($alert!=''){
                    echo '<div class="'.$alert_type.'">'.$alert.'</div>';
                }

                if($error!=''){
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                }
            ?>
        </div>
        <!-- /.box -->
    </div>
    <div class="col-xl-12 col-12 pr-0">
       
        <div class="box box-body">
            <div class="row">
                <div class="col-sm-6">
                     <h3>Update Password</h3>
                 </div>                
             </div>   
            
           

            <div class="form-group row pt-3">
              <label for="" class="col-sm-3 col-form-label">Name</label>
              <label for="" class="col-sm-3 col-form-label">Username</label>
              <label for="" class="col-sm-3 col-form-label">Password</label>
              <label for="" class="col-sm-3 col-form-label">Action</label>              
            </div>

            <?php 
              if(!empty($users)){ 
                foreach($users as $user){
                  echo form_open('edit/update_users_password', 'class="form" id="form"');
                  echo  form_hidden('id', $user['id']);

              ?>

            <div class="form-group row pt-2 pb-2">
              <div for="" class="col-sm-3">
                <input class="form-control" type="text" name="name" value="<?php echo $user['full_name']; ?>" id="name" required>
              </div>
              <div for="" class="col-sm-3">
                <input class="form-control" type="text" name="username" value="<?php echo $user['username']; ?>" id="username" required>
              </div>
              <div for="" class="col-sm-3">
                <input class="form-control" type="password" name="password" value="" id="pass" required>
              </div>
              <div for="" class="col-sm-3">
                <button type="submit" name="" class="btn btn-info btn-sm">Update</button>
              </div>              
            </div>

        <?php
              echo form_close();
            }
          }else{
              echo '<div class="alert alert-danger"><h3>No User Found ! </h3></div>';
          }
            ?>
          


         
        </div>
        <!-- /.box -->
    </div>

    

</div>
</section>

<?php  $this->load->view('inc/footer'); ?>
