<?php  $this->load->view('inc/header'); ?>          

<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker.css"/>


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
                                     <h3>Expense Report </h3>
                                     <h4>From: <?=date('d-m-Y', strtotime($from))?></h4>
                                      <h4>To: <?=date('d-m-Y', strtotime($to))?></h4>
                                 </div>
                             </div>   
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>Date</th>
                                    <th>Expense Type</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                </tr>
                                </thead>
                                
                                
                                <?php
                                      
                                       $tot_qty=0;
                                       
                                        if($sql->num_rows()> 0){
                                            foreach($sql->result_array() as $row){
                                               
                                              
                                                $tot_qty += floatval($row['amount']);
                                                ?>
                                                    <tr>
                                                        <td><?=date('d-m-Y', strtotime($row['created_at']))?></td>
                                                        <td><?=get_material_type_name($row['expense_type_id'])?></td>
                                                        <td><?=$row['amount']?></td>
                                                         <td><?=$row['note']?></td>
                                                    </tr>
                                                
                                                <?php
                                            }
                                        }
                                
                                
                                ?>
                                <tr style="background-color: #f4f4f6; font-weight: bold;font-size: 16px;"><td>Total:</td><td></td><td><?php echo number_format($tot_qty,2)?></td><td></td><td></td><td></td></tr>
                                
                                
                            </table>
                        </div>
                        <!-- /.box -->
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('inc/footer'); ?>


<script type="text/javascript">
  


    $(document).ready(function(){
       
     

       

      

    });
    
    
</script>

            