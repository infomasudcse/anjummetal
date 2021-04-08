<?php  $this->load->view('inc/header'); ?>

<section class="content-header">
    <h1> Finish Goods Chalan </h1>
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
            <a class="btn btn-success btn-sm" href="<?=base_url()?>report/finish_goods_chalans">Back</a>
            <a class="btn btn-danger btn-sm pull-right" href="<?=base_url()?>Delete/delete_finish_goods_chalans/<?=$chalan['id']?>" onClick="return confirm('Are You Sure to Delete ? ')"> X Delete</a>
        </div>
      </div> 
      <div class="row">
        <div class="col-sm-12">

          <div class="box box-body">

          <h2>Update Chalan</h2>

<?php
      if($chalan['type']=='old'){
        echo ' <div class="alert alert-warning">This is an old Stock Entry  ! </div>';
      }



echo form_open('view/update_finish_goods_chalan', array('class'=>'form form-horizontal' ,'id'=>'final_form'));

    ?>

               
               <input name="chalan_id" type="hidden" value="<?=$chalan['id']?>" />



                <div class="form-group row">

                  <label for="chalan_no" class="col-sm-2 col-form-label">Chalan No. </label>

                  <div class="col-sm-6">

                        <input class="form-control" type="text" name="chalan_no" value="<?php echo $chalan['chalan_no']; ?>" id="chalan_no" autocomplete="off" readonly>

                  </div>

              </div>

              <div class="form-group row">

                  <label for="date" class="col-sm-2 col-form-label">Chalan Date. </label>

                  <div class="col-sm-6">

                        <input class="form-control " type="text" name="chalan_date" value="<?php echo date('d-m-Y', strtotime($chalan['chalan_date'])); ?>" id="date" autocomplete="off" readonly>

                  </div>

              </div>

         <div class="form-group row">
              <label for="prselect" class="col-sm-3 col-form-label"> Material</label>
               <label for="prselect" class="col-sm-3 col-form-label"> Price</label>
                <label for="exampleqty" class="col-sm-3 col-form-label">Quantity</label>
              <label for="exampleqty" class="col-sm-3 col-form-label"></label>
            </div>       
            
<?php 
      if(!empty($items)){
          foreach($items as $item){ ?>

             
           <div class="form-group row">
              <div class="col-sm-3">
                      <input type="text" class="form-control" value="<?=get_product_info($item['product_id'])['product_name']?>" readonly/>
                      <input type="hidden" name="type_id[]" value="<?=$item['id'];?>" />
                </div>
            <div class="col-sm-3">
                    <input type="number" value="<?=$item['price']?>" class="form-control" autocomplete="off" name="price[]" required/>
              </div>
             <div class="col-sm-3">
                  <input class="form-control" type="number" name="qty[]" value="<?php echo $item['qty']; ?>" id="exampleqty" placeholder="0"  autocomplete="off"  required>
            </div>
            <div class="col-sm-3"></div>
          </div>
           
   <?php } } ?> 
            <div class="form-group row">
            <label for="exampleqty" class="col-sm-9 col-form-label"></label>
            
             <div class="col-sm-2">
                  <button type="submit" class="btn btn-primary" id="submit_btn">Update</button>
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




            