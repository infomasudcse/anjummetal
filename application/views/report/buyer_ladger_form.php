<?php  $this->load->view('inc/header'); ?>          

<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker.css"/>


            <section class="content-header">
                <h1>
                    Report  
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Report </a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                   
                    <div class="col-xl-12 col-12 pr-0">
                       
                        <div class="box box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                     <h3>Ladger </h3>
                                 </div>
                             </div>   
                            <?php
                                    $staff = $this->session->userdata('user_info');
                                    echo form_open('report/buyer_account_details', array('class'=>'form form-horizontal'));
                                     $buyer = get_people_of_branch('buyer', $staff['branch_id']);

                            ?>
                            <div class="form-group row">
                              <label for="dept" class="col-sm-2 col-form-label">Select Expense Type</label>
                              <div class="col-sm-6">
                                <select class="form-control"  name="buyer_id" id="buyerSelect"  required>
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
                              <label for="dob" class="col-sm-2 col-form-label">From Date </label>
                              <div class="col-sm-6">
                                <input class="form-control date" type="text" placeholder="dd-mm-yyyy" name="from"  />
                              </div>
                              
                            </div>
                             <div class="form-group row">
                              <label for="dob" class="col-sm-2 col-form-label">To Date </label>
                              <div class="col-sm-6">
                                <input class="form-control date" type="text" placeholder="dd-mm-yyyy" name="to"  />
                              </div>
                              
                            </div>
                            <div class="form-group row">
                              <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-info pull-right">Check</button>
                              </div>
                            </div>

                         </form>
                        </div>
                        <!-- /.box -->
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('inc/footer'); ?>
<script src="<?=base_url()?>assets/dist/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
  


    $(document).ready(function(){
       
        $('.date').datepicker();      

    });
    
    
</script>

            