<?php  $this->load->view('workstationone/inc/header');

$product_type = $this->model->getData('product_type');

 ?>



<section class="content-header">

  <h1>

    Finish Product

  </h1>

  <ol class="breadcrumb">

    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

    <li class="breadcrumb-item active"><a href="#">Finish Product</a></li>

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

           <h3>Product</h3>

           <?php

           echo form_open('workstationone/delivery', array('class'=>'form form-horizontal'));



           ?>



           <div class="form-group row">

            <label for="catSelect" class="col-sm-2 col-form-label">Product Type</label>

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

            <label for="exampleqty" class="col-sm-2 col-form-label">Quantity</label>

            <div class="col-sm-8">

              <input class="form-control" type="text" name="qty" value="<?php echo set_value('qty'); ?>" id="exampleqty" placeholder="0"  autocomplete="off"  required>

            </div>

          </div>

          <div class="form-group row">

            <label for="product_id" class="col-sm-2 col-form-label">Select Unit</label>

            <div class="col-sm-4">

              <select class="form-control" type="text" name="unit" id="buyerSelect"  required>

               <option value="Kg">Kg</option>     
               <option value="Pcs">Pcs</option>                                         

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
    <div class="row">
      <div class="col"> <h3>Product in Chalan</h3></div>
      <div class="col"><a href="<?=base_url()?>workstationone/cancelChalan/workstationone/delivery" class="btn btn-warning btn-sm pull-right">Cancel Chalan</a></div>
    </div>
   

    <?php echo form_open('workstationone/update_delivery_cart');  ?>



    <table class="table">

      <thead>

        <tr>

          <th>Item</th>
          <th>Qty</th>
          <th style="text-align:right">weight</th>

        </tr>

      </thead>

      <tbody>

        <?php $i = 1; $total=0; ?>



        <?php 
          $totWht = 0;
        foreach ($this->cart->contents() as $items): ?>



          <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>



          <tr>



            <td>

              <?php echo $items['name']; ?>



            </td>
             <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); $total = $total+$items['qty']; ?></td>


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
          <td><strong></strong></td>
          <td style="text-align:right"><strong>Total</strong></td>
          <td style="text-align:right"><?php echo $totWht; ?></td>

        </tr>

      </tbody>

    </table>



    <p>
      <?php echo form_submit('', 'Update Memo', array('class'=>'btn btn-warning')); ?>
      <a onClick="return confirm('Are Your sure to Proceed ?')" href="<?=base_url()?>workstationone/deliveryChalan" class="btn btn-success pull-right" >Proceed...</a>
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



<?php  $this->load->view('workstationone/inc/footer'); ?>


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



