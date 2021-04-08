<?php  $this->load->view('inc/header'); ?>         
<section class="content-header">
<h1>Report</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="#">Report</a></li>
</ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-xl-12 col-12 pr-0">
      
        <div class="box box-body">
            <div class="row">
                  <div class="col-sm-12">
                     <h2 style="text-align:center;">Report List</h2>
                    </div>
            </div>
             <div class="row" style="padding-bottom:40px;">
                <div class="col-sm-12">
                     <h5>Material Summary</h5>
                  </div>
                 <div class="col-sm-2"><a href="<?=base_url()?>report/material_buy_report_form" class="btn btn-block btn-default">Buy</a> </div>
            </div>


           <div class="row" style="padding-bottom:40px;">
                <div class="col-sm-12">
                     <h5>Product Summary</h5>
                  
                 </div>
                 <div class="col-sm-2"><a href="<?=base_url()?>report/production_report_form" class="btn btn-block btn-default">Production</a></div>
             </div> 
              <div class="row" style="padding-bottom:40px;">
                <div class="col-sm-12">
                     <h5>Expense Summary</h5>
                  
                 </div>
                 <div class="col-sm-2"><a href="<?=base_url()?>report/expense_report_form" class="btn btn-block btn-default">Expenses</a></div>
             </div> 
              <div class="row" style="padding-bottom:40px;">
                <div class="col-sm-12">
                     <h5>Sale Summary</h5>
                  
                 </div>
                 <div class="col-sm-2"><a href="<?=base_url()?>report/buyer_ladger_form" class="btn btn-block btn-default">Buyer Ladger</a></div>
             </div>  



             
        </div>
        <!-- /.box -->
    </div>

    

</div>
</section>

<?php  $this->load->view('inc/footer'); ?>

            