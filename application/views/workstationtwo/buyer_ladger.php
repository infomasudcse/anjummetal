<?php  $this->load->view('workstationtwo/inc/header'); ?>
<style>
    .table>tbody>tr>td{padding:0.5rem;}
</style>
<section class="content-header">
    <h1>Buyer Ladger</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Buyer</a></li>
    </ol>
</section>
  <!-- Main content -->

<section class="content">

    <div class="row">

        <div class="col-sm-12"><button class="btn btn-info btn-sm float-right" onClick="print_this('printarea')">Print</button></div>

        <div class="col-xl-12 col-12 pr-0"  id="printarea" >
            <div class="box box-body"> 
                <div class="row">
                    <div class="col text-center" style="text-align:center;">                             
                            <h2><?=$buyer['full_name']?></h2>
                            <h4><?=$buyer['mobile']?></h4>
                            <h4><?=$buyer['address']?></h4>
                            <h4> </h4>
                           
                    </div>
                </div>        

                <table id="" class="display table table-bordered" cellspacing="0" width="100%" style="text-align:center;">

                    <thead>
                        <tr>
                           
                            <th>Date</th>
                            <th>Description</th>
                            <th>Chalan</th>
                            <th>Credit</th>                                   
                            <th>Debit</th>
                            <th>Balance</th>
                        </tr>
                    </thead>

                    <?php
                        if(!empty($accounts)){
                            $summary = 0;
                            foreach($accounts as $account){
                                echo '<tr>';
                                
                                echo '<td>'.date('d-m-Y', strtotime($account['payment_date'])).'</td>';
                                echo '<td>'.$account['purpose'].'/'.$account['type'];
                                if($account['details']!=null){
                                    $info = json_decode($account['details']);
                                    echo '<br/>'.$info->bank.' / '.$info->cheque.' / '.date('d-m-Y',strtotime($info->cdate));
                                }
                                echo '</td>';


                                echo '<td>'.$account['chalan_no'].'</td>';
                                echo '<td>'.$account['credit'].'</td>';
                                echo '<td>'.$account['debit'].'</td>';
                                $balance = floatval($account['credit']) - floatval($account['debit']);
                                $summary += $balance;
                                echo '<td>'.$summary.'</td>';
                                echo '</tr>';

                            }

                        }else{
                            echo '<tr><td colspan="7">No record Found ! </td></tr>';
                        }
                    ?>


            </table>

            </div>

            <!-- /.box -->

        </div>

    </div>

</section>
<?php  $this->load->view('workstationtwo/inc/footer'); ?>



            