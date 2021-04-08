<?php  $this->load->view('workstationone/inc/header'); ?>

<section class="content-header">

  <h1>

    Spare Parts

  </h1>

  <ol class="breadcrumb">

    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

    <li class="breadcrumb-item active"><a href="#">parts</a></li>

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

           <h3>Spare Parts</h3>

           <?php

           echo form_open('workstationone/spare_parts', array('class'=>'form form-horizontal'));



           ?>



           <div class="form-group row">

            <label for="product_id" class="col-sm-2 col-form-label">Select Product</label>

            <div class="col-sm-6">

              <select class="form-control" type="text" name="product_id" id="buyerSelect"  required>

                <?php 
                if(!empty($product_type)){
                  foreach($product_type as $product){
                    echo '<option value="'.$product['id'].'">'.$product['name'].'</option>';
                  }
                }

                ?>                                           

              </select>

            </div>
          </div>



          <div class="form-group row">

            <label for="exampleqty" class="col-sm-2 col-form-label">Quantity in KG/Pcs</label>

            <div class="col-sm-6">

              <input class="form-control" type="number" name="qty" id="exampleqty" required>
              
            </div>

          </div>
          <div class="form-group row">

            <label for="exampleqty" class="col-sm-2 col-form-label">Unit</label>

            <div class="col-sm-6">

              <select class="form-control" name="unit" id="exampleunit"required>
                <option value="kg">KG</option>
                <option value="pcs">Pcs</option>

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

      <h3>Parts In Chalan</h3>

      <?php echo form_open('workstationone/update_parts_cart');  ?>



      <table class="table">

        <thead>

          <tr>

            <th>Parts</th>                                 



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

              <td  style="text-align:right"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); $total = $total + $items['qty']; ?></td>



            </tr>



            <?php $i++; ?>



          <?php endforeach; ?>



          <tr>



            <td style="text-align:right"><strong>Total</strong></td>

            <td style="text-align:right"><?php echo $total; ?> </td>

          </tr>

        </tbody>

      </table>



      <p>
        <?php echo form_submit('', 'Update Memo', array('class'=>'btn btn-warning')); ?>
        <a href="<?=base_url()?>workstationone/createSparePartsChalan" class="btn btn-success pull-right" >Proceed...</a>
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



