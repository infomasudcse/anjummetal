<?php  $this->load->view('inc/header'); ?>
            

            <section class="content-header">
                <h1>
                    Recycle  Material
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Recycle Material</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-10">
                      
                        <div class="row">
                            <div class="col-xl-12 col-12 pr-0">
                                <div class="">
                                    <?php 
                                            
                                            $alert = $this->session->flashdata('alert');
                                            $alert_type = $this->session->flashdata('alert_type');
                                            
                                        if($alert!=''){
                                            echo '<div class="'.$alert_type.'">'.$alert.'</div>';
                                        }

                                        if(isset($error) && !empty($error)){
                                            echo '<div class="alert alert-danger">'.$error.'</div>';
                                        }
                                    ?>
                                </div>
                                <!-- /.box -->
                            </div>
                          
                    <div class="col-sm-12">
                       <div class="box box-body">
                         <table id="recycle_table" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Material</th>
                                        <th>Recycled</th>
                                        <th>From Waste</th>
                                        <th>Unuseable Waste</th>
                                        <th>Uncountable</th>
                                        <th>Action</th>
                                      
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Material</th>
                                        <th>Recycled</th>
                                        <th>From Waste</th>
                                        <th>Unuseable Waste</th>
                                        <th>Uncountable</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </tfoot>
                        </table>
                      </div>

                    </div>
                </div>



                




            </section>

<?php  $this->load->view('inc/footer'); ?>
<script>
  
$(document).ready(function(){

  $('#recycle_table').DataTable({
      "ajax": url+'view/getRecycle'
  });

});

</script>
            


