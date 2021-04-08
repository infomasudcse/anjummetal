<?php  $this->load->view('inc/header'); ?>
            

            <section class="content-header">
                <h1>
                    RAW MATERIAL
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Raw Material</a></li>
                </ol>
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
                      
                        <div class="box box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                     <h3>Raw Material</h3>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('new_add/new_material')?>" class="btn btn-sm pull-right btn-primary">Add New</a>
                                 </div>
                             </div>   
                            <table id="raw_material_table" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Type Name</th>
                                        <th>Supplier</th>
                                         <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                        <th>SubTotal</th>
                                        <th>Action.</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Type Name</th>
                                        <th>Supplier</th>
                                         <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                        <th>SubTotal</th>
                                        <th>Action.</th>
                                    </tr>
                                </tfoot>
                        </table>

                        </div>
                        <!-- /.box -->
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('inc/footer'); ?>

            