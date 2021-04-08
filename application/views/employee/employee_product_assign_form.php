<?php  $this->load->view('inc/header'); ?>
<style>
  .mystyle{padding: 50px 20px;
    border-top: 1px solid #ccc;}
</style>

            <section class="content-header">
                <h1>
                    EMPLOYEE
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
 <?php
     $user =  get_user_info_by_id($employee_id);
         if($user['salary_type_id'] == 3){

           $product_type  = $this->model->getData('product_type', 'department_id', $user['department_id']);
 ?>          
                    <div class="col-xl-12 col-12 pr-0">
                       
                        <div class="box box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                     <h3>Employee Product Assign</h3>
                                     <?php echo '<h4>Name: '.$user['full_name'].'  ::  Mobile : '.$user['mobile'].'</h4>';?>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('view/employee_list')?>" class="btn pull-right btn-sm btn-primary">View All</a>
                                 </div>
                             </div>
                             <div class="row">
                                <div class="col-sm-10">


                            <?php
                                    echo form_open('new_add/update_product_selection', array('class'=>'form form-horizontal mystyle'));

                              ?>      
                              <div class="form-group row" style="background-color: #e7e7e8;padding-top: 10px;font-size: 16px;">
                                    <div class="col-sm-2"><p>SL.</p></div>
                                    <div class="col-sm-2"><label>Product Type</label></div>
                                    
                                    <div class="col-sm-2">   <label id="selectAll">Select All</label></div>
                                    <div class="col-sm-4" ><label>Payment for Each pcs</label></div>
                                  </div>

                              <?php
                                    if(!empty($product_type)){
                                      $j=1;
                                      $i= mt_rand();
                                        foreach($product_type as $product){

                            ?>

                                  <div class="form-group row" style="border-bottom:1px solid #f7f7f7;">
                                    <div class="col-sm-2"><p><?=$j;?></p></div>
                                    <label for="example-text-input" class="col-sm-2 col-form-label"><?=$product['type_name']?></label>
                                    
                                    <div class="col-sm-2">
                                        <input type="checkbox" id="basic_checkbox_<?=$i?>" name="product_type[]" value="<?=$product['product_type_id']?>" />
                                        <label for="basic_checkbox_<?=$i?>"></label>
                                                      
                                    </div>
                                    <div class="col-sm-4 basic_checkbox_<?=$i?>" >
                                                       
                                    </div>
                                  </div>

                            <?php
                                    $i++;
                                    $j++;
                                  }

                              }else{
                                echo '<div style="padding:150px 0px;"><div class="alert alert-danger">No Product Found For this Department ! Please Add Product ! <a href="'.base_url().'new_add/product_type" class="btn btn-primary">Add Product Type</a></div></div>';
                              } 


                            ?>


                            <div class="form-group row">
                              <label for="ex" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-success pull-right">Update</button>
                              </div>
                            </div>
                            <input type="hidden" name="employee_id" value="<?=$employee_id?>" />
                          <?php echo form_close();?>

                       </div>
                     </div>

                        </div>
                        <!-- /.box -->
                    </div>

<?php }else if($user['salary_type_id'] == 2){ ?>
                       <div class="col-xl-12 col-12 pr-0">
                       
                        <div class="box box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                     <h3>Hourly Salary</h3>
                                     <?php echo '<h4>Name: '.$user['full_name'].'  ::  Mobile : '.$user['mobile'].'</h4>';?>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('view/employee_list')?>" class="btn pull-right btn-sm btn-primary">View All</a>
                                 </div>
                             </div>
                             <div class="row">
                                <div class="col-sm-10">


                            <?php
                                    echo form_open('new_add/assign_salary', array('class'=>'form form-horizontal mystyle'));

                              ?>      
                              

                                 
                             <div class="form-group row">
                              <label for="amount" class="col-sm-2 col-form-label">Hourly Salary</label>
                              <div class="col-sm-10">
                                <input type="number" class="form-control" name="amount" id="amount" required/>
                              </div>
                            </div>     
                            <div class="form-group row">
                              <label for="ex" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-success pull-right">Update</button>
                              </div>
                            </div>
                            <input type="hidden" name="employee_id" value="<?=$employee_id?>" />
                         <?php echo form_close();?>

                       </div>
                     </div>

                        </div>
                        <!-- /.box -->
                    </div>

<?php }else{ ?>
                   <div class="col-xl-12 col-12 pr-0">
                       
                        <div class="box box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                     <h3>Monthly Salary</h3>
                                     <?php echo '<h4>Name: '.$user['full_name'].'  ::  Mobile : '.$user['mobile'].'</h4>';?>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('view/employee_list')?>" class="btn pull-right btn-sm btn-primary">View All</a>
                                 </div>
                             </div>
                             <div class="row">
                                <div class="col-sm-10">


                            <?php
                                    echo form_open('new_add/assign_salary_fixed', array('class'=>'form form-horizontal mystyle'));

                              ?>      
                              

                                 
                             <div class="form-group row">
                              <label for="amount" class="col-sm-2 col-form-label">Monthly Salary</label>
                              <div class="col-sm-10">
                                <input type="number" class="form-control"  name="amount" id="amount" required/>
                              </div>
                            </div>     
                            <div class="form-group row">
                              <label for="ex" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-success pull-right">Update</button>
                              </div>
                            </div>
                            <input type="hidden" name="employee_id" value="<?=$employee_id?>" />
                         <?php echo form_close();?>

                       </div>
                     </div>

                        </div>
                        <!-- /.box -->
                    </div>

<?php }?>
                 

                </div>
            </section>

<?php  $this->load->view('inc/footer'); ?>

<script>

 $(document).ready(function(){

  $('#selectAll').click(function(){
    $('input[type=checkbox]').prop('checked', true);
    $('input[type=checkbox]').each(function(){
        var elemid = $(this).attr('id');
         if($(this).is(':checked')){         
                $('.'+elemid).html('<input class="form-control" type="text" name="price[]"/>');
                
      }else{
               $('.'+elemid).html('');
      }
    });

  });



  $('input[type=checkbox]').change(function(){
        var elemid = $(this).attr('id');
        console.log(elemid);
       if($(this).is(':checked')){         
                $('.'+elemid).html('<input class="form-control" type="text" name="price[]"/>');
                $('.'+elemid+' input[type=text]').focus();
      }else{
               $('.'+elemid).html('');
      }
  });
 


});
        
 </script>           