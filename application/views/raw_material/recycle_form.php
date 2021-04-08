<?php  $this->load->view('inc/header'); ?>           

            <section class="content-header">
                <h1>
                    RECYCLE
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Recycle Raw Material </a></li>
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
                                     <h3>Recycle Raw Material </h3>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('view/recycle_raw_material')?>" class="btn pull-right btn-sm btn-primary">View All</a>
                                 </div>
                             </div>   
                             <div clsss="row">
                                <div class="col-sm-10">
                                     <?php
                                    echo form_open('new_add/raw_material_recycle', array('class'=>'form form-horizontal'));
                                    $user  = $this->session->userdata('user_info');
                                    

                            ?>
                            
                            

                            <div class="form-group row">
                              <label for="exampleselect" class="col-sm-4 col-form-label">Recycled Mateial Type</label>
                              <div class="col-sm-8">
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
                              <label for="exampleunit" class="col-sm-4 col-form-label">Unit</label>
                              <div class="col-sm-8">
                                     <select class="form-control" type="text" name="unit" id="exampleunit" required>
                                        <option value="Kg">Kg</option>
                                        <option value="Pack">Pack</option>      
                                    </select>
                              </div>
                            </div>
                             
                            <div class="form-group row">
                              <label for="exampleqty" class="col-sm-4 col-form-label">Waste Quantity Before Recycle</label>
                              <div class="col-sm-8">
                                    <input class="form-control" type="text" name="input_waste_qty" value="<?php echo set_value('input_waste_qty'); ?>" id="exampleqty" placeholder="0" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleqty" class="col-sm-4 col-form-label">Waste Quantity After Recycle</label>
                              <div class="col-sm-8">
                                    <input class="form-control" type="text" name="output_waste_qty" value="<?php echo set_value('output_waste_qty'); ?>" id="exampleqty" placeholder="0" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleqty" class="col-sm-4 col-form-label">Recycled Useable Material Quantity</label>
                              <div class="col-sm-8">
                                    <input class="form-control" type="text" name="recycle_qty" value="<?php echo set_value('recycle_qty'); ?>" id="exampleqty" placeholder="0" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleqty" class="col-sm-4 col-form-label">Uncountable Quantity Approximately</label>
                              <div class="col-sm-8">
                                    <input class="form-control" type="text" name="uncountable_qty" value="<?php echo set_value('uncountable_qty'); ?>" id="exampleqty" placeholder="0" required>
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

   <script>
    $(document).ready(function(){
       


        $('#supplierSelect').blur(function(){
          var select = $('#supplierSelect').val();
          if(select === '0'){
            $('#supplierSelect').css('border','1px solid red');
          }
        });
    });


</script>         