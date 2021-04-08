<?php  $this->load->view('inc/header'); ?>       

<section class="content-header">
    <h1>
        Report  
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Report </a></li>
    </ol>
</section>

            <!-- Main content -->
<section class="content">
  <div class="row">
     
      <div class="col-xl-12 col-12 pr-0">
         
          <div class="box box-body">
              <div class="row">
                   <div class="col-sm-12" style="padding-bottom:30px;">
                       <h3 class="text-center">Anjum Metal Ind.</h3>
                       <h4 class="text-center">Pilkuni, Fatulla, Narayanganj.</h4>
                       <hr/>
                       <h4  class="text-center">Raw Material  Report </h4>
                       
                   </div>
                  <div class="col-sm-6">
                     <?php if($from!='' && $to!=''){ ?>
                       <h4>From: <?=date('d-m-Y', strtotime($from))?></h4>
                        <h4>To: <?=date('d-m-Y', strtotime($to))?></h4>
                      <?php } ?>  
                   </div>
               </div>   
              <table class="table table-bordered">
                  <thead>
                      <tr>
                      <th>Date</th>
                      <th>Supplier</th>
                      <th>Material</th>
                      <th>Quantity</th>                    
                      <th>Unit Price</th>
                      <th style="text-align:right:">Subtotal</th>
                  </tr>
                  </thead>                 
                  <?php                       
                     
                     if(strcmp($report_type,'total')===0){
                         if($sql->num_rows()== 1){
                            $total = $sql->row_array()['total'];
                            $tot_qty=$sql->row_array()['tot_qty'];
                          }
                     }else{   

                         $total = 0;
                         $tot_qty=0;
                         
                          if($sql->num_rows()> 0){
                              foreach($sql->result_array() as $row){                                  
                                  $total += floatval($row['subtotal']);
                                  $tot_qty += floatval($row['quantity']);
                                  ?>
                                      <tr>
                                          <td><?=date('d-m-Y', strtotime($row['create_at']))?></td>
                                          <td><?=get_user_info_by_id($row['supplier_id'])['full_name']?></td>
                                          <td><?=get_material_type_name($row['material_id'])?></td>
                                          <td><?=$row['quantity']?></td>                                      
                                            <td><?=$row['price']?></td>
                                          <td><?=$row['subtotal']?></td>    
                                      </tr>                                  
                                  <?php
                              }
                          }
                        }                
                  
                  ?>
                  <tr style="background-color: #f4f4f6; font-weight: bold;font-size: 16px;"><td>Total:</td><td></td><td><?=$tot_qty?></td><td></td><td><?=number_format($total,2);?></td></tr>
                  
                  
              </table>
          </div>
          <!-- /.box -->
      </div>

      

  </div>
</section>

<?php  $this->load->view('inc/footer'); ?>

            