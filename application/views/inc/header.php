<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">
    <?php 
            if(!isset($title)){
                    $title= 'Dashboard';   
            }
            if(!isset($subtitle)){
                    $subtitle= '';
            }
            if(!isset($error)){
                    $error= '';   
            }
?>
    <title> <?=$title;?> </title>

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="<?=base_url()?>assets/plugin/bootstrap/css/bootstrap.min.css">

    <!-- Bootstrap 4.0-->
   <!-- <link rel="stylesheet" href="<?=base_url()?>assets/plugin/bootstrap/css/bootstrap-extend.css">-->
   <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.dataTables.min.css"/>
 

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/master_style.css">

    <!-- MinimalPro Admin Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/skins/_all-skins.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/stylesheet.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
      .action{ margin:0px 2px; }
  </style>


</head>

<?php $user = $this->session->userdata('user_info') ; ?>

<body class="hold-transition skin-red-light sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?=base_url('view')?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <b class="logo-mini">
                  <span class="light-logo"><img src="<?=base_url()?>assets/images/aries-light.png" alt="logo"></span>
                  <span class="dark-logo"><img src="<?=base_url()?>assets/images/aries-dark.png" alt="logo"></span>
                </b>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                  <img src="<?=base_url()?>assets/images/aries-light.png" alt="logo" class="light-logo">
                    <img src="<?=base_url()?>assets/images/aries-dark.png" alt="logo" class="dark-logo">
                </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class='user-menu'><p style="padding: 12px;color: #fff;font-size: 22px;">Branch: <?=get_branch_name($user['branch_id']);?></p></li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?=base_url()?>assets/images/default.jpg" class="user-image rounded-circle" alt="User Image">
                            </a>
                            <ul class="dropdown-menu scale-up">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?=base_url()?>assets/images/default.jpg" class="float-left rounded-circle" alt="User Image">

                                    <p>
                                        Admin
                                        <small class="mb-5"></small>
                                        <a href="<?=base_url()?>authentication/logout" class="btn btn-danger btn-sm btn-rounded">Logout</a>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="row no-gutters" style="padding-top:15px;">
                                       <div role="separator" class="divider col-12"></div>
                                        <div class="col-12 text-left">
                                            <a href="<?=base_url()?>authentication/logout"><i class="ion ion-settings"></i> Logout</a>
                                        </div>
                                        <div role="separator" class="divider col-12"></div>
                                       
                                        
                                    </div>
                                    <!-- /.row -->
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                    <?php $user_info = $this->session->userdata('user_info');?>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="user-profile ">
                        <a href="<?=base_url('view/index');?>">
                          <span class="profile_txt"><?=$user_info['full_name']?></span>
                          
                        </a>
                    </li>
                    <li class="<?=(($title=='Dashboard')?'active':'')?>">
                        <a href="<?=base_url('view')?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>


                     <li class="treeview <?=(($title=='workstationone')?'active':'')?>">
                        <a href="#">
                            <i class="fa fa-industry"></i>
                            <span>Workstation One</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?=(($subtitle=='material')?'active':'')?>">
                                    <a href="<?=base_url('report/material_receive_chalans')?>">
                                        <i class="fa fa-file"></i>
                                        <span>Raw Materials Chalans</span>                            
                                    </a>                        
                            </li>
                          
                           

                           <!--  <li class="">
                                <a href="base_url('report/chalans/spare_parts_chalans/spare_parts_chalan')?>">
                                    <i class="fa fa-file"></i>
                                    <span>Spare Parts Chalans</span>                            
                                </a>                        
                            </li>
 -->
                            <li class="<?=(($subtitle=='finishGoods')?'active':'')?>">
                                <a href="<?=base_url('report/finish_goods_chalans')?>">
                                    <i class="fa fa-file"></i>
                                    <span>Finish Goods Chalans</span>                            
                                </a>                        
                            </li>
                             <li class="<?=(($subtitle=='waste')?'active':'')?>">
                                    <a href="<?=base_url('report/wasteView')?>">
                                        <i class="fa fa-circle-thin"></i>
                                        <span>Waste</span>                            
                                    </a>                        
                            </li>

                           
                        </ul>
                    </li>
                     <!-- <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Workstation Two</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                             <li class="">
                                    <a href="=base_url('report/chalans/accessories_chalans/accessories_receive_chalan')?>">
                                        <i class="fa fa-file"></i>
                                        <span>Accessories chalans</span>                            
                                    </a>                        
                                </li>
                                <li class="">
                                    <a href="=base_url('report/chalans/Receive_Circle_chalans/goods_receive_chalan/2')?>">
                                        <i class="fa fa-file"></i>
                                        <span>Receive Spare Parts</span>                            
                                    </a>                        
                                </li>
                                <li class="">
                                    <a href="=base_url('report/chalans/delivery_scrab/scrab_delivery_chalan/2')?>">
                                        <i class="fa fa-file"></i>
                                        <span>Delivery Scrab chalan</span>                            
                                    </a>                        
                                </li>

                            <li class="">
                                <a href="=base_url('report/chalans/delivery_chalans/product_sale_chalan/2')?>">
                                    <i class="fa fa-file"></i>
                                    <span>Delivery Finish Goods Chalans</span>                            
                                </a>                        
                            </li>

                           
                        </ul>
                    </li> -->

                     <li class="treeview <?=(($title=='workstationtwo')?'active':'')?>">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Workstation Two</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                               <li class="<?=(($subtitle=='Sales')?'active':'')?>">
                                    <a href="<?=base_url('report/sale_chalans')?>">
                                        <i class="fa fa fa-circle-thin"></i>
                                        <span>Sale Invoices</span>                            
                                    </a>                        
                            </li> 

                            <!--  <li class="">
                                    <a href="=base_url('report/chalans/product_receive_chalans/goods_receive_chalan/3')?>">
                                        <i class="fa fa-file"></i>
                                        <span>Receive Chalans</span>                            
                                    </a>                        
                            </li> -->

                            <!-- <li class="">
                                <a href="=base_url('report/chalans/cash_memo/product_sale_chalan/3')?>">
                                    <i class="fa fa-file"></i>
                                    <span>Cash Memo's</span>                            
                                </a>                        
                            </li> -->
                           
                        </ul>
                    </li>
                     <li class="treeview <?=(($title=='accessories')?'active':'')?> ">
                        <a href="#">
                            <i class="fa fa-cube"></i>
                            <span>Accessories</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">                           
                           
                             <li  class="<?=(($subtitle=='Name')?'active':'')?>"><a href="<?=base_url('view/accessories_name')?>"><i class="fa fa-circle"></i>Accessories Name</a></li>

                             
                              <li  class="<?=(($subtitle=='inout')?'active':'')?>">
                                <a href="<?=base_url('new_add/accessories_add_orremove')?>">
                                    <i class="fa fa-circle"></i> <span>Add / Remove / Show</span>                            
                                </a>
                            </li>
                            


                        </ul>
                    </li>       
                   

                     <li class="treeview <?=(($title=='Report')?'active':'')?>">
                        <a href="#">
                            <i class="fa fa-file"></i>
                            <span>REPORT</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?=(($subtitle=='Material')?'active':'')?>">
                                    <a href="<?=base_url()?>report/material_buy_report_form">
                                        <i class="fa fa fa-circle-thin"></i>
                                        <span>Raw Material</span>                            
                                    </a>                        
                            </li>
                             <li class="<?=(($subtitle=='FinishGoods')?'active':'')?>">
                                    <a href="<?=base_url()?>report/production_report_form">
                                        <i class="fa fa fa-circle-thin"></i>
                                        <span>Finish Goods</span>                            
                                    </a>                        
                            </li>  
                             <li class="<?=(($subtitle=='SalesGoods')?'active':'')?>">
                                    <a href="<?=base_url()?>report/sale_report_form">
                                        <i class="fa fa fa-circle-thin"></i>
                                        <span>Sales</span>                            
                                    </a>                        
                            </li>
                          <!--   <li class="<=(($subtitle=='wasteR')?'active':'')?>">
                                    <a href="#" class="">
                                        <i class="fa fa fa-circle-thin"></i>
                                        <span>Waste</span>                            
                                    </a>                        
                            </li>   -->
                            
                            <!--  <li class="<=(($subtitle=='Expense')?'active':'')?>">
                                    <a href="<=base_url()?>report/expense_report_form">
                                        <i class="fa fa fa-circle-thin"></i>
                                        <span>Expenses</span>                            
                                    </a>                        
                            </li>  -->
                         </ul>
                    </li>          
                    <!-- <li class="">
                        <a href="=base_url('new_add/new_sellOut')?>">
                            <i class="fa fa-archive"></i> <span>SELL</span>                            
                        </a>
                    </li> -->
                   <!--  <li class="">
                        <a href="=base_url('new_add/new_material')?>">
                            <i class="fa fa-th"></i> <span>BUY Material</span>                            
                        </a>
                    </li> -->
                       <!-- <li class="">
                        <a href="=base_url('new_add/ready_product')?>">
                            <i class="fa fa-cube"></i> <span>PRODUCTION</span>                            
                        </a>
                    </li> -->
                   <!--  <li class="">
                        <a href="=base_url('view/reject')?>">
                            <i class="fa fa-cube"></i> <span>REJECT</span>                            
                        </a>
                    </li> -->
                   <!--  <li class="">
                        <a href="=base_url('new_add/daily_expense')?>">
                            <i class="fa fa-archive"></i> <span>DAILY EXPENSE</span>                            
                        </a>
                    </li> -->
                  <!--   
                    <li class="">
                        <a href="=base_url('new_add/customer_payment')?>"><i class="fa fa-circle-thin"></i>Buyer Payment</a>
                    </li> -->
                    <!--  <li class="">
                        <a href="=base_url('new_add/supplier_payment')?>"><i class="fa fa-circle-thin"></i>Supplier Payment</a>
                    </li> -->
                           
                     <li class="treeview <?=(($title=='Settings')?'active':'')?> ">
                        <a href="#">
                            <i class="fa fa-cog"></i>
                            <span>Settings</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            
                            <li class="<?=(($subtitle=='ProductType')?'active':'')?>"><a href="<?=base_url('view/product_type')?>"><i class="fa fa-circle-thin"></i>Product Type</a></li>

                             <li class="<?=(($subtitle=='product')?'active':'')?>"><a href="<?=base_url('view/product')?>"><i class="fa fa-circle-thin"></i>Product List</a></li>

                            <li  class="<?=(($subtitle=='RawMaterial')?'active':'')?>"><a href="<?=base_url('view/raw_material_type')?>"><i class="fa fa-circle-thin"></i>Raw Material Type</a></li>
                                                         
                              <li  class="<?=(($subtitle=='Asset')?'active':'')?>">
                                <a href="<?=base_url('view/asset')?>">
                                    <i class="fa fa-cube"></i> <span>ASSET</span>                            
                                </a>
                            </li>
                            <li class="<?=(($subtitle=='password')?'active':'')?>"><a href="<?=base_url('edit/update_users_password')?>"><i class="fa fa-circle-thin"></i>Update Users Password</a></li>


                            <!--  <li><a href="<=base_url('view/spare_parts')?>"><i class="fa fa-circle-thin"></i>Spare Parts</a></li>
                             -->

                            

                          <!--   <li><a href="<base_url('view/department_list')?>"><i class="fa fa-circle-thin"></i>Department</a></li> -->
                            <!-- <li  class="<=(($subtitle=='expense_type')?'active':'')?>"><a href="<=base_url('view/expense_type_list')?>"><i class="fa fa-circle-thin"></i>Expense Type</a></li> -->
                             <!-- <li><a href="<=base_url('view/branch_list')?>"><i class="fa fa-circle-thin"></i>Branch List</a></li> -->
                        </ul>
                    </li>
                     <li class="treeview <?=(($title=='People')?'active':'');?>">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>People Manager</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?=(($subtitle=='supplier')?'active':'');?>"><a href="<?=base_url('view/supplier_list')?>"><i class="fa fa-circle-thin"></i>Supplier List</a></li>
                            <li class="<?=(($subtitle=='supplierpayment')?'active':'');?>"><a href="<?=base_url('view/supplier_payment_list')?>"><i class="fa fa-circle-thin"></i>Supplier Payments</a></li>

                             <li class="<?=(($subtitle=='buyer')?'active':'');?>"><a href="<?=base_url('view/customer_list')?>"><i class="fa fa-circle-thin"></i>Buyer List</a></li>

                             <li class="<?=(($subtitle=='buyerpayment')?'active':'');?>"><a href="<?=base_url('view/customer_payment_list')?>"><i class="fa fa-circle-thin"></i>Buyer Payments</a></li>

                             <li class="<?=(($subtitle=='delete')?'active':'');?>"><a href="<?=base_url('delete/people_delete_form')?>"><i class="fa fa-circle-thin"></i>Delete Supplier/ Buyer</a></li>




                             
                           <!--  <li><a href="<=base_url('view/staff_list')?>"><i class="fa fa-circle-thin"></i>Staff List</a></li> -->
                           
                        </ul>
                    </li>
                    
                   <!-- 
                    
                   
                    
                    <li class="">
                        <a href="=base_url('new_add/attendence')?>">
                            <i class="fa fa-circle-thin"></i><span>ATTENDENCE</span>
                        </a>
                    </li>
                
                    <li class="treeview =($title=='Material')?'active': '';?>">
                        <a href="#">
                            <i class="fa fa-th"></i>
                            <span>Material Manager</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="=($subtitle=='consume')?'active':'';?>"><a href="=base_url('new_add/raw_material_consume')?>"><i class="fa fa-circle-thin"></i>Material Consume</a></li>
                            
                            <li class="<=($subtitle=='recycle'?'active':'')?>"><a href="=base_url('new_Add/raw_material_recycle')?>"><i class="fa fa-circle-thin"></i>Recycle</a></li>
                            
                        </ul>
                    </li>
                   <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>EMPLOYEE</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                           
                    <li><a href="=base_url('new_add/new_employee')?>"><i class="fa fa-circle-thin"></i>Add Employee</a></li>        
                    <li><a href="=base_url('view/employee_list')?>"><i class="fa fa-circle-thin"></i>Employee List</a></li>
                      
                     <li><a href="=base_url('new_add/employee_payment')?>"><i class="fa fa-circle-thin"></i>Employee Payment</a></li> 
                      <li><a href="=base_url('view/employee_account')?>"><i class="fa fa-circle-thin"></i>Employee Account</a></li>     
                           
                        </ul>
                    </li> -->



                </ul>
            </section>
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->