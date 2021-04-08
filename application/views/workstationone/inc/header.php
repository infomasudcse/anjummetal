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

<?php $user = $this->session->userdata('user_info') ; ?>

<body class="hold-transition skin-red-light sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?=base_url('workstationone')?>" class="logo">
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
                        <li class='user-menu'><p style="padding: 12px;color: #fff;font-size: 22px;">Workstation One</p></li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?=base_url()?>assets/images/default.jpg" class="user-image rounded-circle" alt="User Image">
                            </a>
                            <ul class="dropdown-menu scale-up">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?=base_url()?>assets/images/default.jpg" class="float-left rounded-circle" alt="User Image">

                                    <p>
                                        Workstation One 
                                        <small class="mb-5"></small>
                                        
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="row no-gutters" style="padding-top:15px;">
                                       
                                        
                                        <div role="separator" class="divider col-12"></div>
                                        <div class="col-12 text-left">
                                            <a href="<?=base_url()?>authentication/logout" class="">Logout</a>
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
                        <a href="<?=base_url('workstationone/index');?>">
                          <span class="profile_txt"> Workstation One </span>
                          
                        </a>
                    </li>
                    <!-- <li class="header nav-small-cap">PERSONAL</li> -->
                    <li class="<?=($title=='Dashboard')?'active':''?>">
                        <a href="<?=base_url('workstationone')?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>
                     <li class="<?=($title=='RawMaterial')?'active':''?>">
                        <a href="<?=base_url('workstationone/newRawMaterialInput')?>">
                            <i class="fa fa-archive"></i><span>RAW MATERIAL</span>                            
                        </a>
                    </li>
                    <!--  <li class=" ($title=='SpareParts')?'active':'' ">
                        <a href="base_url('workstationone/spare_parts')">
                            <i class="fa fa-archive"></i><span>Spare Parts</span>                            
                        </a>
                    </li> -->
                     <li class="<?=($title=='Delivery')?'active':''?>">
                            <a href="<?=base_url('workstationone/delivery')?>">
                            <i class="fa fa-file"></i><span> Finished Product</span>                            
                         </a>
                    </li>
                    <li class="<?=($title=='Waste'?'active':'')?>">
                        <a href="<?=base_url('workstationone/waste_material')?>"><i class="fa fa-circle-thin"></i><span> Waste</span> </a>
                    </li>

                    <li class="<?=($title=='Report')?'active':''?>">
                            <a href="<?=base_url('workstationone/report')?>">
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