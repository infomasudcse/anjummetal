<?php  $this->load->view('inc/header'); ?>          
<style> .table>tbody>tr>td, .table>thead>tr>th{ padding:0.50rem; }</style>
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
                         <h3 style="text-align:center;">Anjum Metal Ind.</h3>
                         <h4  style="text-align:center;">Pilkuni, Fatulla, Narayanganj.</h4>
                     </div>
                    <div class="col-sm-6">
                         <h3>Report </h3>
                         <h4>From: <?=date('d-m-Y', strtotime($from))?></h4>
                          <h4>To: <?=date('d-m-Y', strtotime($to))?></h4>
                     </div>
                 </div> 

                 <?php 
                    $totQty = 0;
                    $totWeight = 0;

                 ?>

                
                <h3>Sale</h3>
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Chalan</th>
                        <th>Name</th>
                        <th>Product Type</th>
                        <th>Qty</th>
                        <th>Weight</th>                      
                    </tr>
                    </thead>
                    <?php
                                               
                    if($sale->num_rows()> 0){
                        foreach($sale->result_array() as $row){                      
                           
                            $totWeight += floatval($row['weight']);
                            $totQty += floatval($row['qty']);
                            ?>
                            <tr>
                                <td><?=date('d-m-Y', strtotime($row['create_at']))?></td>
                                <td><?=$row['chalan_no']?></td>
                                <td><?=get_product_info($row['product_id'])['product_name']?></td>
                                <td><?=get_product_type_name($row['product_type_id'])?></td>
                                <td><?=$row['qty']?></td>
                                <td><?=$row['weight']?></td>
                            </tr>
                            
                            <?php
                        }
                    }
                    
                    
                    ?>
                </table>

                 <h2 class="text-center">Total Quantity: <?=$totQty?></h2>
                <h2 class="text-center">Total Weight: <?=$totWeight?></h2>

            </div>
            <!-- /.box -->
        </div>

        

    </div>
</section>

<?php  $this->load->view('inc/footer'); ?>


            