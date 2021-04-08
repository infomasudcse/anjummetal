<?php  $this->load->view('inc/header'); ?>           
<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker.css"/>
            <section class="content-header">
                <h1>
                    RAW MATERIAL BUY
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Raw Material </a></li>
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
                                     <h3>Buy Raw Material </h3>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('view/raw_material')?>" class="btn pull-right btn-sm btn-primary">View All</a>
                                 </div>
                             </div>   
                             <div clsss="row">
                                <div class="col-sm-10">
                                     <?php
                                    echo form_open('new_add/new_material', array('class'=>'form form-horizontal'));
                                    $user  = $this->session->userdata('user_info');
                                    $supplier = get_people_of_branch('supplier', $user['branch_id']);

                            ?>
                            
                            <div class="form-group row">
                              <label for="supplierSelect" class="col-sm-2 col-form-label">Select Supplier</label>
                              <div class="col-sm-10">
                                <select class="form-control" type="text" name="supplier_id" id="supplierSelect"  required>
                                    <option value="">Select Supplier</option>
                                    <?php
                                          if(!empty($supplier)){
                                            foreach($supplier as $user){
                                              echo '<option value="'.$user['id'].'">'.$user['full_name'].'</option>';
                                            }
                                          }

                                    ?>
                                    
                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="exampleselect" class="col-sm-2 col-form-label">Mateial Type</label>
                              <div class="col-sm-10">
                                <select class="form-control" type="text" name="type_id" id="exampleselect"  required>
                                    <?php
                                          if(!empty($type)){
                                            foreach($type as $val){
                                              echo '<option value="'.$val['type_id'].'">'.$val['type_name'].'</option>';
                                            }
                                          }

                                    ?>
                                    
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="<?php echo set_value('name'); ?>" id="example-text-input"  placeholder="Name..." >
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="desc" class="col-sm-2 col-form-label">Description</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" name="desc" type="text"  id="desc"><?php echo set_value('desc'); ?></textarea>
                              </div>
                            </div>

                             <div class="form-group row">
                              <label for="exampleunit" class="col-sm-2 col-form-label">Unit</label>
                              <div class="col-sm-10">
                                     <select class="form-control" type="text" name="unit" id="exampleunit" required>
                                        <option value="Kg">Kg</option>
                                        <option value="Pack">Pack</option>      
                                    </select>
                              </div>
                            </div>
                             <div class="form-group row">
                              <label for="exampleprice" class="col-sm-2 col-form-label">Unit Price</label>
                              <div class="col-sm-10">
                                    <input class="form-control" type="text" name="price" value="<?php echo set_value('price'); ?>" id="exampleprice" placeholder="0.00" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleqty" class="col-sm-2 col-form-label">Quantity</label>
                              <div class="col-sm-10">
                                    <input class="form-control" type="text" name="qty" value="<?php echo set_value('qty'); ?>" id="exampleqty" placeholder="0" required>
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
                             </div>
                           
                        </div>
                        <!-- /.box -->
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('inc/footer'); ?>
<script src="<?=base_url()?>assets/dist/js/bootstrap-datepicker.min.js"></script>

   <script>
    $(document).ready(function(){
        $('#date').datepicker();


        $('#supplierSelect').blur(function(){
          var select = $('#supplierSelect').val();
          if(select === '0'){
            $('#supplierSelect').css('border','1px solid red');
          }
        });
    });


</script>         