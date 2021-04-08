<?php  
//print_r($this->session->userdata);
$this->load->view('workstationone/inc/header'); ?>
            

            <section class="content-header">
                <h1>
                    Workstation One
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Workstation One</a></li>
                    <li class="breadcrumb-item active"><a href="#">dashboard</a></li>
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
                         <div class="row">
                            <div class="col-sm-12">
                                 <div class="box box-body">
                                <h2>Welcome </h2>      
                                    </div>  
                            </div>
                        </div>
                         <div class="row">
                           

                            <div class="col-sm-4">
                                <div class="box box-body">
                                    <h3>Raw Material</h3>
                                    <p>
                                         <?php 
                            $mat = $this->db->where('chalan_no','00')->where('supplier_id','2')->get('raw_material_chalan');
                            if($mat->num_rows()> 0){ 
                                    echo 'Old Raw Material input done. ';
                             }else{
                            ?>
                              <a href="<?=base_url('workstationone/oldRawMaterial')?>" class=""> 1. Old Entry</a>
                               <?php } ?>           

                                    </p>
                                </div>
                            </div>

                     
                        </div>
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('workstationone/inc/footer'); ?>

            