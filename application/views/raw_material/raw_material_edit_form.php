<?php  $this->load->view('inc/header'); ?>           

            <section class="content-header">
                <h1>
                    RAW MATERIAL 
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
                                   print_r($material);
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
                                     <h3>Edit Raw Material </h3>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('view/raw_material')?>" class="btn pull-right btn-sm btn-warning">Cancel</a>
                                 </div>
                             </div>   
                            <?php
                                    echo form_open('edit/raw_material', array('class'=>'form form-horizontal'));

                            ?>
                                <input type="hidden" name="edit_id" value="<?=$material['raw_material_id']?>" />

                            <div class="form-group row">
                              <label for="supplierSelect" class="col-sm-2 col-form-label">Select Supplier</label>
                              <div class="col-sm-10">
                                <select class="form-control" type="text" name="supplier_id" id="supplierSelect"  required>
                                            <option value="">Select Supplier</option>
                                    <?php
                                          if(!empty($supplier)){
                                            foreach($supplier as $user){
                                               if($material['supplier_id'] == $user['id']){
                                                 echo '<option value="'.$user['id'].'" selected>'.$user['full_name'].'</option>';
                                               }else{
                                                 echo '<option value="'.$user['id'].'">'.$user['full_name'].'</option>';
                                               }
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
                                                  if($material['type_id'] == $val['type_id']){
                                                      echo '<option value="'.$val['type_id'].'" selected>'.$val['type_name'].'</option>';
                                                  }else{
                                                    echo '<option value="'.$val['type_id'].'" >'.$val['type_name'].'</option>';
                                                  }
                                              
                                            }
                                          }

                                    ?>
                                    
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="<?=$material['name']?>" id="example-text-input"  placeholder="Name..."  required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="desc" class="col-sm-2 col-form-label">Description</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" name="desc" type="text"  id="desc"><?=$material['description']?></textarea>
                              </div>
                            </div>
                             <div class="form-group row">
                              <label for="exampleunit" class="col-sm-2 col-form-label">Unit</label>
                              <div class="col-sm-10">
                                     <select class="form-control" type="text" name="unit" id="exampleunit" required>
                                        <?php
                                              echo '<option value="'.$material['unit'].'" selected>'.$material['unit'].'</option>';
                                        ?>
                                        <option value="Kg">Kg</option>
                                        <option value="Pack">Pack</option>      
                                    </select>
                              </div>
                            </div>
                             <div class="form-group row">
                              <label for="exampleprice" class="col-sm-2 col-form-label">Unit Price</label>
                              <div class="col-sm-10">
                                    <input class="form-control" type="text" name="price" value="<?=$material['unit_price']?>" id="exampleprice" placeholder="0.00" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleqty" class="col-sm-2 col-form-label">Quantity</label>
                              <div class="col-sm-10">
                                    <input class="form-control" type="text" name="qty" value="<?=$material['quantity']?>" id="exampleqty" placeholder="0" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                              </div>
                            </div>

                         </form>
                        </div>
                        <!-- /.box -->
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('inc/footer'); ?>

            