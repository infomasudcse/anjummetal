<?php  $this->load->view('workstationtwo/inc/header');

$product_type = $this->model->getData('product_type');

 ?>



<section class="content-header">

  <h1>

    Delivery Product

  </h1>

  <ol class="breadcrumb">

    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

    <li class="breadcrumb-item active"><a href="#">Delivery</a></li>

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

           echo form_open('workstationtwo/delivery', array('class'=>'form form-horizontal'));



           ?>



           <div class="form-group row">

            <label for="catSelect" class="col-sm-2 col-form-label">Select Category</label>

            <div class="col-sm-6">

              <select class="form-control" type="text" name="cat_id" id="catSelect"  required>

                <?php 
                if(!empty($product_type)){
                  foreach($product_type as $product){
                    if($product['category_id']!=0){
                     echo '<option value="'.$product['category_id'].'">'.$product['type_name'].'</option>';
                    }
                  }
                }

                ?>                                           

              </select>

            </div>
          </div>
           <div class="form-group row">

            <label for="product_id" class="col-sm-2 col-form-label">Select Product</label>

            <div class="col-sm-6">

              <select class="form-control" type="text" name="product_id" id="PSelect"  required>

                                                         

              </select>

            </div>
          </div>





          <div class="form-group row">

            <label for="exampleqty" class="col-sm-2 col-form-label">Quantity</label>

            <div class="col-sm-6">

              <input class="form-control" type="text" name="qty" value="<?php echo set_value('qty'); ?>" id="exampleqty" placeholder="0"  autocomplete="off"  required>

            </div>

          </div>

          <div class="form-group row">

            <label for="product_id" class="col-sm-2 col-form-label">Select Unit</label>

            <div class="col-sm-6">

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

    <h3>Product to Delivery</h3>

    <?php echo form_open('workstationtwo/update_delivery_cart');  ?>



    <table class="table">

      <thead>

        <tr>

          <th>Item</th>
          <th style="text-align:right">Qty</th>

        </tr>

      </thead>

      <tbody>

        <?php $i = 1; $total=0; ?>



        <?php foreach ($this->cart->contents() as $items): ?>



          <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>



          <tr>



            <td>

              <?php echo $items['name']; ?>



            </td>



            <td style="text-align:right"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); $total = $total+$items['qty']; ?></td>



          </tr>



          <?php $i++; ?>



        <?php endforeach; ?>



        <tr>
          <td style="text-align:right"><strong>Total</strong></td>

          <td style="text-align:right"><?php echo $this->cart->format_number($total); ?></td>

        </tr>

      </tbody>

    </table>



    <p>
      <?php echo form_submit('', 'Update Memo', array('class'=>'btn btn-warning')); ?>
      <a href="<?=base_url()?>workstationtwo/deliveryChalan" class="btn btn-success pull-right" >Proceed...</a>
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
var product = '<?php echo json_encode($product_type); ?>';
var jproduct = JSON.parse(product);

$('#catSelect').change(function(){
  $('#PSelect').html('');
var html = '';
  var catId = $(this).val();
  console.log(catId);
  $.each(jproduct,function(index,value){
    if(catId==value['sub_category_id']){
       html +='<option value="'+value['product_type_id']+'">'+value['type_name']+'</option>';
    }
    
    //console.log(value);
  })
  
 /* for(var i = 0; i<productLength;i++){
      console.log(jproduct[i]);
     // html +='<option>'+product[i]['type_name']+'</option>';
  }*/
  $('#PSelect').html(html);
});
console.log(product);



});


</script>



