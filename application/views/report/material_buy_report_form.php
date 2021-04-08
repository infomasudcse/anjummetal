<?php  $this->load->view('inc/header'); ?>          
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
                                     <h3>Material Buy Report </h3>
                                 </div>
                             </div>   
                            <?php
                                    echo form_open('report/show_material_buy_details', array('class'=>'form form-horizontal'));

                            ?>
                            <div class="form-group row">
                              <label for="style" class="col-sm-2 col-form-label">Select Supplier</label>
                              <div class="col-sm-6">
                                <select class="form-control" name="supplier" id="stype" required>
                                    <option value="0">All</option>
                                  <?php 
                                          if($supplier->num_rows()>0){
                                              foreach($supplier->result_array() as $sup){
                                                echo '<option value="'.$sup['id'].'">'.$sup['full_name'].'</option>';
                                              }
                                          }

                                  ?>
                                   
                                </select>
                              </div>
                            </div>
                             <div class="form-group row">
                               <label for="style" class="col-sm-2 col-form-label">Select Material Type</label>
                              <div class="col-sm-6">

                                <select class="form-control" name="type" id="type" required>
                                    <option value="0">All</option>
                                  <?php 
                                          if(is_array($type) && !empty($type)){
                                              foreach($type as $tp){
                                                echo '<option value="'.$tp['type_id'].'">'.$tp['type_name'].'</option>';
                                              }
                                          }

                                  ?>
                                   
                                </select>
                              </div>
                              
                            </div>
                          
                            <div class="form-group row">
                              <label for="dob" class="col-sm-2 col-form-label">From Date </label>
                              <div class="col-sm-6">
                                <input class="form-control" type="date" placeholder="dd-mm-yyyy" name="from"  />
                              </div>
                              
                            </div>
                             <div class="form-group row">
                              <label for="dob" class="col-sm-2 col-form-label">To Date </label>
                              <div class="col-sm-6">
                                <input class="form-control" type="date" placeholder="dd-mm-yyyy" name="to"  />
                              </div>
                              
                            </div>

                           <div class="form-group row">
                           <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>  
                           <div class="col-sm-10"> 
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="report_type" id="inlineRadio1" value="total" checked="checked">
                            <label class="form-check-label" for="inlineRadio1">Only total weight</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="report_type" id="inlineRadio2" value="full">
                            <label class="form-check-label" for="inlineRadio2">Full</label>
                          </div>
                        </div>
                        </div>


                            <div class="form-group row">
                              <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10 text-center">
                                <button type="submit" class="btn btn-info">Check</button>
                              </div>
                            </div>

                         </form>
                        </div>
                        <!-- /.box -->
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('inc/footer'); ?>

            