<?php  $this->load->view('inc/header'); ?>

<section class="content-header">
    <h1> Spare Parts Chalan </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Chalans </a></li>
    </ol>
</section>
<section class="content">
   

    <div class="row">
                     
                    <div class="col-xl-12 col-12 pr-0">

                        <div id="alert_div">

                           

                        </div>

                        <!-- /.box -->

                    </div>

                    <div class="col-xl-12 col-12 pr-0">

                              <div class="row">
                               

                                <div class="col-sm-12">

                                  <div class="box box-body">

                                    <h2> Spare Parts Chalan</h2>

                                    <?php

                                            echo form_open('view/update_parts_chalan', array('class'=>'form form-horizontal' ,'id'=>'final_form'));
                                               
                                            
                                    ?>
                                      <input type="hidden" name="chalan_table_id" value="<?=$chalan['id']?>" />
                                      <input type="hidden" name="receive_table_id" value="<?=$parts['id']?>" /> 



                                      <div class="form-group row">

                                        <label for="chalan_no" class="col-sm-2 col-form-label">Chalan No. </label>

                                        <div class="col-sm-6">

                                              <input class="form-control" type="text" name="chalan_no" value="<?php echo $chalan['chalan_no']; ?>" id="chalan_no" placeholder="000" autocomplete="off" readonly>

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label for="date" class="col-sm-2 col-form-label">Chalan Date. </label>

                                        <div class="col-sm-6">

                                              <input class="form-control datepicker" type="text" name="chalan_date" value="<?php echo date('d-m-Y',strtotime($chalan['chalan_date'])); ?>" id="date" placeholder="000" autocomplete="off" readonly>

                                        </div>

                                    </div>


                                     <div class="form-group row">

                                      <label for="prselect" class="col-sm-2 col-form-label">Select Supplier</label>

                                      <div class="col-sm-6">

                                            <select class="form-control" type="text" name="supplier_id" id="buyerSelect"  required>

                                            <?php
                                                 $user =  get_user_info_by_id($chalan['supplier_id']);
                                                  

                                                  
                                                        
                                                           echo '<option value="'.$user['id'].'" selected>'.$user['full_name'].'</option>'  ;
                                                        

                                                    


                                            ?>

                                            

                                        </select>

                                      </div>

                                    </div>

                                    <div class="form-group row">

                                        <label for="product_id" class="col-sm-2 col-form-label"> Parts</label>

                                        <div class="col-sm-6">

                                             <input type="text" class="form-control" value="<?=get_parts_name($parts['parts_id'])?>" readonly/>
                                              <input type="hidden" name="type_id" value="<?=$parts['parts_id'];?>" />

                                        </div>
                                      </div>
                                       <div class="form-group row">

                                      <label for="exampleqty" class="col-sm-2 col-form-label">Price</label>

                                      <div class="col-sm-6">

                                    <input class="form-control" type="text" name="price" value="<?php echo $parts['price']; ?>" id="exampleqty" placeholder="0"  autocomplete="off"  required>

                                      </div>

                                    </div> 
                                   

                                    <div class="form-group row">

                                      <label for="exampleqty" class="col-sm-2 col-form-label">Quantity</label>

                                      <div class="col-sm-6">

                                            <input class="form-control" type="text" name="qty" value="<?php echo $parts['qty']; ?>" id="exampleqty" placeholder="0"  autocomplete="off"  required>

                                      </div>

                                    </div>
                                   
                                         
                                     <div class="form-group row"> 
                                        <div class="col-sm-10">

                                            <button type="submit" class="btn btn-primary pull-right" id="submit_btn">Finish</button>

                                      </div>

                                    </div>



                                  </form>

                                  </div>

                                </div>

                             </div>


                    </div>

                </div>

</section>



<?php  $this->load->view('inc/footer'); ?>




            