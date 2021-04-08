<?php  $this->load->view('inc/header'); ?>

            



            <section class="content-header">

                <h1>

                    SELL PRODUCT

                </h1>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="breadcrumb-item active"><a href="#">Product </a></li>

                </ol>

            </section>



            <!-- Main content -->

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



                                if($error!=''){

                                    echo '<div class="alert alert-danger">'.$error.'</div>';

                                }

                            ?>

                        </div>

                        <!-- /.box -->

                    </div>

                    <div class="col-xl-12 col-12 pr-0">

                              <div class="row">

                                <div class="col-sm-12">

                                  <div class="box box-body">

                                    <?php

                                            echo form_open('new_add/final_sellOut', array('class'=>'form form-horizontal' ,'id'=>'final_form'));

                                              $buyer = get_people_of_branch('buyer', $staff['branch_id']);

                                    ?>

                                         <div class="form-group row">

                                      <label for="prselect" class="col-sm-2 col-form-label">Select Buyer</label>

                                      <div class="col-sm-6">

                                            <select class="form-control" type="text" name="buyer_id" id="buyerSelect"  required>

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

                                      <div class="col-sm-4">

                                            <button type="button" class="btn btn-primary" id="submit_btn">Create Invoice</button>

                                      </div>

                                    </div>



                                  </form>

                                  </div>

                                </div>

                             </div>

                        

                           

                             <div class="row">

                                  <div class="col-sm-9">



                                   

                                  </div>

                             </div>  

                        

                        

                    </div>



                    



                </div>

            </section>



<?php  $this->load->view('inc/footer'); ?>

<script>
  
$(document).ready(function(){
  $('#submit_btn').click(function(e){
        //var val = ('#buyerSelect').val();
        //var confirm = confirm('Ar You Sure To Proceed ?');
        if(confirm('Ar You Sure To Proceed ?')){
          $('#final_form').submit();
        }else{
          return false;
        }
  });
});

</script>




            