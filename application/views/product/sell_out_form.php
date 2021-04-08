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

                                <div class="col-sm-6">

                                  <div class="box box-body">

                                     <h3>Product Sell Out</h3>

                                      <?php

                                            echo form_open('new_add/new_sellOut', array('class'=>'form form-horizontal'));



                                    ?>



                                    <div class="form-group row">

                                      <label for="prselect" class="col-sm-2 col-form-label">Select Product</label>

                                      <div class="col-sm-10">

                                            <select class="form-control" type="text" name="product_type_id" id="prselect"  required>

                                                    <option value="">Select Product</option>

                                            <?php

                                                  if(!empty($product)){

                                                    foreach($product as $pr){

                                                      echo '<option value="'.$pr['product_type_id'].'">'.$pr['type_name'].'</option>';

                                                    }

                                                  }



                                            ?>

                                            

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

                                      <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>

                                      <div class="col-sm-10">

                                        <button type="submit" class="btn btn-info pull-right">Add To Memo</button>

                                      </div>

                                    </div>



                                 </form>

                                 </div>

                               </div>

                                 <div class="col-sm-6">

                                     <div class="box box-body">

                                          <h3>Product In Queue</h3>

                                          <?php echo form_open('new_add/update_cart');  ?>



                                            <table class="table">

                                              <thead>

                                                  <tr>

                                                          <th>Item</th>

                                                          <th>QTY</th>                                                    

                                                          <th style="text-align:right">Unit Price</th>

                                                          <th style="text-align:right">Sub-Total</th>

                                                  </tr>

                                              </thead>

                                              <tbody>

                                            <?php $i = 1; ?>



                                            <?php foreach ($this->cart->contents() as $items): ?>



                                                    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>



                                                    <tr>

                                                            

                                                            <td>

                                                                    <?php echo $items['name']; ?>



                                                            </td>

                                                            <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>

                                                            <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>

                                                            <td style="text-align:right">Tk.<?php echo $this->cart->format_number($items['subtotal']); ?></td>

                                                    </tr>



                                            <?php $i++; ?>



                                            <?php endforeach; ?>



                                            <tr>

                                                    <td colspan="2"> </td>

                                                    <td style="text-align:right"><strong>Total</strong></td>

                                                    <td style="text-align:right">Tk.<?php echo $this->cart->format_number($this->cart->total()); ?></td>

                                            </tr>

                                          </tbody>

                                            </table>



                                            <p>
                                              <?php echo form_submit('', 'Update Memo', array('class'=>'btn btn-warning')); ?>
                                                <a href="<?=base_url()?>new_add/select_buyer_for_sell" class="btn btn-success pull-right" >Proceed...</a>
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



<?php  $this->load->view('inc/footer'); ?>



            