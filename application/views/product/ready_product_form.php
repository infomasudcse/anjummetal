<?php  $this->load->view('inc/header'); ?>           <!-- 
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker.css"/>
<style> 
    .ui-autocomplete {    max-height: 200px;    overflow-y: auto;
                          /* prevent horizontal scrollbar */
                          overflow-x: hidden; 
    }
    /* IE 6 doesn't support max-height   * we use height instead, but this forces the menu to always be this tall   */
    * html .ui-autocomplete {    height: 200px;  }  
    .well-lg{padding: 2px ;}
</style> 


            <section class="content-header">
                <h1>
                    NEW PRODUCT  
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">New Product </a></li>
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
                                     <h3>Add New Product </h3>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('view/ready_product')?>" class="btn pull-right btn-sm btn-primary">View All</a>
                                 </div>
                             </div>   
                            <?php
                                    echo form_open('new_add/ready_product', array('class'=>'form form-horizontal'));

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
                              <label for="exampleselect" class="col-sm-2 col-form-label">Product Type</label>
                              <div class="col-sm-6">
                                <select class="form-control" type="text" name="product_type" id="select_product_type"  required>
                                  <option value="">Select Department First</option>
                                                                           
                                </select>
                              </div>
                              <div class="col-sm-4" id="alert2"></div>
                            </div>
                            <!--  <div class="form-group row">
                              <label for="employee_input" class="col-sm-2 col-form-label">Employee</label>
                              <div class="col-sm-6">
                                     <select class="form-control" name="employee" id="employee_input" required>
                                         <option value="">Select Product Type First</option>
                                               
                                     </select>
                              </div>
                               <div class="col-sm-4" id=""></div>
                            </div> -->
                             <div class="form-group row">
                              <label for="exampleqty" class="col-sm-2 col-form-label">Quantity</label>
                              <div class="col-sm-6">
                                    <input class="form-control" type="number" name="qty" value="<?php echo set_value('qty'); ?>" id="exampleqty" placeholder="0" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleqty" class="col-sm-2 col-form-label">Unit</label>
                              <div class="col-sm-6">
                                    <select class="form-control" name="unit" placeholder="0" required>
                                      <option value="kg">KG</option>
                                      <option value="pack">Pack</option>
                                    </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="dob" class="col-sm-2 col-form-label">Date </label>
                              <div class="col-sm-6">
                                <input class="form-control datepicker" type="text" placeholder="dd-mm-yyyy" name="date" value="<?php echo set_value('date'); ?>" id="date" />
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
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script type="text/javascript">
  
  // $(document).on('change','#select_product_type', function(){
  //        var pid = $(this).val();
  //          console.log(pid);
  //         if(pid != ''){
  //           $.post( url+"view/get_emloyee_by_product_type", { pid: pid })
  //                 .done(function( data ) {
  //                   if(data.str!==''){
  //                       $('#employee_input').html(data.str);
  //                       $('#alert2').html('');
  //                   }else{
  //                        $('#alert2').html('<div class="alert alert-warning">No Employee making this product ! </div>');
  //                   }
  //                 });
                         
  //         }else{
  //           $('#alert2').html('<div class="alert alert-warning">Select Product Type First ! </div>');
  //         }
  // });


    $(document).ready(function(){
        $('#dept').focus();
        $('#date').datepicker();

        $('#dept').change(function(){

           var dept_id = $(this).val();
           console.log(dept_id);
          if(dept_id != ''){
            $.post( url+"view/get_product_by_department", { dept_id: dept_id })
                  .done(function( data ) {
                    if(data.str!==''){
                        $('#select_product_type').html(data.str);
                        $('#alert').html('');
                    }else{
                         $('#alert').html('<div class="alert alert-warning">No Product Found For this Department ! </div>');
                    }
                  });
                         
          }else{
            $('#alert').html('<div class="alert alert-warning">Select Department First ! </div>');
          }
        });

      

    });
    
    
    // $(function () {
        
    //     $("#employee_input").autocomplete({
         
    //         source: function (request, response) {
    //             $.ajax({
    //                 url: url+"new_add/employee_suggestion/"+request.term,
    //                 dataType: "json",
    //                 data: {
    //         str: request.term

    //       },
    //              success: function (dat0a) {
    //                     console.log(data);

    //                     response(data);
    //                 }
    //             });
    //         },
    //        select: function( event, ui ) {
    //             // $(this).attr('readonly', true);
    //   }
    //     });
    // });
</script>

            