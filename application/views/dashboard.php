<?php  $this->load->view('inc/header'); ?>
<section class="content-header">
    <h1>    Dashboard</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active"><a href="#">dashboard</a></li>
    </ol>
    <style>
ul.demo {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
</style>
</section>

            <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xl-12 col-12 pr-0">
            <div class="">
                <?php 
                      $alert = $this->session->flashdata('alert');
                        $alert_type = $this->session->flashdata('alert_type');
                        
                    if($alert!=''){
                        echo '<div class="'.$alert_type.'">'.$alert.'</div>';
                    }
                ?>
            </div>
            <!-- /.box -->
        </div>
<div class="col-xl-12 col-12 pr-0">
   
  <div class="row">
        <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-orange">
            <span class="info-box-icon"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-number"><?=$advance?></span>
              <span class="info-box-text">Deposit</span>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

          <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-teal">
            <span class="info-box-icon"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-number"><?=$post?></span>
              <span class="info-box-text">Loan</span>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
          <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-gray">
            <span class="info-box-icon"><i class="fa fa-balance-scale"></i></span>

            <div class="info-box-content">
              <span class="info-box-number"><?=$rawBalance?></span>
              <span class="info-box-text">Factory Stock </span>
            
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-olive">
            <span class="info-box-icon"><i class="fa fa-balance-scale"></i></span>
            <div class="info-box-content">
              <span class="info-box-number"><?=$finishGBalance?></span>
              <span class="info-box-text">Godown Stock</span>
          
            </div>            
          </div>         
        </div>
        
       

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-grey">
            <span class="info-box-icon"><i class="fa fa-database"></i></span>
            <div class="info-box-content">
              <span class="info-box-number"><?=$autoG?></span>
              <span class="info-box-text">Auto Goods</span>
              
            </div>            
          </div>         
        </div>
        <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-grey">
            <span class="info-box-icon"><i class="fa fa-database"></i></span>
            <div class="info-box-content">
              <span class="info-box-number"><?=$finG?></span>
              <span class="info-box-text">Finish Goods</span>
             
            </div>            
          </div>         
        </div>
        <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-grey">
            <span class="info-box-icon"><i class="fa fa-database"></i></span>
            <div class="info-box-content">
              <span class="info-box-number"><?=$aluC?></span>
              <span class="info-box-text">Alu.Circle</span>
          
            </div>            
          </div>         
        </div>
         <div class="clearfix visible-sm-block"></div>
        <div class="col-xl-3 col-md-6 col">
          <div class="info-box bg-purple">
            <span class="info-box-icon"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-number"><?=$scredit?></span>
              <span class="info-box-text">Supplier Credit</span>
              
            </div>            
          </div>         
        </div>



        
      </div> 
    
    <!-- /.box -->
</div>  
<div class="col-xl-12 col-12 pr-0">
    <div class="box box-body">
      <!-- <h2>How the system is working</h2>
      <h5>Deposit</h5>
      <p>Total Deposit = Total amount of deposit by buyer </p>
      <h5>Loan</h5>
      <p>Total Loan = Total amount of loan by buyer</p>
      <h5>Factory Stock</h5>
      <p>Current Factory Stock = Total Raw Material Weight verified  - Total weight finish goods stock verified - Total Waste Weight verified .   </p>
      <h5>Godown Stock</h5>
      <p> Current Godown Stock  = Total weight finish goods Stock verified - total weight sale verified .</p>
      <h5>Supplier Credit</h5>
      <p>Supplier Credit = All Supplier Credit - All Supplier debit </p> -->


    </div>
    <!-- /.box -->
</div>      

    </div>
</section>

<?php  $this->load->view('inc/footer'); ?>

            