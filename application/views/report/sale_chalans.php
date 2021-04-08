<?php  $this->load->view('inc/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/plugin/sweetalert/sweetalert.css">
<style>
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{background-color:#398bf794;}
  .form-horizontal{padding:30px;}
</style>
<section class="content-header">
    <h1> Sales Chalan </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">chalans </a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xl-12 col-12 pr-0">
            <div class="">
                <?php 

                        $staff = $this->session->userdata('user_info');
                        $alert = $this->session->flashdata('alert');
                        $alert_type = $this->session->flashdata('alert_type');                                  

                    if($alert!=''){
                        echo '<div class="'.$alert_type.'">'.$alert.'</div>';
                    }
                ?>
            </div> 
        </div>
        <div class="col-xl-12 col-12 pr-0">
          <div class="row">
            <div class="col-sm-12">
             <div class="box box-default">
                 
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- Nav tabs -->
              
              <!-- Tab panes -->
              
                    <h3> Sales Chalans</h3>
                      <table class="table" id="sales_chalan_table">
                        <thead>
                          <tr>                            
                            <th>Chalan Date</th>
                            <th>Chalan No</th>
                            <th>Buyer</th>
                            <th>Chalan Tot</th>
                            <th>Weight Tot</th>
                            <th>Operator</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        
                      </table>
                  
               
                  </div>
                  <!-- /.box-body -->
                </div>

            </div>

         </div>  

        </div>

    </div>

</section>



<?php  $this->load->view('inc/footer'); ?>

 <script src="<?=base_url()?>assets/plugin/sweetalert/sweetalert.min.js"></script>
 <script src="<?=base_url()?>assets/plugin/sweetalert/jquery.sweet-alert.custom.js"></script>
<script src="<?=base_url()?>assets/plugin/sweetalert/sweetalert-dev.js"></script>

 
<script>
   var sales_chalan_table='';
$(document).ready(function(){

  
  sales_chalan_table =  $('#sales_chalan_table').DataTable({
      'ajax': url+'view/sales_chalan_table'
   });
 
});


$(document).on('click', '.verify_btn' , function(){
    var dataId = $(this).attr('data-id');
    var chalanno = $(this).attr('data-chalanno');
    var newHtml = ' Are You Sure to Verify the Chalan No : <b>'+chalanno+'</b> ? ';
     swal({ 
             html:true,
             title: "Confirmation !  ", 
             text: newHtml,
             showCancelButton: true, 
             confirmButtonColor: "#f44336", 
             cancelButtonColor: "#D9534F", 
             confirmButtonText: "Yes, Verify", 
             cancelButtonText: "Cancel", 
             closeOnConfirm: false, 
             closeOnCancel: true ,
               showLoaderOnConfirm: true
             }, function(isConfirm){ 
                 if (isConfirm) {
                            $.post(url+'report/verify_sales_chalan',{ chalan_id:dataId},function(obj){
                                    
                                     if(obj.rs== '1'){
                                     swal("Success!", obj.msg, "success"); 
                                           sales_chalan_table.ajax.reload();
                                     }else{
                                     swal("Failed!", obj.msg, "error"); 
                                    }
                                });
                 } 
        });
    
});



</script>




            