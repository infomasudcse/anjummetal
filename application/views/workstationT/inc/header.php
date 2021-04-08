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
    <title> <?=$title?> </title>

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

<?php   $user_info = $this->session->userdata('user_info');?>  

<body class="hold-transition skin-red-light sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?=base_url('workstationtwo')?>" class="logo">
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
                        <li class='user-menu'><p style="padding: 12px;color: #fff;font-size: 22px;">Workstation Two</p></li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?=base_url()?>assets/images/default.jpg" class="user-image rounded-circle" alt="User Image">
                            </a>
                            <ul class="dropdown-menu scale-up">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?=base_url()?>assets/images/default.jpg" class="float-left rounded-circle" alt="User Image">

                                    <p>
                                       Workstation Two
                                        <small class="mb-5"></small>
                                        
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="row no-gutters" style="padding-top:15px;">
                                       
                                        <div class="col-12 text-left">
                                            <a href="#"><i class="ion ion-settings"></i> Setting</a>
                                        </div>
                                        <div role="separator" class="divider col-12"></div>
                                        <div class="col-12 text-left">
                                           <a href="<?=base_url()?>authentication/logout" >Logout</a>
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
                   
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="user-profile ">
                        <a href="<?=base_url('workstationtwo');?>">
                          <span class="profile_txt">Workstation Two</span>
                          
                        </a>
                    </li>
                    <!-- <li class="header nav-small-cap">PERSONAL</li> -->
                    <li class="<?=($title=='Dashboard')?'active':''?>">
                        <a href="<?=base_url('workstationtwo')?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="<?=($title=='Accessories')?'active':''?>">
                        <a href="<?=base_url('workstationtwo/accessoriesDescription')?>">
                            <i class="fa fa-archive"></i><span>Receive Accessories</span>                            
                        </a>
                    </li>
                     <li class="<?=($title=='SpareParts')?'active':''?>">
                        <a href="<?=base_url('workstationtwo/spare_parts')?>">
                            <i class="fa fa-circle"></i><span>Receive Spare Parts</span>                            
                        </a>
                    </li>



                       <li class="<?=($title=='Scrab')?'active':''?>">
                         <a href="<?=base_url('workstationtwo/scrabChalan')?>">
                            <i class="fa fa-cube"></i> <span>Delivery Scrab</span> 

                                                
                        </a>
                    </li> 
                     <li class="<?=($title=='Delivery')?'active':''?>">
                        <a href="<?=base_url('workstationtwo/delivery')?>">
                            <i class="fa fa-th"></i><span>Delivery Finish Product</span>                            
                        </a>
                    </li>
                    <li class="<?=($title=='Report')?'active':''?>">
                            <a href="<?=base_url('workstationtwo/report')?>">
                            <i class="fa fa-th"></i><span>Report</span>                            
                         </a>
                         </li>

                </ul>
            </section>
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->