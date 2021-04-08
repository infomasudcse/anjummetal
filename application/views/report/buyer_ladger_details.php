<?php 


 $this->load->view('inc/header'); 

$buyer = get_user_info_by_id($bid);
 ?>          


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
                                     <h3>Name: <?=$buyer['full_name']?> </h3>
                                      <h4>Address: <?=$buyer['address']?> </h4>
                                       <h4>Mobile: <?=$buyer['mobile']?> </h4>
                                     
                                 </div>
                                 <div class="col-sm-6" style="text-align:right;">
                                     <h3>Details Period :  </h3>
                                     <h4>From: <?=date('d-m-Y', strtotime($from))?></h4>
                                      <h4>To: <?=date('d-m-Y', strtotime($to))?></h4>
                                 </div>
                             </div>   
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>Date</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Purpose</th>
                                </tr>
                                </thead>
                                
                                
                                <?php
                                      
                                       $tot_debit=0;
                                       $tot_credit=0;
                                       
                                        if($sql->num_rows()> 0){
                                            foreach($sql->result_array() as $row){
                                               
                                              
                                                $tot_debit += floatval($row['debit']);
                                                $tot_credit += floatval($row['credit']);
                                                
                                                ?>
                                                    <tr>
                                                        <td><?=date('d-m-Y', strtotime($row['create_at']))?></td>
                                                        <td><?=$row['debit']?></td>
                                                        <td><?=$row['credit']?></td>
                                                         <td><?=$row['purpose']?></td>
                                                    </tr>
                                                
                                                <?php
                                            }
                                        }
                                
                                
                                ?>
                                <tr style="background-color: #f4f4f6; font-weight: bold;font-size: 16px;"><td>Total:</td><td><?php echo number_format($tot_debit,2)?></td><td><?php echo number_format($tot_credit,2)?></td><td></td></tr>
                                
                                
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

            