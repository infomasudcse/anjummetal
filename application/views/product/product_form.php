<?php  $this->load->view('inc/header'); ?>
            
<section class="content-header">
  <h1>PRODUCT</h1>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="breadcrumb-item active"><a href="#">Product</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xl-12 col-12 pr-0">
        <div class="">
            <?php 
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
                     <h3>Add New Product</h3>
                 </div>
                 <div class="col-sm-6">
                     <a href="<?=base_url('view/product')?>" class="btn pull-right btn-sm btn-primary">View All</a>
                 </div>
             </div>

             <div class="row">
                <div class="col-sm-10">

            <?php
                    echo form_open('new_add/product', array('class'=>'form form-horizontal'));

            ?>
           
            
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">Select Product Type</label>
              <div class="col-sm-10">
                
                    <?php
                        if(!empty($product_type)){
                          echo '<select class="form-control" name="ptype" id="ptype" required>';
                          foreach($product_type as $type){
                              echo '<option value="'.$type['product_type_id'].'">'.$type['type_name'].'</option>';
                          }

                          echo '</select>';

                        }else{
                          echo "<div class='alert alert-warning'>Set Product type first ! </div>";
                        }
                    ?>
                 
              </div>
            </div>
           <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">Product Name</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="name" value="<?php echo set_value('name'); ?>" id="name" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">Weight</label>
              <div class="col-sm-10">
                <input class="form-control" type="number" step="0.01" name="weight" value="<?php echo set_value('name'); ?>" id="weight" placeholder="0.00">
                <span class="help-text">In Kg</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
            </div>

         </form>

       </div>
     </div>
        </div>
        <!-- /.box -->
    </div>

      

  </div>
</section>

<?php  $this->load->view('inc/footer'); ?>

            