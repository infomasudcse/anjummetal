<?php  $this->load->view('inc/header'); ?>

<section class="content-header">
    <h1> Raw Materials Chalan </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">chalans </a></li>
    </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xl-12 col-12 pr-0">
      <div id="alert_div">
      </div>
    </div>

    <div class="col-xl-12 col-12 pr-0">
      <div class="row">
        <div class="col">
            <h2>Update Chalan</h2>
        </div>
        <div class="col">
            <a class="btn btn-success btn-sm" href="<?=base_url()?>report/material_receive_chalans">Back</a>
            
           <?php if($chalan['status']=='unverified'){ ?>

            <a class="btn btn-danger btn-sm pull-right" href="<?=base_url()?>Delete/delete_raw_material_chalans/<?=$chalan['id']?>" onClick="return confirm('Are You Sure to Delete ? ')"> X Delete</a>

          <?php } ?>

        </div>
      </div>  
        <div class="row">
          <div class="col-sm-12">

          <div class="box box-body">

          

            <?php

                    echo form_open('view/update_material_chalan', array('class'=>'form form-horizontal' ,'id'=>'final_form'));

                     $supplier = $this->model->getData('users', 'role', 'supplier');
            ?>

               
               <input name="chalan_table_id" type="hidden" value="<?=$chalan['id']?>" />



                <div class="form-group row">

                  <label for="chalan_no" class="col-sm-2 col-form-label">Chalan No. </label>

                  <div class="col-sm-6">

                        <input class="form-control" type="text" name="chalan_no" value="<?php echo $chalan['chalan_no']; ?>" id="chalan_no" placeholder="000" autocomplete="off" readonly>

                  </div>

              </div>

              <div class="form-group row">

                  <label for="date" class="col-sm-2 col-form-label">Chalan Date. </label>

                  <div class="col-sm-6">

                        <input class="form-control " type="text" name="chalan_date" value="<?php echo date('d-m-Y', strtotime($chalan['chalan_date'])); ?>" id="date" placeholder="000" autocomplete="off" readonly>

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
              <div class="col-sm-4">
              </div>
            </div>
           <!--  <div class="form-group row">

                <label for="other_expense" class="col-sm-2 col-form-label">Other Expense. </label>

                <div class="col-sm-6">

                      <input class="form-control" type="number" name="other_expense" value="<=$chalan['other_expense']?>" id="other_expense" autocomplete="off" required="">

                </div>

            </div> -->
            <!-- <div class="form-group row">

                <label for="discount" class="col-sm-2 col-form-label">Discount </label>

                <div class="col-sm-6">

                      <input class="form-control" type="number" name="discount" value="<=$chalan['discount']?>" id="discount" autocomplete="off" required="">

                </div>

            </div> -->
            <div class="form-group row">
              <label for="prselect" class="col-sm-3 col-form-label"> Material</label>
             <!--  <label for="prselect" class="col-sm-3 col-form-label"> Price</label> -->
              <label for="exampleqty" class="col-sm-3 col-form-label">Quantity</label>
              <div class="col-sm-3"></div>
            </div>
<?php 
      if(!empty($material)){
          foreach($material as $rowMaterial){ ?>

            
           <div class="form-group row">
            <div class="col-sm-3">
                      <input type="text" class="form-control" value="<?=get_material_type_name($rowMaterial['material_id'])?>" readonly/>
                      <input type="hidden" name="type_id[]" value="<?=$rowMaterial['id'];?>" />
            </div>
            
          <!--   <div class="col-sm-3">
                    <input type="number" value="<=$rowMaterial['price']?>" class="form-control" autocomplete="off" name="price[]" required <=(($chalan['status']=='verified')?'readonly':'')?>/>
              </div> -->
             <div class="col-sm-3"> 
             <input class="form-control" type="number" name="qty[]" value="<?php echo $rowMaterial['quantity']; ?>" id="exampleqty" placeholder="0"  autocomplete="off"  required <?=(($chalan['status']=='verified')?'readonly':'')?> >                
            </div>
             <div class="col-sm-3"> </div>

          </div>
          
   <?php } }else{ echo '<div class="row"><div class="col alert alert-danger">May be this is an OLD chalan. This Chalan has no Material ! </div></div>';} ?> 

    <div class="form-group row">
            <label for="exampleqty" class="col-sm-9 col-form-label"></label>
            
             <div class="col-sm-2">
                    <?php 
                    if($chalan['status']=='verified'){
                          echo '<span class="btn btn-default">Verified </span>';
                     }else{ 

                      echo '<button type="submit" class="btn btn-primary" id="submit_btn">Update</button>';

                     } ?>

            </div>
          </div>  

<?php   if($chalan['status']=='unverified'){ ?>

 <!-- <div class="card card-body" style="border:1px solid blue;">
    <div class="row"><div class="col"><h3>Payment optional</h3></div></div>

  <div class="form-group row">
      <label for="prselect" class="col-sm-2 col-form-label">Paid Amount *</label>
      <div class="col-sm-6">
            <input class="form-control" type="number" name="amount" id="buyeramount" placeholder="000" />
      </div>    
  </div>
    
  <div class="form-group row">
    <label for="prselect" class="col-sm-2 col-form-label">Payment Date *</label>
    <div class="col-sm-6">
    <input class="form-control datepicker" type="date" name="paymentdate" id="paymentdate"  />
    </div>
  </div>
  <div class="form-group row">
    <label for="to_customer" class="col-sm-2 col-form-label">Payment type *</label>
    <div class="col-sm-6">
    <select class="form-control" type="text" name="payment_type" id="payment_type"  >
    <option value="cash">Cash</option>
    <option value="cheque">Cheque</option>
    <option value="rejection">Rejection</option>                             

    </select>
    </div>
  </div>


  <div class="form-group row" id="extradiv" style="display:none;">
    <div class="col-sm-3">
      <label for="name" class="col-form-label">Bank Name *</label>
      <input class="form-control" type="text" name="bankname" id="name" />
    </div>
     <div class="col-sm-3">
      <label for="cnumber" class="col-form-label">Cheque Number *</label>
      <input class="form-control" type="text" name="chequenumber" id="cnumber" />
    </div>
     <div class="col-sm-3">
      <label for="checkdate" class="col-form-label">Check Date *</label>
      <input class="form-control" type="date" name="checkdate" id="checkdate" />
    </div>
  </div>  

</div> -->
<?php } ?>
      

        </form>
      </div>
    </div>
  </div>

  </div>
</div>

</section>



<?php  $this->load->view('inc/footer'); ?>

<script>
  
$(document).ready(function(){

   
    $( "#payment_type" ).change(function() {
        var selected = $(this).val();
        if(selected =='cheque'){
            $("#extradiv").slideDown();
        }else{
          $("#extradiv").slideUp();
        }
       
      });

});

</script>



            