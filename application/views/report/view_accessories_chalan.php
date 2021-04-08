<?php  $this->load->view('inc/header'); ?>

<section class="content-header">
    <h1> Accessories Chalan </h1>
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
                    <h3 class="box-title">Accessories Chalan</h3>
                   
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                     <div class="row">
                        <div class="col-sm-12">
                          <?php  
                          $chalan = $this->db->where('chalan_no',$chalan_no)->get('accessories_receive_chalan')->row_array();
                            $supplier = get_user_info_by_id($chalan['supplier_id'])
                           ?>


                              <h2>Date : <?=date('d-m-Y', strtotime($chalan['chalan_date']))?></h2>
                              <h2>Chalan No : <?=$chalan_no;?> </h2>
                              <h2>Supplier : <?=$supplier['full_name'].' :: '.$supplier['mobile'];?></h2>


                            <table class="table">
                                  <tr>
                                    <th>SL.</th>
                                    <th>Accessories</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                   </tr> 


                                <?php

                                  if($items->num_rows()>0){


                                    $total=0;
                                    $i=1;
                                      foreach($items->result_array() as $item){

                                        echo '<tr>';
                                        echo '<td>'.$i.'</td>';
                                        echo '<td>'.ucfirst(get_accessories_name($item['acc_id'])).'</td>';
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

                      </div>  

                  </div>
                  <!-- /.box-body -->
                </div>

            </div>

         </div>  

        </div>

    </div>

</section>



<?php  $this->load->view('inc/footer'); ?>




            