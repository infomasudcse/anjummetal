<?php  $this->load->view('inc/header'); ?>
            

            <section class="content-header">
                <h1>
                    Branches 
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Branch</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                   
                    <div class="col-sm-10">
                       <div class="box box-body">
                        <h2>Branch List </h2>
                        <p><br/></p>
                         <table id="branch_table" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Branch Name</th>                                       
                                        <th>Action</th>
                                      
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                       <th>Branch Name</th>                                       
                                        <th>Action</th>
                                        
                                    </tr>
                                </tfoot>
                        </table>
                      </div>

                    </div>
                </div>



                




            </section>

<?php  $this->load->view('inc/footer'); ?>

            