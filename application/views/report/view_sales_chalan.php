<?php  $this->load->view('inc/header'); ?>

<section class="content-header">
    <h1> Sales Chalan </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">chalans </a></li>
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
              <h3 class="box-title  float-right"><a href="<?=base_url().'Delete/delete_sale_chalan/'.$chalan['id']; ?>" onClick="return confirm('Are Your sure to delete ? ')" class="btn btn-default btn-sm">Delete</a></h3>   
            </div>
              <!-- /.box-header -->
              <?php

                    $customer = get_user_info_by_id($chalan['buyer_id']);
                    $seller = get_user_info_by_id($chalan['operator_id']);
              ?>
              <div class="box-body">
                <div class="row">
                  <div class="col-xl-12 col-12 pr-0 text-center">
                        <div class="">
                            <h2>Anjum Metal Ind.</h2>
                            <h4> Sale Chalan </h4>
                        </div>
                    </div>
                    <div class="col-xl-12 col-12 ">
                        
                        <div class="row">
                            <div class="col"><hr/></div>                          
                        </div>
                        <div class="row">
                            <div class="col">Chalan No: <b><?=$chalan['chalan_no'];?></b> </div>
                            <div class="col text-right">Date: <b><?=date('d-m-Y', strtotime($chalan['chalan_date']))?></b>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col">
                              Buyer: <b><?=$customer['full_name']?></b><br/> Phone:<b> <?=$customer['mobile']?></b>
                               </div>
                            <div class="col text-right">Sale: <b><?=ucwords($seller['username'])?></b>
                            </div>                            
                        </div>
                        
                        <div class="row">
                            <div class="col"><hr/></div>                          
                        </div>
                    </div>


                  <div class="col-sm-12">
                 
                 
                <table class="table">
                <tr>
                  <th>SL.</th>
                  <th>Product</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Subtotal</th>
                 </tr> 
              <?php

             if(!empty($items)){

              $total=0;
              $i=1;
                foreach($items as $item){

                  echo '<tr>';
                  echo '<td>'.$i.'</td>';
                  echo '<td>'.get_product($item['product_id'])['product_name'].'</td>';
                  echo '<td>'.$item['qty'].' '.$item['unit'].'</td>';
                  echo '<td>'.$item['price'].'</td>';
                  echo '<td>'.$item['subtotal'].'</td>';
                  echo '</tr>';
                  $i++;
                  $total += floatval($item['subtotal']);

                }
                echo '<tr><td></td><td></td><td></td><td>Total</td><td>'.number_format($total,'2').'</td></tr>';

                }else{
                  echo '<tr><td colspan="5"> No Information About this Chalan No . </td></tr>';
                }
               ?>
                 </table>   
              </div>

              <div class="col-sm-12 text-center">

                   <h3>Other Exp: <?php echo $chalan['other_expense']; ?> </h3>
                  <h3>Discount : <?php echo $chalan['discount']; ?></h3>
                  <h3>Total : <?php echo $chalan['total']; ?></h3>
              </div>
            </div>  
         </div>
       </div>
     </div>
   </div>  
  </div>
</div>

</section>



<?php  $this->load->view('inc/footer'); ?>




            