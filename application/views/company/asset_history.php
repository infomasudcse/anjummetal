<?php  $this->load->view('inc/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker.css"/>      
<style>
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{background-color:#398bf794;}
  .form-horizontal{padding:30px;}
  .history_block{border: 1px solid #ccc;
    margin: 5px;
    padding: 5px;}
    h4{color:red;text-align:center;}
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
                   
                    <h3>Asset History</h3>
                     <?php
                   
                      if($sql->num_rows() == 1){
                        $row = $sql->row_array();                     
                          $this->db->where('asset_id', $id)->order_by('id','desc');

                          $qu = $this->db->get('assets_edit_note');
                          
                      ?>
                      <h4>Asset Primary Information </h4>
                      <p>        Asset Name : <?=$row['name']?>  </p>
                      <p>        Asset Cost : <?=$row['cost']?>  </p>
                      <p>        Asset Quantity : <?=$row['qty']?>  </p>
                      <p>        Asset Description : <?=$row['description']?>  </p>
                      <p>        Asset Updated : <?=$row['created_at']?>  </p>

                      <h4>Asset Update History</h4>

                      <?php

                          if($qu->num_rows() > 0){

                            foreach($qu->result_array() as $note){
                              echo '<p class="history_block">'.date('d-m-Y H:i a', strtotime($note['created_at'])).' : <br/> '.$note['note'].'</p>';

                            }

                          }else{
                            echo '<div class="alert alert-warning">No Edit History Found </div>';
                          }



                       }else{ echo 'Assets Error ! Try Again . ';}?>
                     
                  </div>
                  <!-- /.box-body -->
                </div>

            </div>

         </div>  

        </div>

    </div>

</section>



<?php  $this->load->view('inc/footer'); ?>

 <script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
<script>
  
$(document).ready(function(){

   $('.datepicker').datepicker({
        'format':'dd-mm-yyyy'
   });

   $('#asset_table').DataTable({
      'ajax': '<?=base_url()?>view/getAllAssets'
   });
 
});

</script>




            