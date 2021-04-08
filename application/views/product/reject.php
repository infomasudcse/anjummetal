<?php  $this->load->view('inc/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker.css"/>      
<style>
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{background-color:#398bf794;}
  .form-horizontal{padding:30px;}
</style>
<section class="content-header">
    <h1> REJECT PRODUCT </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">REJECT</a></li>
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
                  <div class="box-header with-border">
                    <h3 class="box-title">Reject Product</h3>
                   
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-expanded="true"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Reject List</span></a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Add New Reject </span></a> </li>
                
              </ul>
              <!-- Tab panes -->
              <div class="tab-content tabcontent-border">
                <div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">
                  <div class="pad">
                    <h3>Assets</h3>
                      <table class="table" id="reject_table">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Buer Name</th>
                            <th>Product Name</th>
                            <th>Qty</th>                          
                            <th>Note</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        
                      </table>
                  </div>
                </div>
                <div class="tab-pane pad" id="profile" role="tabpanel" aria-expanded="false">
                    <div class="pad">
                    <h3>Reject Form</h3>
                     <?php 

                     echo form_open('new_add/reject', array("class"=>"form-horizontal"));
                       $buyer = get_people_of_branch('buyer', $staff['branch_id']);
                       $sql = $this->db->get('product_type');
                      ?>
                        <div class="box-body">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">Select Buyer</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="buyer_id" id="buyerSelect"  required>
                                        <option value="">Select Buyer</option>
                                            <?php

                                                  if(!empty($buyer)){
                                                    foreach($buyer as $user){
                                                      echo '<option value="'.$user['id'].'">'.$user['full_name'].'</option>';
                                                    }
                                                  }
                                            ?>                                      
                                </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="pro" class="col-sm-2 control-label">Select Product</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="product_id" id="pro"  required>
                                        <option value="">Select Product</option>
                                            <?php

                                                  if($sql->num_rows() > 0){
                                                    foreach($sql->result_array() as $product){
                                                      echo '<option value="'.$product['product_type_id'].'">'.$product['type_name'].'</option>';
                                                    }
                                                  }
                                            ?>                                      
                                </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 control-label">Quantity</label>

                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="inputPassword3" name="qty" placeholder="0" required>
                            </div>
                          </div>
                          
                           <div class="form-group row">
                            <label for="dat" class="col-sm-2 control-label">Date</label>

                            <div class="col-sm-10">
                              <input type="text" class="form-control datepicker" id="dat" placeholder="<?=date('d-m-Y')?>" name="date" required>
                            </div>
                          </div>
                           <div class="form-group row">
                            <label for="desc" class="col-sm-2 control-label">Note</label>

                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="desc" placeholder="description" name="desc">
                            </div>
                          </div>
                         
                        </div>
         
                        <div class="box-footer">
                         
                          <button type="submit" class="btn btn-success pull-right">Save For Review</button>
                        </div>
                      
                      </form>
                  </div>

                </div>
               
              </div>
                  </div>
                  <!-- /.box-body -->
                </div>

            </div>

         </div>  

        </div>

    </div>

</section>



<?php  $this->load->view('inc/footer'); ?>

 <script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
<script>
  
$(document).ready(function(){

   $('.datepicker').datepicker({
        'format':'dd-mm-yyyy'
   });

   $('#reject_table').DataTable({
      'ajax': '<?=base_url()?>view/getAllRejects'
   });
 
});

</script>




            