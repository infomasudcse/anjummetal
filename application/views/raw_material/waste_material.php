<?php  $this->load->view('inc/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/plugin/sweetalert/sweetalert.css">
            

            <section class="content-header">
                <h1>
                    Waste Material
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Waste Material</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-10">
                      
                        <div class="row">
                            <div class="col-xl-12 col-12 pr-0">
                                <div class="">
                                    <?php 
                                            
                                            $alert = $this->session->flashdata('alert');
                                            $alert_type = $this->session->flashdata('alert_type');
                                            
                                        if($alert!=''){
                                            echo '<div class="'.$alert_type.'">'.$alert.'</div>';
                                        }

                                        if(isset($error) && !empty($error)){
                                            echo '<div class="alert alert-danger">'.$error.'</div>';
                                        }
                                    ?>
                                </div>
                                <!-- /.box -->
                            </div>
                           


                        </div>
                    </div>
                    <div class="col-sm-12">
                       <div class="box box-body">
                         <table id="waste_table" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        
                                        <th>Quantity</th>                                       
                                        <th>Action</th>
                                      
                                        
                                    </tr>
                                </thead>
                               
                        </table>
                      </div>

                    </div>
                </div>



                




            </section>

<?php  $this->load->view('inc/footer'); ?>
<script src="<?=base_url()?>assets/plugin/sweetalert/sweetalert.min.js"></script>
<script>
  
$(document).ready(function(){
   waste_table =  $('#waste_table').DataTable({
      "ajax": url+'view/getWaste'
   });

});


$(document).on('click', '.delete_btn' , function(){
    var dataId = $(this).attr('data-id');    
    var newHtml = ' Are You Sure to Delete  ? ';
     swal({ 
             html:true,
             title: "Confirmation !  ", 
             text: newHtml,
             showCancelButton: true, 
             confirmButtonColor: "#f44336", 
             cancelButtonColor: "#D9534F", 
             confirmButtonText: "Yes, Delete", 
             cancelButtonText: "Cancel", 
             closeOnConfirm: false, 
             closeOnCancel: true ,
               showLoaderOnConfirm: true
             }, function(isConfirm){ 
                 if (isConfirm) {
                            $.post(url+'delete/delete_waste',{ waste_id:dataId},function(obj){
                                    
                                     if(obj.rs== '1'){
                                     swal("Success!", obj.msg, "success"); 
                                           waste_table.ajax.reload();
                                     }else{
                                     swal("Failed!", obj.msg, "error"); 
                                    }
                                });
                 } 
        });
});



$(document).on('click', '.verify_btn' , function(){
    var dataId = $(this).attr('data-id');
    
    var newHtml = ' Are You Sure to Verify the Waste Entry ? ';
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
                            $.post(url+'report/verify_waste',{ waste_id:dataId},function(obj){
                                    
                                     if(obj.rs== '1'){
                                     swal("Success!", obj.msg, "success"); 
                                           waste_table.ajax.reload();
                                     }else{
                                     swal("Failed!", obj.msg, "error"); 
                                    }
                                });
                 } 
        });
    
});


</script>
            


