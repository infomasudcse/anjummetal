<?php  $this->load->view('workstationone/inc/header'); ?>
<style>.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    
    background-color: #dbdffd;</style>

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
                     

                    <div class="box box-default">
                        <div class="box-body">
                                <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Raw Material</span></a> </li>
                            <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Spare Parts</span></a> </li> -->
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ion-email"></i></span> <span class="hidden-xs-down">Finish Products</span></a> </li>
                          </ul>
                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                              <div class="pad">
                                <h3>Raw Material Chalan</h3>
                                <table class="table" id="material_table" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>SL.</th>
                                        <th>Chalan Date</th>
                                        <th>Chalan No.</th>
                                        <th>Supplier</th>
                                        <th>Tot.Weight</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                </table>
                                
                              </div>
                            </div>
                            <!-- <div class="tab-pane pad" id="profile" role="tabpanel" >
                              <div class="pad">
                                <h3>Spare Parts Chalan</h3>
                                <table class="table" id="spare_parts_table" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>SL.</th>
                                        <th>Chalan Date</th>
                                        <th>Chalan No.</th>
                                        <th>Supplier</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                </table>
                                
                              </div>
                            </div> -->
                            <div class="tab-pane pad" id="messages" role="tabpanel">
                              <div class="pad">
                                <h3>Finish Products Chalan</h3>
                                <table class="table" id="delivery_goods" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>SL.</th>
                                        <th>Chalan Date</th>
                                        <th>Chalan No.</th>
                                
                                        <th>Status</th>
                                        <th>Action</th>
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



<?php  $this->load->view('workstationone/inc/footer'); ?>

<script>
  
var material_table ='';

//var spare_parts_table='';
var delivery_goods ='';

$(document).ready(function(){
  

 material_table = $("#material_table").DataTable({ 'ajax' : url+'workstationone/material_table'});
 //spare_parts_table = $("#spare_parts_table").DataTable({ 'ajax': url+'workstationone/spare_parts_table'});
 delivery_goods = $("#delivery_goods").DataTable({ 'ajax': url+'workstationone/delivery_goods'});



});

</script>




            