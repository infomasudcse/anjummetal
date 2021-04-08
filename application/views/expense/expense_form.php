d<?php  $this->load->view('inc/header'); ?>           

            <section class="content-header">
                <h1>
                    DAILY EXPENSE
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Expense</a></li>
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

                                if($error!=''){
                                    echo '<div class="alert alert-danger">'.$error.'</div>';
                                }
                            ?>
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="col-xl-12 col-12 pr-0">
                       
                        <div class="box box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                     <h3>Daily Expense </h3>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('view/daily_expense')?>" class="btn pull-right btn-sm btn-primary">View All</a>
                                 </div>
                             </div>   
                             <div clsss="row">
                                <div class="col-sm-10">
                                     <?php
                                    echo form_open('new_add/daily_expense', array('class'=>'form form-horizontal'));
                                   

                            ?>
                            
                           <div class="form-group row">
                              <label for="exampleselect" class="col-sm-2 col-form-label">Branch </label>
                              <div class="col-sm-10">
                                <select class="form-control" type="text" name="branch_id" id="exampleselect"  required>
                                	<option value="">Select Branch</option>
                                    <?php
                                          if(!empty($branch)){
                                            foreach($branch as $br){
                                              echo '<option value="'.$br['id'].'">'.$br['name'].'</option>';
                                            }
                                          }

                                    ?>
                                    
                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="exampleselect" class="col-sm-2 col-form-label">Expense Type</label>
                              <div class="col-sm-10">
                                <select class="form-control" type="text" name="type_id" id="exampleselect"  required>
                                    <?php
                                          if(!empty($type)){
                                            foreach($type as $val){
                                              echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
                                            }
                                          }

                                    ?>
                                    
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="example-text-input" class="col-sm-2 col-form-label">Amount</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="number" name="amount" value="<?php echo set_value('amount'); ?>" id="example-text-input"  placeholder="0.00" >
                              </div>
                            </div>
                           
                             <div class="form-group row">
                              <label for="exampleprice" class="col-sm-2 col-form-label">Note</label>
                              <div class="col-sm-10">
                                   <input class="form-control" type="text" name="note" value="<?php echo set_value('note'); ?>" id="exampleprice" placeholder="note...." >
                              </div>
                            </div>
                           
                            <div class="form-group row">
                              <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-info pull-right">Save</button>
                              </div>
                            </div>

                         </form>


                                </div>
                             </div>
                           
                        </div>
                        <!-- /.box -->
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('inc/footer'); ?>

   <script>
    $(document).ready(function(){
       


        $('#supplierSelect').blur(function(){
          var select = $('#supplierSelect').val();
          if(select === '0'){
            $('#supplierSelect').css('border','1px solid red');
          }
        });
    });


</script>         