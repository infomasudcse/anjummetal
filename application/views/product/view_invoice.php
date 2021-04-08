<?php  $this->load->view('inc/header'); ?>
            

            <section class="content-header">
                <h1>
                    Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">dashboard</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xl-12 col-12 pr-0">
                        
                    </div>
                    <div class="col-xl-12 col-12 pr-0">
                        <div class="box box-body">
                            <section class="invoice printableArea">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            INVOICE
            <small class="pull-right">Date: <?=date('d-m-Y');?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6">
          From
          <address>
            <strong class="text-red">Anjum Metal Ind.</strong><br>
            123, abc <br>
            Dhaka,<br>
            Phone: (00) 123-456-7890<br>
            Email: info@anjummetal.com
          </address>
        </div>
     
        <div class="col-sm-6  text-right">
            <?php $buyer = get_user_info_by_id($buyer_id);?>
          To
          <address>
            <strong class="text-blue"><?=$buyer['full_name']?></strong><br>
            <?=$buyer['address'];?><br>
            <?=$buyer['mobile'];?><br>
            
          </address>
        </div>
    </div>
    <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-12">
            <div class="invoice-details row no-margin">
              <div class="col-md-12"><b>Invoice # <?=$memo;?></b></div>
             
            </div>
        </div>
      <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>              
              <th class="text-right">Quantity</th>
              <th class="text-right">Unit Cost</th>
              <th class="text-right">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; 
                    foreach ($this->cart->contents() as $items){
            ?>


            <tr>
              <td><?=$i;?></td>
              <td><?=$items['name']?></td>
              
              <td class="text-right"><?=$items['qty']?></td>
              <td class="text-right"><?=$items['price']?></td>
              <td class="text-right">Tk.<?=$this->cart->format_number($items['subtotal'])?></td>
            </tr>

          <?php } ?>      

            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row" style="">
        <!-- accepted payments column -->
        <div class="col-12 col-sm-6" >
            
         
         
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 text-right">
           
            <div class="total-payment">
                <h3><b>Total :</b>Tk.<?php echo $this->cart->format_number($this->cart->total()); ?></h3>
            </div>
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-12">
          <button id="print" class="btn btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
          
         
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
                        </div>
                        <!-- /.box -->
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('inc/footer');  $this->cart->destroy(); ?>
<script src="<?=base_url()?>assets/js/jquery.PrintArea.js"></script>
<script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("section.printableArea").printArea(options);
        });
    });
    </script>
            