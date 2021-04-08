<?php  $this->load->view('workstationtwo/inc/header'); ?>

            



            <section class="content-header">

                <h1>Accessories Receive</h1>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="breadcrumb-item active"><a href="#">New Chalan </a></li>

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

                                <div class="col-sm-6">

                                  <div class="box box-body">

                                     <h3>Accessories</h3>

                                      <?php

                                            echo form_open('workstationtwo/accessoriesDescription', array('class'=>'form form-horizontal'));



                                    ?>



                                    <div class="form-group row">

                                      <label for="acc_id" class="col-sm-2 col-form-label">Select Accessories</label>

                                      <div class="col-sm-10">

                                            <select class="form-control" type="text" name="acc_id" id="acc_id"  required>

                                                    <option value="">Select </option>

                                            <?php

                                                  if(!empty($acc)){

                                                    foreach($acc as $pr){

                                                      echo '<option value="'.$pr['id'].'">'.$pr['name'].'</option>';

                                                    }

                                                  }



                                            ?>

                                            

                                        </select>

                                      </div>

                                    </div>

                                   


                                    <div class="form-group row">

                                      <label for="exampleqty" class="col-sm-2 col-form-label">Quantity</label>

                                      <div class="col-sm-10">

                                            <input class="form-control" type="text" name="qty" value="<?php echo set_value('qty'); ?>" id="exampleqty" placeholder="0"  autocomplete="off"  required>

                                      </div>

                                    </div>
                                    <div class="form-group row">

                                      <label for="unit" class="col-sm-2 col-form-label">Unit</label>

                                      <div class="col-sm-10">

                                            <select class="form-control" type="text" name="unit" id="unit"  required>

                                                    <option value="Kg">Kg </option>
                                                     <option value="Pcs">Pcs </option>

                                        </select>

                                      </div>

                                    </div>

                                    <div class="form-group row">

                                      <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>

                                      <div class="col-sm-10">

                                        <button type="submit" class="btn btn-info pull-right">Add To Chalan</button>

                                      </div>

                                    </div>



                                 </form>

                                 </div>

                               </div>

                                 <div class="col-sm-6">

                                     <div class="box box-body">

                                          <h3>Accessories In Chalan</h3>

                                          <?php echo form_open('workstationtwo/update_acc_cart');  ?>



                                            <table class="table">

                                              <thead>

                                                  <tr>

                                                          <th>Name</th>
                                                          <th style="text-align:right">QTY</th>

                                                  </tr>

                                              </thead>

                                              <tbody>

                                            <?php $i = 1; $total=0;?>



                                            <?php foreach ($this->cart->contents() as $items): ?>



                                                    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>



                                                    <tr>

                                                            

                                                            <td>

                                                                    <?php echo $items['name']; ?>



                                                            </td>

                                                            <td  style="text-align:right"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')).$items['options']['unit']; ?></td>

                                                           
                                                    </tr>



                                            <?php $i++; $total = $total+$items['qty']; ?>



                                            <?php endforeach; ?>



                                            <tr>

                                                   

                                                    <td style="text-align:right"><strong>Total</strong></td>

                                                    <td style="text-align:right"><?php echo $this->cart->format_number($total); ?></td>

                                            </tr>

                                          </tbody>

                                            </table>



                                            <p>
                                              <?php echo form_submit('', 'Update Memo', array('class'=>'btn btn-warning')); ?>
                                                <a href="<?=base_url()?>workstationtwo/select_acc_supplier" class="btn btn-success pull-right" >Proceed...</a>
                                              </p>

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



<?php  $this->load->view('workstationtwo/inc/footer'); ?>



            