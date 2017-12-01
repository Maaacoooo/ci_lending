
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title?> &middot; <?=$site_title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $this->load->view('inc/css')?>
</head>
<body class="hold-transition skin-red sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <?php $this->load->view('inc/header')?>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <?php $this->load->view('inc/left_nav')?>    
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        &nbsp;    
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>">Dashboard</a></li>
        <li><a href="<?=base_url('borrowers')?>">Borrowers</a></li>
        <li class="active"><?=$title?></li>
      </ol>
    </section>

   <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <?php
            //ALERT / NOTIFICATION
            //ERROR ACTION        
            $flash_settings = $this->session->flashdata('settings');
            $flash_valid =  validation_errors();                 
         ?>                       
        <?=$this->sessnotif->showNotif()?>
        </div><!-- /.col-xs-12 -->
      </div><!-- /.row -->

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-danger">
            <div class="box-body box-profile">             
              <?php if (filexist($info['img']) && $info['img']): ?>
                <img class="profile-user-img img-responsive img-circle" src="<?=base_url($info['img'])?>" alt="User profile picture">
              <?php else: ?>
                <img class="profile-user-img img-responsive img-circle" src="<?=base_url('assets/img/no_image.gif')?>" alt="User profile picture">                
              <?php endif ?>

              <h3 class="profile-username text-center"><?=$info['name']?></h3>

              <p class="text-muted text-center"><?=$info['id']?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Loan Applications</b> <span class="pull-right badge bg-red">Nah</span>
                </li>       
                <li class="list-group-item">
                  <b>Date Registered</b> <a class="pull-right"><?=$info['created_at']?></a>
                </li>                         
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li <?php if(!($flash_settings))echo'class="active"'?>><a href="#personal" data-toggle="tab">Account Information</a></li>
              <li><a href="#activity" data-toggle="tab">Activity Logs</a></li>
              <li <?php if($flash_settings)echo'class="active"'?>><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?php if(!($flash_settings))echo'active'?>" id="personal">
                <table class="table table-condensed table-dark-border">
                  <tr>
                    <td colspan="6"><strong>Personal Information</strong> <a href="#" class="pull-right"><i class="fa fa-edit"></i></a></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Fullname</strong> <small><em>(First Middle Last)</em></small></td>
                    <td colspan="4" class="bg-warning"><?=$info['firstname'] . ' ' . $info['middlename'] . ' ' . $info['lastname']?></td>
                  </tr>
                  <tr>
                    <th width="10%">Sex</th>                    
                    <td width="10%" class="bg-warning">
                      <?php if ($info['sex']): ?>
                        <span class="badge bg-blue">Male</span>
                      <?php else: ?>
                        <span class="badge bg-maroon">Female</span>
                      <?php endif ?>
                    </td>
                    <th width="20%">Civil Status</th>
                    <td class="bg-warning"><?=$info['civil_status']?></td>
                    <th width="15%">Birth Date</th>
                    <td class="bg-warning"><?=$info['birthdate']?> (<?=getAge($info['birthdate'])?> y.o)</td>
                  </tr>
                  <tr>
                    <th colspan="2">Birth Place</th>
                    <td colspan="4" class="bg-warning"><?=$info['bplace']?></td>
                  </tr>
                  <?php if ($info['civil_status'] == 'Married'): ?>
                  <tr>
                    <td colspan="6"><strong>Spouse Information</strong> <a href="#" class="pull-right"><i class="fa fa-edit"></i></a></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Fullname</strong> <small><em>(First Middle Last)</em></small></td>
                    <td colspan="2" class="bg-warning"><?=$info['spouse_name']?></td>
                    <th>Birth Date</th>
                    <td class="bg-warning"><?=$info['spouse_bdate']?> (<?=getAge($info['spouse_bdate'])?> y.o)</td>
                  </tr>
                  <tr>
                    <th colspan="2">Birth Place</th>
                    <td colspan="2" class="bg-warning"><?=$info['spouse_bplace']?></td>
                    <th>Contact Number</th>
                    <td class="bg-warning"><?=$info['spouse_contact']?></td>
                  </tr>
                  <tr>
                    <th colspan="2">Occupation</th>
                    <td class="bg-warning"><?=$info['spouse_occupation']?></td>
                    <th>Work Address</th>
                    <td colspan="2" class="bg-warning"><?=$info['spouse_work']?></td>
                  </tr>
                  <?php endif ?>
                  <tr>
                    <td colspan="6"><strong>Educational Attainment</strong> <a href="#" class="pull-right"><i class="fa fa-edit"></i></a></td>
                  </tr>
                  <tr>
                    <th>Level</th>
                    <td class="bg-warning">
                      <?php if ($info['educ_level'] == 0): ?>
                        Elementary Graduate
                      <?php elseif ($info['educ_level'] == 1): ?>
                        High School Graduate
                      <?php elseif ($info['educ_level'] == 2): ?>
                        College Graduate
                      <?php elseif ($info['educ_level'] == 3): ?>
                        Undergraduate
                      <?php endif ?>
                    </td>
                    <th>Course and School</th>
                    <td class="bg-warning"><?=$info['educ_course']?> - <?=$info['educ_school']?></td>
                    <th>Year</th>
                    <td class="bg-warning"><?=$info['educ_year']?></td>
                  </tr>
                </table><!-- /.table table-condensed table-dark-border-->
                <table class="table table-condensed table-dark-border">
                  <tr>
                    <th colspan="4">Address and Contact Information</th>
                  </tr>
                  <tr>
                    <td><strong>Current Address</strong> <a href="#" class="pull-right"><i class="fa fa-edit"></i></td>
                    <td class="bg-warning" colspan="3"><?=$info['current_addr']?></td>
                  </tr>
                  <tr>
                    <th>Other Addresses</th>
                    <td class="bg-warning" colspan="3">
                      <ul>
                        <?php foreach ($addresses as $addr): ?>
                          <?php 
                          if ($addr['type'] == 1) {
                            $type = "Home";
                          } elseif ($addr['type'] == 2) {
                            $type = "Current";                            
                          } elseif ($addr['type'] == 3) {
                            $type = "Other";                            
                          }
                          ?>
                          <li><?=$type?> - <?=$addr['address']?> <a href="#"><i class="fa fa-edit"></i></a></li>
                        <?php endforeach ?>
                        <li style="list-style: none;"><a href="#"><i class="fa fa-plus"></i> Add New Address</a></li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <th width="18%">Contact Numbers</th>
                    <td class="bg-warning">
                      <ul>
                        <?php if ($mobiles): ?>
                        <?php foreach ($mobiles as $mob): ?>
                        <li><?=$mob['value']?> <a href="#" data-toggle="modal" data-target="#UpdateMobile<?=$mob['id']?>"><i class="fa fa-edit"></i></a></li>
                        <?php endforeach ?>
                        <?php endif ?>
                        <li style="list-style: none;"><a href="#" data-toggle="modal" data-target="#AddMobile"><i class="fa fa-plus"></i> Add New Contact Number</a></li>
                      </ul>
                    </td>
                    <th width="15%">Email Addresses</th>
                    <td class="bg-warning">
                      <ul>
                        <?php if ($emails): ?>
                        <?php foreach ($emails as $email): ?>
                        <li><?=$email['value']?> <a href="#" data-toggle="modal" data-target="#UpdateEmail<?=$email['id']?>"><i class="fa fa-edit"></i></a></li>
                        <?php endforeach ?>
                        <?php endif ?>
                        <li style="list-style: none;"><a href="#" data-toggle="modal" data-target="#AddEmail"><i class="fa fa-plus"></i> Add New Email Address</a></li>
                      </ul>
                    </td>
                  </tr>
                </table><!-- /.table .table-condensed table-dark-border -->

                <table class="table table-condensed table-dark-border">
                  <tr>
                    <th colspan="2">Employment and Business Information</th>
                  </tr>
                  <tr>
                    <th>Employment</th>
                    <td class="bg-warning">
                      <ul>
                        <?php if ($employments): ?>
                        <?php foreach ($employments as $emp): ?>
                        <li>
                          <a href="#" data-toggle="modal" data-target="#UpdateEmployer<?=$emp['id']?>">
                            <?php if ($emp['type']): ?>
                              <span class="label bg-red">GOVT</span> 
                            <?php else: ?>
                              <span class="label bg-green">PRIV</span> 
                            <?php endif ?>
                            <?=$emp['position_nature']?> - 
                            <?=$emp['employer_business']?> (<?=$emp['year_started']?>-<?php if($emp['year_ended']){echo $emp['year_ended']; } else { echo 'Present'; }?>)</a>
                          <a href="#" data-toggle="modal" data-target="#UpdateEmployer<?=$emp['id']?>"><i class="fa fa-edit"></i></a>
                        </li> 
                        <?php endforeach ?>
                        <?php endif ?>

                        <li style="list-style: none;"><a href="#" data-toggle="modal" data-target="#AddEmployer"><i class="fa fa-plus"></i> Add New Employer</a></li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <th>Businesses</th>
                    <td class="bg-warning">
                      <ul>
                        <?php if ($businesses): ?>
                        <?php foreach ($businesses as $buss): ?>
                        <li>
                          <a href="#" data-toggle="modal" data-target="#UpdateBusiness<?=$buss['id']?>">                          
                            <?=$buss['employer_business']?> - <?=$buss['address']?> 
                            (<?=$buss['year_started']?>-<?php if($buss['year_ended']){echo $buss['year_ended']; } else { echo 'Present'; }?>)</a>
                          <a href="#" data-toggle="modal" data-target="#UpdateBusiness<?=$buss['id']?>"><i class="fa fa-edit"></i></a>
                        </li> 
                        <?php endforeach ?>
                        <?php endif ?>
                        <li style="list-style: none;"><a href="#" data-toggle="modal" data-target="#AddBusiness"><i class="fa fa-plus"></i> Add New Business</a></li>
                      </ul>
                    </td>
                  </tr>
                </table><!-- /.table table-condensed table-dark-border -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="activity">
                <h4 class="title">Last Activity</h4>
                <?php if ($logs): ?>
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>Date Time</th>
                      <th>IP Address</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($logs as $lg): ?>
                    <tr>
                      <td><?=$lg['action']?>
                        <?php if ($lg['tag'] == 'user'): ?>
                          <a href="<?=base_url('users/update/'.$lg['tag_id'])?>" title="Check out..."><i class="fa fa-external-link"></i></a>
                        <?php endif ?>
                      </td>
                      <td><?=$lg['date_time']?></td>
                      <td><?=$lg['ip_address']?></td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table><!-- /.table table-condensed -->
                <?php else: ?>
                  <div class="alert alert-warning">               
                    <h4><i class="icon fa fa-warning"></i> No records found!</h4>         
                    No Activity Logs record found in the system
                  </div>
                <?php endif ?>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane <?php if($flash_settings)echo'active'?>" id="settings">

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="AddEmployer">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?=form_open('borrowers/add_work')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Employer</h4>
        </div>
        <div class="modal-body">          
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <label for="employ_grp">Employer Type</label>
                  <div class="form-group">
                    <div class="col-xs-7">
                      <label>
                          <input type="radio" name="employ_grp" value="1" class="minimal-red">
                        Government
                      </label>
                    </div><!-- /.col-xs-6 -->
                    <div class="col-xs-5">
                      <label>
                          <input type="radio" name="employ_grp" value="0" class="minimal-red">
                        Private
                      </label>
                    </div><!-- /.col-xs-6 -->                    
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                      <label for="employ_name">Employer's Name</label>
                      <input type="text" name="employ_name" id="employ_name" class="form-control" placeholder="Name of Company..." value="<?=set_value('employ_name')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                      <label for="employ_position">Position</label>
                      <input type="text" name="employ_position" id="employ_position" class="form-control" placeholder="Position..." value="<?=set_value('employ_position')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-2 col-sm-12">
                  <div class="form-group">
                      <label for="employ_date">Date Started</label>
                      <input type="text" name="employ_date" id="employ_date" class="form-control" placeholder="mm/dd/yyyy" value="<?=set_value('employ_date')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="employ_addr">Work Address</label>
                      <input type="text" name="employ_addr" id="employ_addr" class="form-control" placeholder="Complete Address..." value="<?=set_value('employ_addr')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="employ_contact">Contact Number</label>
                    <input type="text" name="employ_contact" id="" class="form-control" value="<?=set_value('employ_contact')?>" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                      <label for="employ_status">Status</label>
                      <input type="text" name="employ_status" id="employ_status" class="form-control" placeholder="Status..." value="<?=set_value('employ_status')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="employ_remarks">Remarks</label>
                    <textarea name="employ_remarks" id="employ_remarks" class="form-control"></textarea>
                  </div><!-- /.form-group -->
                </div><!-- /.col-sm-12 -->
              </div><!-- /.row -->          
        </div>

        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($info['id'])?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-primary">Save</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="AddBusiness">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?=form_open('borrowers/add_work')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Business</h4>
        </div>
        <div class="modal-body">          
            <div class="row">                
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="business_name">Business Name</label>
                      <input type="text" name="business_name" id="business_name" class="form-control" placeholder="Name of Company..." value="<?=set_value('business_name')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                      <label for="business_nature">Nature of Business</label>
                      <input type="text" name="business_nature" id="business_nature" class="form-control" placeholder="Position..." value="<?=set_value('business_nature')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-2 col-sm-12">
                  <div class="form-group">
                      <label for="business_date">Date Started</label>
                      <input type="text" name="business_date" id="business_date" class="form-control" placeholder="mm/dd/yyyy" value="<?=set_value('business_date')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="business_addr">Business Address</label>
                      <input type="text" name="business_addr" id="business_addr" class="form-control" placeholder="Business Address..." value="<?=set_value('business_addr')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="business_contact">Contact Number</label>
                    <input type="text" name="business_contact" id="" class="form-control" value="<?=set_value('business_contact')?>" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                      <label for="business_status">Status</label>
                      <input type="text" name="business_status" id="business_status" class="form-control" placeholder="Status..." value="<?=set_value('business_status')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="business_remarks">Remarks</label>
                    <textarea name="business_remarks" id="business_remarks" class="form-control"></textarea>
                  </div><!-- /.form-group -->
                </div><!-- /.col-sm-12 -->
              </div><!-- /.row -->
        </div><!-- /.modal-body -->

        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($info['id'])?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-primary">Save</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="AddMobile">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <?=form_open('borrowers/add_contact')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Mobile Number</h4>
        </div>
        <div class="modal-body">          
           <div class="form-group">
             <label for="">Mobile Number</label>
             <input type="text" name="contact[]" id="" class="form-control" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask required="" />
           </div><!-- /.form-group -->
        </div><!-- /.modal-body -->

        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($info['id'])?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-primary">Save</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <div class="modal fade" id="AddEmail">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <?=form_open('borrowers/add_contact')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Email Address</h4>
        </div>
        <div class="modal-body">          
           <div class="form-group">
             <label for="email">Email Address</label>
             <input type="email" name="email[]" id="email" class="form-control" required="" placeholder="youremail@emailprovider.com" />
           </div><!-- /.form-group -->
        </div><!-- /.modal-body -->

        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($info['id'])?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-primary">Save</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->




  <?php if ($employments): ?>
  <?php foreach ($employments as $emp): ?>
  <div class="modal fade" id="UpdateEmployer<?=$emp['id']?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <?=form_open('borrowers/add_contact')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><?=$emp['employer_business']?></h4>
        </div>
        <div class="modal-body">          
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#employ_info<?=$emp['id']?>" data-toggle="tab" data-target="#employ_info<?=$emp['id']?>">Info</a></li>
              <li><a href="#employ_update<?=$emp['id']?>" data-toggle="tab" data-target="#employ_update<?=$emp['id']?>">Update</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="employ_info<?=$emp['id']?>">
                <strong>Employer Name</strong>
                <p class="text-muted"><?=$emp['employer_business']?></p><!-- /.text-muted -->
                <hr />
                <strong>Employer Type</strong>
                <p class="text-muted">
                  <?php if ($emp['type']): ?>
                              <span class="label bg-red">GOVERNMENT</span> 
                            <?php else: ?>
                              <span class="label bg-green">PRIVATE</span> 
                            <?php endif ?>
                </p><!-- /.text-muted -->
                <hr />
                <strong>Position</strong>
                <p class="text-muted"><?=$emp['position_nature']?></p><!-- /.text-muted -->
                <hr />
                <strong>Operating Dates</strong>
                <p class="text-muted">
                  <?=$emp['date_started']?> to <?php if($emp['date_ended']){echo $emp['date_ended']; } else { echo 'Present'; }?>
                </p><!-- /.text-muted -->
                <hr />
                <strong>Work Address</strong>
                <p class="text-muted"><?=$emp['address']?></p><!-- /.text-muted -->
                <hr />
                <strong>Status</strong>
                <p class="text-muted"><?=$emp['status']?></p><!-- /.text-muted -->
                <hr />
                <strong>Remarks</strong>
                <p class="text-muted"><?=$emp['remarks']?></p><!-- /.text-muted -->                
              </div>
              <div class="tab-pane" id="employ_update<?=$emp['id']?>">
                asdasdasdasdasdasd
              </div><!-- /#employ_update.tab-pane -->
            </div><!-- /.tab-content -->
          </div><!-- /.nav-tabs-custom -->
        </div><!-- /.modal-body -->

        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($emp['id'])?>" />
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php endforeach ?>
  <?php endif ?>


  <footer class="main-footer">    
    <?php $this->load->view('inc/footer')?>    
  </footer>

</div>
<!-- ./wrapper -->

    <?php $this->load->view('inc/js')?>    
    <script src="<?=base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/input-mask/jquery.inputmask.js')?>"></script>
    <script src="<?=base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js')?>"></script>

    <script src="<?=base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>

    <script type="text/javascript">
    $('[data-mask]').inputmask()

    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })

    //Date picker
    $('#birthdate, #spouse_bdate, #employ_date, #business_date').datepicker({
      autoclose: true
    })

    </script>
  
</body>
</html>
