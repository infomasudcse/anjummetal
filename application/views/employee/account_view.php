<?php  $this->load->view('inc/header'); ?>           
<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker.css"/>

            <section class="content-header">
                <h1>
                    EMPLOYEE ATTENDENCE  
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Attendence </a></li>
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
                                     <h3>Add Attendence </h3>
                                 </div>
                                 <div class="col-sm-6">
                                 
                                 </div>
                             </div>   
                            <?php
                                    echo form_open('new_add/attendence', array('class'=>'form form-horizontal'));

                            ?>
                            <div class="form-group row">
                              <label for="dept" class="col-sm-2 col-form-label">Select Department</label>
                              <div class="col-sm-6">
                                <select class="form-control" name="dep" id="dept" required>
                                  <?php 
                                          if(is_array($dep) && !empty($dep)){
                                              foreach($dep as $dp){
                                                echo '<option value="'.$dp['department_id'].'">'.$dp['department_name'].'</option>';
                                              }
                                          }else{
                                            echo '<option value="0">No Department Define ! </option>';
                                          }

                                  ?>
                                   
                                </select>
                              </div>
                              <div class="col-sm-4" id="alert"></div>
                            </div>
                            
                             <div class="form-group row">
                              <label for="employee_input" class="col-sm-2 col-form-label">Employee</label>
                              <div class="col-sm-6">
                                     <select class="form-control" name="employee" id="employee_input" required>
                                         <option value="">Select Department First</option>
                                               
                                     </select>
                              </div>
                               <div class="col-sm-4" id=""></div>
                            </div>
                             <div class="form-group row">
                              <label for="dob" class="col-sm-2 col-form-label">Date </label>
                              <div class="col-sm-6">
                                <input class="form-control datepicker" type="text" placeholder="dd-mm-yyyy" name="date" value="<?php echo set_value('dob'); ?>" id="date" />
                              </div>
                            </div>
                             <div class="form-group row">
                              <label for="exampleqty" class="col-sm-2 col-form-label">Total Hour</label>
                              <div class="col-sm-6">
                                    <input class="form-control" type="number" name="hour" value="<?php echo set_value('qty'); ?>" id="exampleqty" placeholder="0" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-info pull-right">Save</button>
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
        $('#dept').focus();
        $('#date').datepicker();

        $('#dept').change(function(){

           var dept_id = $(this).val();
           console.log(dept_id);
          if(dept_id != ''){
            $.post( url+"view/get_employee_by_department", { dept_id: dept_id })
                  .done(function( data ) {
                    if(data.str!==''){
                        $('#employee_input').html(data.str);
                        $('#alert').html('');
                    }else{
                         $('#alert').html('<div class="alert alert-warning">No Employee Found For this Department ! </div>');
                    }
                  });
                         
          }else{
            $('#alert').html('<div class="alert alert-warning">Select Department First ! </div>');
          }
        });

      

    });
    
    
 
</script>

            