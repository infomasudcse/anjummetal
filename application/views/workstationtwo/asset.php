<?php  $this->load->view('workstationtwo/inc/header'); ?>
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
                ?>
            </div> 
        </div>
        <div class="col-xl-12 col-12 pr-0">
          <div class="row">
            <div class="col-sm-12">
             <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">Assets</h3>
                   
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-expanded="true"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">All Assets</span></a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Add New</span></a> </li>
                
              </ul>
              <!-- Tab panes -->
              <div class="tab-content tabcontent-border">
                <div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">
                  <div class="pad">
                    <h3>Assets</h3>
                      <table class="table" id="asset_table">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Assets Name</th>
                            <th>Qty</th>
                            <th>Cost</th>
                            <th>Description</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        
                      </table>
                  </div>
                </div>
                <div class="tab-pane pad" id="profile" role="tabpanel" aria-expanded="false">
                    <div class="pad">
                    <h3>New Assets</h3>
                     <?php echo form_open('workstationtwo/assets', array("class"=>"form-horizontal")); ?>
                        <div class="box-body">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">Assets Name</label>

                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Assets Name." required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 control-label">Quantity</label>

                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="inputPassword3" name="qty" placeholder="0" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="cost" class="col-sm-2 control-label">Unit Cost</label>

                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="cost" name="cost" placeholder="0" />
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="desc" class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="desc" placeholder="description" name="desc">
                            </div>
                          </div>
                           <div class="form-group row">
                            <label for="dat" class="col-sm-2 control-label">Date</label>

                            <div class="col-sm-10">
                              <input type="date" class="form-control datepicker" id="dat" placeholder="<?=date('d/m/Y')?>" name="date" required>
                            </div>
                          </div>
                         
                        </div>
         
                        <div class="box-footer">
                         
                          <button type="submit" class="btn btn-info pull-right">Save</button>
                        </div>
                      
                      </form>
                  </div>

                </div>
               
              </div>
                  </div>
                  <!-- /.box-body -->
                </div>

            </div>

         </div>  

        </div>

    </div>

</section>



<?php  $this->load->view('workstationtwo/inc/footer'); ?>
<script>
  
$(document).ready(function(){

  

   $('#asset_table').DataTable({
      'ajax': '<?=base_url()?>workstationtwo/getAllAssets'
   });
 
});

</script>




            