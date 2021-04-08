<?php  $this->load->view('inc/header'); ?>
      
<style>
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{background-color:#398bf794;}
  .form-horizontal{padding:30px;}
</style>
<section class="content-header">
    <h1> ASSETS </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Assets </a></li>
    </ol>
</section>
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

                    $this->db->where('id', $id);
                    $sql = $this->db->get('assets');

                ?>
            </div> 
        </div>
        <div class="col-xl-12 col-12 pr-0">
          <div class="row">
            <div class="col-sm-12">
             <div class="box box-default">                 
                 
                  <div class="box-body">
                   
                    <h3>Edit Assets</h3>
                     <?php
                      echo form_open('edit/assets', array("class"=>"form-horizontal"));
                      if($sql->num_rows() == 1){

                        $row = $sql->row_array();
                      

                      ?>

                      <input type="hidden" name="edit_id" value="<?=$id?>" />
                        <div class="box-body">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">Assets Name</label>

                            <div class="col-sm-10">
                              <input type="text" class="form-control" value="<?=$row['name']?>" id="inputEmail3" name="name" placeholder="Assets Name." required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 control-label">Quantity</label>

                            <div class="col-sm-10">
                              <input type="number" class="form-control" value="<?=$row['qty']?>" id="inputPassword3" name="qty" placeholder="0" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="cost" class="col-sm-2 control-label">Cost</label>

                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="cost" value="<?=$row['cost']?>" name="cost" placeholder="0" />
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="desc" class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="desc" value="<?=$row['description']?>"  placeholder="description" name="desc">
                            </div>
                          </div>
                           <div class="form-group row">
                            <label for="dat" class="col-sm-2 control-label">Date</label>

                            <div class="col-sm-10">
                              <input type="date" class="form-control" id="dat" value="<?=date('d-m-Y', strtotime($row['created_at']))?>" placeholder="<?=date('d-m-Y')?>" name="date" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="note" class="col-sm-2 control-label">Note</label>

                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="note" placeholder="Note" name="note">
                            </div>
                          </div>
                        </div>
         
                        <div class="box-footer">
                         
                          <button type="submit" class="btn btn-info pull-right">Update</button>
                        </div>
                      <?php }else{ echo 'Assets Error ! Try Again . ';}?>
                      </form>
                  
                  </div>
                  <!-- /.box-body -->
                </div>

            </div>

         </div>  

        </div>

    </div>

</section>



<?php  $this->load->view('inc/footer'); ?>

<script>
  
$(document).ready(function(){

   $('#asset_table').DataTable({
      'ajax': '<?=base_url()?>view/getAllAssets'
   });
 
});

</script>




            