<?php  $this->load->view('workstationone/inc/header'); ?>
            

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
                            <div class="col-xl-12 col-12 pr-0">
                               
                                <div class="box box-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                             <h3>Add Waste Material</h3>
                                         </div>
                                         <div class="col-sm-6">
                                            
                                         </div>
                                     </div> 

                                    <div class="row">
                                      <div class="col-sm-10">   
                                    <?php
                                            echo form_open('workstationone/waste_material', array('class'=>'form form-horizontal'));

                                    ?>

                                                             
                            
                             <div class="form-group row">
                              <label for="exampleunit" class="col-sm-2 col-form-label">Unit</label>
                              <div class="col-sm-10">
                                     <select class="form-control" type="text" name="unit" id="exampleunit" required>
                                        <option value="Kg">Kg</option>
                                            
                                    </select>
                              </div>
                            </div>
                             
                            <div class="form-group row">
                              <label for="exampleqty" class="col-sm-2 col-form-label">Quantity</label>
                              <div class="col-sm-10">
                                    <input class="form-control" type="text" name="qty" value="<?php echo set_value('qty'); ?>" id="exampleqty" placeholder="0" required>
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
                                <tfoot>
                                    <tr>
                                      <th>Date</th>
                                        
                                        <th>Quantity</th>                                       
                                        <th>Action</th>
                                        
                                    </tr>
                                </tfoot>
                        </table>
                      </div>

                    </div>
                </div>



                




            </section>

<?php  $this->load->view('workstationone/inc/footer'); ?>
<script>
  
$(document).ready(function(){

  $('#waste_table').DataTable({
      "ajax": url+'workstationone/getWaste'
  });

});

</script>
            


