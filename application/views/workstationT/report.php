<?php  $this->load->view('workstationtwo/inc/header'); ?>
<style>.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    
    background-color: #dbdffd;</style>

            <section class="content-header">

                <h1>

                   Chalan Report

                </h1>

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
                            <li class="nav-item"> 
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab"> <span class="hidden-xs-down">Accessories</span></a>
                           </li>
                            <li class="nav-item"> 
                              <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-xs-down">Receive Spare Parts</span></a>
                               </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"> <span class="hidden-xs-down">Delivery Scrab</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#product" role="tab"> <span class="hidden-xs-down">Delivery Product</span></a> </li>
                          </ul>
                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                              <div class="pad">
                                <h3>Accessories</h3>
                                <table class="table" id="accessories_table" style="width:100%">
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
                            </div>
                            <div class="tab-pane pad" id="profile" role="tabpanel" >
                              <div class="pad">
                                <h3>Receive Spare Parts</h3>
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
                            </div>
                            <div class="tab-pane pad" id="messages" role="tabpanel">
                              <div class="pad">
                                <h3>Delivery Scrabs</h3>
                                <table class="table" id="delivery_scrab" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>SL.</th>
                                        <th>Chalan Date</th>
                                        <th>Chalan No.</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        
                                      </tr>
                                    </thead>
                                </table>
                                
                              </div>
                            </div>

                            <div class="tab-pane pad" id="product" role="tabpanel">
                              <div class="pad">
                                <h3>Delivery Product</h3>
                                <table class="table" id="product_chalans" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>SL.</th>
                                        <th>Chalan Date</th>
                                        <th>Chalan No.</th>
                                        <th>Customer</th>
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
  
var accessories_table ='';
var receive_goods_chalan='';
var delivery_scrab ='';
var product_chalans='';
$(document).ready(function(){
  

 accessories_table = $("#accessories_table").DataTable({ 'ajax' : url+'workstationtwo/accessories_table'});
 receive_goods_chalan = $("#receive_goods_chalan").DataTable({ 'ajax': url+'workstationtwo/receive_goods_chalan'});
 delivery_scrab = $("#delivery_scrab").DataTable({ 'ajax': url+'workstationtwo/delivery_scrab_table'});
 product_chalans = $("#product_chalans").DataTable({ 'ajax': url+'workstationtwo/product_chalans'});



});

</script>




            