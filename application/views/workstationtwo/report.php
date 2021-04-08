<?php  $this->load->view('workstationtwo/inc/header'); ?>
<style>.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {    
    background-color: #dbdffd;</style>
<section class="content-header">
    <h1>Report</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Report </a></li>
  </ol>

</section>
            <!-- Main content -->

<section class="content">

    <div class="row">
         

        <div class="box box-default">
            <div class="box-body">
                    <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
               <!--  <li class="nav-item"> 
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab"> <span class="hidden-xs-down">Receive Goods Chalans</span></a>
               </li> -->
                <li class="nav-item"> 
                  <a class="nav-link active" data-toggle="tab" href="#profile" role="tab"><span class="hidden-xs-down">Sales</span></a>
                </li>
                <li class="nav-item"> 
                  <a class="nav-link" data-toggle="tab" href="#payment" role="tab"><span class="hidden-xs-down">Payments</span></a>
                </li>
                <li class="nav-item"> 
                  <a class="nav-link" data-toggle="tab" href="#buyer" role="tab"><span class="hidden-xs-down">Buyers</span></a>
                </li>
               
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
               <!--  <div class="tab-pane active" id="home" role="tabpanel">
                  <div class="pad">
                    <h3>Receive Chalans</h3>
                    <table class="table" id="receive_goods_chalan" style="width:100%">
                        <thead>
                          <tr>
                            <th>SL.</th>
                            <th>Chalan Date</th>
                            <th>Chalan No.</th>
                            <th>Supplier</th>
                            <th>Status</th>
                            
                          </tr>
                        </thead>
                    </table>
                    
                  </div>
                </div> -->
                <div class="tab-pane active" id="profile" role="tabpanel" >
                  <div class="pad">
                    <h3>Sales Invoice</h3>
                    <table class="table" id="sales_chalan" style="width:100%">
                        <thead>
                          <tr>
                            <th>SL.</th>
                            <th>Invoice Date</th>
                            <th>Invoice No.</th>
                            <th>Buyer</th>
                            <th>Amount</th>
                            <th>Weight</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                    </table>
                    
                  </div>
                </div>
                <div class="tab-pane" id="payment" role="tabpanel" >
                  <div class="pad">
                    <h3>Payments</h3>
                    <table class="table" id="payment_table" style="width:100%">
                        <thead>
                          <tr>
                            <th>SL.</th>
                            <th>Date</th>
                            <th>Buyer</th>
                            <th>Type</th>
                            <th>Amount</th>                            
                          </tr>
                        </thead>
                    </table>
                    
                  </div>
                </div>
                 <div class="tab-pane" id="buyer" role="tabpanel" >
                  <div class="pad">
                    <h3>Buyer List</h3>
                    <table class="table" id="buyer_table" style="width:100%">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Balance</th>
                            <th>Status</th>                            
                          </tr>
                        </thead>
                    </table>
                    
                  </div>
                </div>
               
               
              </div>
                  </div>
          

        </div>


    </div>

</section>



<?php  $this->load->view('workstationtwo/inc/footer'); ?>

<script>
  
var sales_chalan ='';
var payment_table = '';
var buyer_table = '';
//var receive_goods_chalan='';

$(document).ready(function(){
//receive_goods_chalan = $("#receive_goods_chalan").DataTable({ 'ajax': url+'workstationtwo/receive_goods_chalan'});

sales_chalan = $("#sales_chalan").DataTable({ 'ajax': url+'workstationtwo/sales_chalan'});
payment_table = $("#payment_table").DataTable({ 'ajax': url+'workstationtwo/buyer_payments'});

buyer_table = $("#buyer_table").DataTable({ 'ajax': url+'workstationtwo/buyer_table'});

});

</script>




            