<?php  $this->load->view('workstationtwo/inc/header'); ?>

            



<section class="content-header">

    <h1>

        Sale Product

    </h1>

    <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="breadcrumb-item active"><a href="#">Sale</a></li>

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

                         <h3>Sale Product</h3>

                          <?php

                                echo form_open('workstationtwo/sale_product', array('class'=>'form form-horizontal'));



                        ?>



         <div class="form-group row">

        <label for="product_id" class="col-sm-2 col-form-label">Select Category</label>
        <div class="col-sm-8">
              <select class="form-control" type="text" name="type_id" id="catSelect"  required>

                <?php 
                if(!empty($product_type)){
                  echo '<option>Select Product </option>';
                  foreach($product_type as $product_type){                     
                     echo '<option value="'.$product_type['product_type_id'].'">'.$product_type['type_name'].'</option>';                    
                  }
                }else{
                  echo '<option>No product type defined ! </option>';
                }
                ?>                              

              </select>

            </div>
            </div>
            <div class="form-group row">
            <label for="product_id" class="col-sm-2 col-form-label">Select Product</label>
            <div class="col-sm-8">
              <select class="form-control" type="text" name="product_id" id="PSelect"  required>
              </select>
            </div>
          </div>                    
           <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-6">
                  <input class="form-control" type="number" step="0.01" name="price" value="<?php echo set_value('price'); ?>" id="qty" placeholder="0"  autocomplete="off"  required>
            </div>

          </div> 
          <div class="form-group row">

            <label for="qty" class="col-sm-2 col-form-label">Quantity</label>

            <div class="col-sm-6">

                  <input class="form-control" type="number" name="qty" value="<?php echo set_value('qty'); ?>" id="qty" placeholder="0"  step="0.001" autocomplete="off"  required>

            </div>

          </div>

             <div class="form-group row">

                <label for="unit" class="col-sm-2 col-form-label">Select Unit</label>

                <div class="col-sm-6">

                      <select class="form-control" type="text" name="unit" id="unit"  required>                                                     
                              <option value="Pcs">Pcs</option>                                         
                              <option value="Kg">Kg</option>     
                  </select>

                </div>
              </div>  


            <div class="form-group row">

              <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>

              <div class="col-sm-10">

                <button type="submit" class="btn btn-info pull-right">Add To Invoice</button>

              </div>

            </div>



         </form>

         </div>

       </div>

         <div class="col-sm-6">

             <div class="box box-body">

                  <h3>Product</h3>

                  <?php echo form_open('workstationtwo/update_sale_cart');  ?>



                    <table class="table">

                      <thead>
                          <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>QTY</th>
                             <th style="text-align:right">Weight</th>
                          </tr>
                      </thead>
                      <tbody>
                    <?php $i = 1; $total=0; $totWht=0; ?>
                    <?php foreach ($this->cart->contents() as $items): ?>
                   <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                    <tr>                                
                    <td><?php echo $items['name']; ?></td>
                    <td><?php echo $items['price']?></td>
                    <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')).$items['options']['unit']; $total = $total +$items['qty'] ?></td>
                    
                      <td style="text-align:right">
                        <?php 

                        $wht =  floatval($items['options']['weight']);
                        if($wht > 0.00){
                          $sub =  $items['qty'] * $wht;
                        }else{
                          $sub = $items['qty'] * 1;
                        }
                        echo $sub;
                        $totWht += $sub;
                         ?>
              
                    </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    <tr>
                                                  
                            <td style="text-align:right"><strong>Total</strong></td>
                             <td><?php echo $this->cart->total(); ?></td>
                            <td><?php echo $total; ?></td>
                            <td  style="text-align:right">
                              <?php echo $totWht; ?>
                              
                            </td>

                    </tr>

                  </tbody>

                    </table>



                    <p>
                      <?php echo form_submit('', 'Update Memo', array('class'=>'btn btn-warning')); ?>
                        <a onClick="return confirm('Are You sure to proceed ? ');" href="<?=base_url()?>workstationtwo/saleChalan" class="btn btn-success pull-right" >Proceed...</a>
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
<script>
$(document).ready(function(){
$('#catSelect').change(function(){
  $('#PSelect').html('');
var html = '';
var typeId = $(this).val();
$.post( url+"workstationone/get_product_with_productID", { type_id: typeId })
  .done(function( data ) {    
    $('#PSelect').html(data);
  }); 
});
});
</script>


            