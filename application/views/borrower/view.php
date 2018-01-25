
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
                <div class="row">
                  <div class="col-sm-12">
                    <a href="<?=current_url()?>/print" target="_blank" class="pull-right"><i class="fa fa-print"></i> Print Information</a>
                  </div><!-- /.col-sm-12 -->
                </div><!-- /.row -->
                <table class="table table-condensed table-dark-border">
                  <tr>
                    <td colspan="6"><strong>Personal Information</strong> <a href="#personalInfoModal" data-toggle="modal" data-target="#personalInfoModal" class="pull-right"><i class="fa fa-edit"></i></a></td>
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
                    <td colspan="6"><strong>Spouse Information</strong> <a href="#SpouseInfoModal" data-toggle="modal" data-target="#SpouseInfoModal" class="pull-right"><i class="fa fa-edit"></i></a></td>
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
                    <td colspan="6"><strong>Educational Attainment</strong> <a href="#EducInfoModal" data-toggle="modal" data-target="#EducInfoModal" class="pull-right"><i class="fa fa-edit"></i></a></td>
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
                    <td><strong>Current Address</strong> 
                      <a href="#" class="pull-right" data-toggle="modal" data-target="#UpdateCurrentAddr">
                        <i class="fa fa-edit"></i>
                      </a>
                    </td>
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
                          <li><?=$type?> - <?=$addr['address']?> <a href="#" data-target="#UpdateAddress<?=$addr['id']?>" data-toggle="modal"><i class="fa fa-edit"></i></a></li>
                        <?php endforeach ?>
                        <li style="list-style: none;"><a href="#" data-target="#AddAddress" data-toggle="modal"><i class="fa fa-plus"></i> Add New Address</a></li>
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
                      <th>User</th>
                      <th width="45%">Action</th>
                      <th>Date Time</th>
                      <th>IP Address</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($logs as $lg): ?>
                    <tr>
                      <td><?=$lg['user']?></td>
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
                      <input type="text" name="employ_date" id="employ_date" class="form-control bootstrap-datepicker" placeholder="mm/dd/yyyy" value="<?=set_value('employ_date')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="employ_addr">Work Address</label>
                      <input type="text" name="employ_addr" id="employ_addr" class="form-control bootstrap-datepicker" placeholder="Complete Address..." value="<?=set_value('employ_addr')?>" />
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
                      <input type="text" name="business_nature" id="business_nature" class="form-control" placeholder="Nature of Business..." value="<?=set_value('business_nature')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-2 col-sm-12">
                  <div class="form-group">
                      <label for="business_date">Date Started</label>
                      <input type="text" name="business_date" id="business_date" class="form-control bootstrap-datepicker" placeholder="mm/dd/yyyy" value="<?=set_value('business_date')?>" />
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

<!-- ///////////////////////////// Update Current Address ////////////////////////////// -->

  <div class="modal fade" id="UpdateCurrentAddr">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?=form_open('borrowers/update_CurrentAddr')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Set a Current Address</h4>
        </div>
        <div class="modal-body">  
            <div class="row">
              <div class="form-group">
              <label for="addr_list" class="col-md-2 col-sm-12">Address List</label>
              <div class="col-md-8 col-sm-12">
                <select name="addr_list" id="addr_list" class="form-control">
                  <option selected disabled>Select from the Address List...</option>
                  <?php if ($addresses): ?>
                    <?php foreach ($addresses as $addr): ?>
                      <option value="<?=$this->encryption->encrypt($addr['id'])?>"><?=$addr['address']?></option>
                    <?php endforeach ?>
                  <?php endif ?>
                </select>
              </div><!-- /.col-md-8 col-sm-12 -->
              <div class="col-md-2 col-sm-12">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="new_address" id="new_address" onclick="enable_new()" /> New Address
                  </label>
                </div><!-- /.checkbox -->
              </div><!-- /.col-md-2 col-sm-12 -->
            </div><!-- /.row --> 
            </div>  
            <hr /> 
            <div class="row">               
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="addr_bldg">Building / Block / House</label>
                    <input type="text" name="addr_bldg" class="form-control" id="new_addr_bldg" placeholder="Building / Block / House..." value="<?=set_value('addr_bldg')?>" required disabled/>
                  </div>
                </div><!-- /.col-sm-5 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="addr_strt">Street</label>
                    <input type="text" name="addr_strt" class="form-control" id="new_addr_strt" placeholder="Street..." value="<?=set_value('addr_strt')?>" required disabled/>
                  </div>
                </div><!-- /.col-sm-4 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="addr_brgy">Barangay</label>
                    <input type="text" name="addr_brgy" class="form-control" id="new_addr_brgy" placeholder="Barangay..." value="<?=set_value('addr_brgy')?>" required disabled/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="addr_city">City / Municipality</label>
                    <input type="text" name="addr_city" class="form-control" id="new_addr_city" placeholder="City / Municipality..." value="<?=set_value('addr_city')?>" required disabled/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="addr_prov">Province / Region</label>
                    <input type="text" name="addr_prov" class="form-control" id="new_addr_prov" placeholder="Province / Region..." value="<?=set_value('addr_prov')?>" required disabled/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="addr_zip">Zip Code</label>
                    <input type="text" name="addr_zip" class="form-control" id="new_addr_zip" placeholder="Zip Code..." value="<?=set_value('addr_zip')?>" required disabled/>
                  </div>
                </div><!-- /.col-sm-2 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="addr_ctry">Country</label>
                    <input type="text" name="addr_ctry" class="form-control" id="new_addr_ctry" placeholder="Country..." value="<?php if(set_value('addr_ctry'))echo set_value('addr_ctry'); else echo 'Philippines';?>" required disabled/>
                  </div>
                </div><!-- /.col-sm-4 -->
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



<!-- ///////////////////////////////// New Address ////////////////////////////////////// -->

  <div class="modal fade" id="AddAddress">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?=form_open('borrowers/add_address')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Address</h4>
        </div>
        <div class="modal-body"> 
            <div class="row">
              <div class="col-sm-12">
                <div class="callout callout-info">
                  <h4><i class="fa fa-info-circle"></i> Information</h4>
                  <p>Fill up all necessary fields. Fill <span class="badge">N/A</span> for not applicable fields.</p>
                  <p>Setting an address type to <span class="badge">Current</span> will replace the Current Address, 
                    and will be changed to <span class="badge">Others</span>.</p>
                </div><!-- /.callout callout-info -->
              </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->         
            <div class="row">
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="addr_type">Address Type</label>
                    <select class="form-control" name="addr_type" id="addr_type" required>
                      <option disabled selected>Select Address Type...</option>
                      <option value="<?=$this->encryption->encrypt('1')?>">Home</option>
                      <option value="<?=$this->encryption->encrypt('2')?>">Current</option>
                      <option value="<?=$this->encryption->encrypt('3')?>">Others</option>
                    </select>
                  </div><!-- /.form-group -->
                </div><!-- /.col-sm-2 -->
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="addr_bldg">Building / Block / House</label>
                    <input type="text" name="addr_bldg" class="form-control" id="addr_bldg" placeholder="Building / Block / House..." value="<?=set_value('addr_bldg')?>" required/>
                  </div>
                </div><!-- /.col-sm-5 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="addr_strt">Street</label>
                    <input type="text" name="addr_strt" class="form-control" id="addr_strt" placeholder="Street..." value="<?=set_value('addr_strt')?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="addr_brgy">Barangay</label>
                    <input type="text" name="addr_brgy" class="form-control" id="addr_brgy" placeholder="Barangay..." value="<?=set_value('addr_brgy')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="addr_city">City / Municipality</label>
                    <input type="text" name="addr_city" class="form-control" id="addr_city" placeholder="City / Municipality..." value="<?=set_value('addr_city')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="addr_prov">Province / Region</label>
                    <input type="text" name="addr_prov" class="form-control" id="addr_prov" placeholder="Province / Region..." value="<?=set_value('addr_prov')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="addr_zip">Zip Code</label>
                    <input type="text" name="addr_zip" class="form-control" id="addr_zip" placeholder="Zip Code..." value="<?=set_value('addr_zip')?>" required/>
                  </div>
                </div><!-- /.col-sm-2 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="addr_ctry">Country</label>
                    <input type="text" name="addr_ctry" class="form-control" id="addr_ctry" placeholder="Country..." value="<?php if(set_value('addr_ctry'))echo set_value('addr_ctry'); else echo 'Philippines';?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
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



<!-- ///////////////////////////////// Update Address ////////////////////////////////////// -->

  <?php if ($addresses): ?>
  <?php foreach ($addresses as $addr): ?>
  
  <div class="modal fade" id="UpdateAddress<?=$addr['id']?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?=form_open('borrowers/update_address')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update New Address</h4>
        </div>
        <div class="modal-body"> 
            <div class="row">
              <div class="col-sm-12">
                <div class="callout callout-info">
                  <h4><i class="fa fa-info-circle"></i> Information</h4>
                  <p>Setting an address type to <span class="badge">Current</span> will replace the Current Address, 
                    and will be changed to <span class="badge">Others</span>.</p>
                </div><!-- /.callout callout-info -->
              </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->         
            <div class="row">
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="addr_type">Address Type</label>
                    <select class="form-control" name="addr_type" id="addr_type" required>
                      <option disabled selected>Select Address Type...</option>
                      <option value="<?=$this->encryption->encrypt('1')?>" <?php if($addr['type']==1)echo'selected';?>>Home</option>
                      <option value="<?=$this->encryption->encrypt('2')?>" <?php if($addr['type']==2)echo'selected';?>>Current</option>
                      <option value="<?=$this->encryption->encrypt('3')?>" <?php if($addr['type']==3)echo'selected';?>>Others</option>
                    </select>
                  </div><!-- /.form-group -->
                </div><!-- /.col-sm-2 -->
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="addr_bldg">Building / Block / House</label>
                    <input type="text" name="addr_bldg" class="form-control" id="addr_bldg" placeholder="Building / Block / House..." value="<?=$addr['building']?>" required/>
                  </div>
                </div><!-- /.col-sm-5 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="addr_strt">Street</label>
                    <input type="text" name="addr_strt" class="form-control" id="addr_strt" placeholder="Street..." value="<?=$addr['street']?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="addr_brgy">Barangay</label>
                    <input type="text" name="addr_brgy" class="form-control" id="addr_brgy" placeholder="Barangay..." value="<?=$addr['barangay']?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="addr_city">City / Municipality</label>
                    <input type="text" name="addr_city" class="form-control" id="addr_city" placeholder="City / Municipality..." value="<?=$addr['city']?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="addr_prov">Province / Region</label>
                    <input type="text" name="addr_prov" class="form-control" id="addr_prov" placeholder="Province / Region..." value="<?=$addr['province']?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="addr_zip">Zip Code</label>
                    <input type="text" name="addr_zip" class="form-control" id="addr_zip" placeholder="Zip Code..." value="<?=$addr['zip']?>" required/>
                  </div>
                </div><!-- /.col-sm-2 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="addr_ctry">Country</label>
                    <input type="text" name="addr_ctry" class="form-control" id="addr_ctry" placeholder="Country..." value="<?=$addr['country']?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
              </div><!-- /.row -->
        </div><!-- /.modal-body -->

        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($addr['id'])?>" />
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

  <?php endforeach ?>
  <?php endif ?>


<!-- //////////////////////////// Add Mobile ///////////////////////////// -->

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

<!-- //////////////////////////// Update Mobile ///////////////////////////// -->
  <?php if ($mobiles): ?>
  <?php foreach ($mobiles as $mob): ?>  

  <div class="modal fade" id="UpdateMobile<?=$mob['id']?>">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <?=form_open('borrowers/update_contact')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Mobile Number</h4>
        </div>
        <div class="modal-body">          
          <div class="callout callout-info">
            <p><i class="fa fa-info-circle"></i> To delete a record, simply clear the textbox and save.</p>
          </div><!-- /.callout callout-info -->    
           <div class="form-group">
             <label for="">Mobile Number</label>
             <input type="text" name="value" value="<?=$mob['value']?>" class="form-control" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789"/>
           </div><!-- /.form-group -->
        </div><!-- /.modal-body -->

        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($mob['id'])?>" />
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
  <?php endforeach ?>  
  <?php endif ?>


  <!-- //////////////////////////// Update Email ///////////////////////////// -->
  <?php if ($emails): ?>
  <?php foreach ($emails as $email): ?>  

  <div class="modal fade" id="UpdateEmail<?=$email['id']?>">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <?=form_open('borrowers/update_contact')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Email Address</h4>
        </div>
        <div class="modal-body">      
          <div class="callout callout-info">
            <p><i class="fa fa-info-circle"></i> To delete a record, simply clear the textbox and save.</p>
          </div><!-- /.callout callout-info -->    
           <div class="form-group">
             <label for="">Email Address</label>
             <input type="email" name="value" value="<?=$email['value']?>" class="form-control" placeholder="youremail@emailprovider.com" />
           </div><!-- /.form-group -->
        </div><!-- /.modal-body -->

        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($email['id'])?>" />
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
  <?php endforeach ?>  
  <?php endif ?>

<!-- //////////////////////////// Add Email ///////////////////////////// -->

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


  <!-- ///////////////////  Employer Details //////////////////////// -->

  <?php if ($employments): ?>
  <?php foreach ($employments as $emp): ?>
  <div class="modal fade" id="UpdateEmployer<?=$emp['id']?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Employer: <?=$emp['employer_business']?></h4>
        </div>
        <div class="modal-body">          
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#employ_info<?=$emp['id']?>" data-toggle="tab" data-target="#employ_info<?=$emp['id']?>">Information</a></li>
              <li><a href="#employ_update<?=$emp['id']?>" data-toggle="tab" data-target="#employ_update<?=$emp['id']?>">Update</a></li>
              <li><a href="#employ_delete<?=$emp['id']?>" data-toggle="tab" data-target="#employ_delete<?=$emp['id']?>">Delete</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="employ_info<?=$emp['id']?>">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Employer Name</strong>
                    <p class="text-muted"><?=$emp['employer_business']?>
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
                    <strong>Contact Number</strong>
                    <p class="text-muted"><?=$emp['tel_no']?></p><!-- /.text-muted -->
                    <hr />
                    <strong>Work Address</strong>
                    <p class="text-muted"><?=$emp['address']?></p><!-- /.text-muted -->
                    <hr />          
                  </div><!-- /.col-md-6 -->
                  <div class="col-md-6">
                    <strong>Operating / Employment Dates</strong>
                    <p class="text-muted">
                      <?=$emp['date_started']?> to <?php if($emp['date_ended']){echo $emp['date_ended']; } else { echo 'Present'; }?>
                      <?php if ($emp['date_ended']): ?>
                        <span class="badge"><?=getAge($emp['date_started'], $emp['date_ended'])?> yrs</span>
                      <?php else: ?>
                        <span class="badge"><?=getAge($emp['date_started'])?> yrs</span>
                      <?php endif ?>
                    </p><!-- /.text-muted -->
                    <hr />     
                    <strong>Status</strong>
                    <p class="text-muted"><?=$emp['status']?></p><!-- /.text-muted -->
                    <hr />
                    <strong>Remarks</strong>
                    <p class="text-muted"><?=$emp['remarks']?></p><!-- /.text-muted -->   
                  </div><!-- /.col-md-6 -->
                </div><!-- /.row -->             
              </div>

              <div class="tab-pane" id="employ_update<?=$emp['id']?>">
                <?=form_open('borrowers/update_work')?>
                <div class="row">
                  <div class="col-md-3 col-sm-12">
                    <label for="employ_grp">Employer Type</label>
                    <div class="form-group">
                      <div class="col-xs-6">
                        <label>
                            <input type="radio" name="employ_grp" value="1" class="minimal-red <?php if($emp['type'])echo'checked';?>" <?php if($emp['type'])echo'checked';?>>
                          GOV
                        </label>
                      </div><!-- /.col-xs-6 -->
                      <div class="col-xs-6">
                        <label>
                            <input type="radio" name="employ_grp" value="0" class="minimal-red <?php if(!$emp['type'])echo'checked';?>" <?php if(!$emp['type'])echo'checked';?>>
                          PRIV
                        </label>
                      </div><!-- /.col-xs-6 -->                    
                    </div>
                  </div><!-- /.col-md-4 col-sm-12 -->
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="employ_name">Employer's Name</label>
                        <input type="text" name="employ_name" id="employ_name" class="form-control" placeholder="Name of Company..." value="<?=$emp['employer_business']?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                  <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="employ_position">Position</label>
                        <input type="text" name="employ_position" id="employ_position" class="form-control" placeholder="Position..." value="<?=$emp['position_nature']?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                  <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="employ_date">Date Started</label>
                        <input type="text" name="employ_date" id="employ_date" class="form-control bootstrap-datepicker" placeholder="mm/dd/yyyy" value="<?=dateform($emp['date_started'])?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                  <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="employ_date">Date Ended</label>
                        <input type="text" name="employ_end" id="employ_end" class="form-control bootstrap-datepicker" placeholder="mm/dd/yyyy" value="<?=dateform($emp['date_ended'])?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                </div><!-- /.row -->
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="employ_addr">Work Address</label>
                        <input type="text" name="employ_addr" id="employ_addr" class="form-control" placeholder="Complete Address..." value="<?=$emp['address']?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="employ_contact">Contact Number</label>
                      <input type="text" name="employ_contact" id="" class="form-control" value="<?=$emp['tel_no']?>" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="employ_status">Status</label>
                        <input type="text" name="employ_status" id="employ_status" class="form-control" placeholder="Status..." value="<?=$emp['status']?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                </div><!-- /.row -->
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="employ_remarks">Remarks</label>
                      <textarea name="employ_remarks" id="employ_remarks" class="form-control"><?=$emp['remarks']?></textarea>
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 -->
                </div><!-- /.row -->
                <input type="hidden" name="id" value="<?=$this->encryption->encrypt($emp['id'])?>" />
                <input type="hidden" name="acc_id" value="<?=$this->encryption->encrypt($info['id'])?>" />
                <div class="row">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-flat btn-primary pull-right">Update Record</button>
                  </div><!-- /.col-sm-12 -->
                </div><!-- /.row -->
                <?=form_close()?>
              </div><!-- /#employ_update.tab-pane -->
              <div id="employ_delete<?=$emp['id']?>" class="tab-pane">
                <div class="callout callout-danger">
                  <h4><i class="fa fa-warning"></i> Are you sure to delete <?=$emp['employer_business']?>?</h4>
                  <p>Deleting the records of this employer cannot be undone!</p>                  
                  <div class="row">
                    <?=form_open('borrowers/delete_work')?>
                    <div class="col-sm-6">
                      <div class="checkbox">
                        <label>
                          <input name="checkbox" type="checkbox" required/> Yes. I am sure to delete this Record.
                        </label>
                          <input type="hidden" name="id" value="<?=$this->encryption->encrypt($emp['id'])?>" />
                          <input type="hidden" name="acc_id" value="<?=$this->encryption->encrypt($info['id'])?>" />
                          <input type="hidden" name="key" value="<?=$this->encryption->encrypt(0)?>" />
                        <button class="btn btn-danger btn-outline btn-flat btn-sm"><i class="fa fa-trash"></i> Delete</button>
                      </div><!-- /.checkbox -->                      
                    </div><!-- /.col-sm-6 -->
                    <?=form_close()?>
                  </div><!-- /.row -->
                </div><!-- /.callout callout-danger -->
              </div><!-- /#employ_delete.tab-pane -->
            </div><!-- /.tab-content -->
          </div><!-- /.nav-tabs-custom -->
        </div><!-- /.modal-body -->

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php endforeach ?>
  <?php endif ?>


<!-- ///////////////////////// Business Details ///////////////////////// -->

<?php if ($businesses): ?>
  <?php foreach ($businesses as $business): ?>
  <div class="modal fade" id="UpdateBusiness<?=$business['id']?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Business: <?=$business['employer_business']?></h4>
        </div>
        <div class="modal-body">          
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#employ_info<?=$business['id']?>" data-toggle="tab" data-target="#business_info<?=$business['id']?>">Information</a></li>
              <li><a href="#business_update<?=$business['id']?>" data-toggle="tab" data-target="#business_update<?=$business['id']?>">Update</a></li>
              <li><a href="#business_delete<?=$business['id']?>" data-toggle="tab" data-target="#business_delete<?=$business['id']?>">Delete</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="business_info<?=$business['id']?>">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Business Name</strong>
                    <p class="text-muted"><?=$business['employer_business']?></p><!-- /.text-muted -->
                    <hr />
                    <strong>Nature of Business</strong>
                    <p class="text-muted"><?=$business['position_nature']?></p><!-- /.text-muted -->
                    <hr />
                    <strong>Contact Number</strong>
                    <p class="text-muted"><?=$business['tel_no']?></p><!-- /.text-muted -->
                    <hr />
                    <strong>Business Address</strong>
                    <p class="text-muted"><?=$business['address']?></p><!-- /.text-muted -->
                    <hr />          
                  </div><!-- /.col-md-6 -->
                  <div class="col-md-6">
                    <strong>Operating Dates</strong>
                    <p class="text-muted">
                      <?=$business['date_started']?> to <?php if($business['date_ended']){echo $business['date_ended']; } else { echo 'Present'; }?>
                      <?php if ($business['date_ended']): ?>
                        <span class="badge"><?=getAge($business['date_started'], $business['date_ended'])?> yrs</span>
                      <?php else: ?>
                        <span class="badge"><?=getAge($business['date_started'])?> yrs</span>
                      <?php endif ?>
                    </p><!-- /.text-muted -->
                    <hr />     
                    <strong>Status</strong>
                    <p class="text-muted"><?=$business['status']?></p><!-- /.text-muted -->
                    <hr />
                    <strong>Remarks</strong>
                    <p class="text-muted"><?=$business['remarks']?></p><!-- /.text-muted -->   
                  </div><!-- /.col-md-6 -->
                </div><!-- /.row -->             
              </div>

              <div class="tab-pane" id="business_update<?=$business['id']?>">
                <?=form_open('borrowers/update_work')?>
                <div class="row">                
                  <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label for="business_name">Business Name</label>
                        <input type="text" name="business_name" id="business_name" class="form-control" placeholder="Name of Company..." value="<?=$business['employer_business']?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="business_nature">Nature of Business</label>
                        <input type="text" name="business_nature" id="business_nature" class="form-control" placeholder="Nature of Business..." value="<?=$business['position_nature']?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                  <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="business_date">Date Started</label>
                        <input type="text" name="business_date" id="business_date" class="form-control bootstrap-datepicker" placeholder="mm/dd/yyyy" value="<?=dateform($business['date_started'])?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-2 col-sm-12 -->
                  <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="business_date">Date Ended</label>
                        <input type="text" name="business_end" id="business_end" class="form-control bootstrap-datepicker" placeholder="mm/dd/yyyy" value="<?=dateform($business['date_ended'])?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-2 col-sm-12 -->
                </div><!-- /.row -->
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="business_addr">Business Address</label>
                        <input type="text" name="business_addr" id="business_addr" class="form-control" placeholder="Business Address..." value="<?=$business['address']?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="business_contact">Contact Number</label>
                      <input type="text" name="business_contact" id="" class="form-control" value="<?=$business['tel_no']?>" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="business_status">Status</label>
                        <input type="text" name="business_status" id="business_status" class="form-control" placeholder="Status..." value="<?=$business['status']?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-md-4 col-sm-12 -->
                </div><!-- /.row -->
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="business_remarks">Remarks</label>
                      <textarea name="business_remarks" id="business_remarks" class="form-control"><?=$business['remarks']?></textarea>
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 -->
                </div><!-- /.row -->
                <input type="hidden" name="id" value="<?=$this->encryption->encrypt($business['id'])?>" />
                <input type="hidden" name="acc_id" value="<?=$this->encryption->encrypt($info['id'])?>" />
                <div class="row">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-flat btn-primary pull-right">Update Record</button>
                  </div><!-- /.col-sm-12 -->
                </div><!-- /.row -->
                <?=form_close()?>
              </div><!-- /#employ_update.tab-pane -->
              <div id="business_delete<?=$business['id']?>" class="tab-pane">
                <div class="callout callout-danger">
                  <h4><i class="fa fa-warning"></i> Are you sure to delete <?=$business['employer_business']?>?</h4>
                  <p>Deleting the records of this business cannot be undone!</p>

                  <div class="row">
                    <?=form_open('borrowers/delete_work')?>
                    <div class="col-sm-6">
                      <div class="checkbox">
                        <label>
                          <input name="checkbox" type="checkbox" required/> Yes. I am sure to delete this Record.
                        </label>
                          <input type="hidden" name="id" value="<?=$this->encryption->encrypt($business['id'])?>" />
                          <input type="hidden" name="acc_id" value="<?=$this->encryption->encrypt($info['id'])?>" />
                          <input type="hidden" name="key" value="<?=$this->encryption->encrypt(1)?>" />
                        <button class="btn btn-danger btn-outline btn-flat btn-sm"><i class="fa fa-trash"></i> Delete</button>
                      </div><!-- /.checkbox -->                      
                    </div><!-- /.col-sm-6 -->
                    <?=form_close()?>
                  </div><!-- /.row -->
                </div><!-- /.callout callout-danger -->
              </div><!-- /#business_delete.tab-pane -->
            </div><!-- /.tab-content -->
          </div><!-- /.nav-tabs-custom -->
        </div><!-- /.modal-body -->

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php endforeach ?>
  <?php endif ?>



  <!-- ///////////////////////////// Personal Information //////////////////////////////////// -->

  <div class="modal fade" id="personalInfoModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?=form_open('borrowers/Update_PersonalInfo')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Personal Information</h4>
        </div>
        <div class="modal-body">          
            <div class="form-group">
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <label for="fname">First Name</label>
                  <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name..." value="<?=$info['firstname']?>" required>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="mname">Middle Name</label>
                  <input type="text" class="form-control" name="mname" id="mname" placeholder="Enter Middle Name..." value="<?=$info['middlename']?>" required>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="lname">Last Name</label>
                  <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last Name..." value="<?=$info['lastname']?>" required>
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
            </div><!-- /.form-group -->

              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Birth Date:</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control bootstrap-datepicker" name="bdate" id="birthdate" value="<?=dateform($info['birthdate'])?>" placeholder="mm/dd/yyyy">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="sex">Sex</label>
                  <div class="form-group">
                    <div class="col-xs-6">
                      <label>
                          <input type="radio" name="sex" value="1" class="minimal-red" required <?php if($info['sex'])echo 'checked';?>>
                        Male
                      </label>
                    </div><!-- /.col-xs-6 -->
                    <div class="col-xs-6">
                      <label>
                          <input type="radio" name="sex" value="0" class="minimal-red" required <?php if(!$info['sex'])echo 'checked';?>>
                        Female
                      </label>
                    </div><!-- /.col-xs-6 -->                    
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="civil_stat">Civil Status</label>
                  <select name="civil_stat" id="civil_stat" class="form-control" required>
                    <option disabled selected> Select Option...</option>
                    <option value="Single" <?php if($info['civil_status']=='Single')echo'selected';?>>Single</option>
                    <option value="Married" <?php if($info['civil_status']=='Married')echo'selected';?>>Married</option>
                  </select>
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
            
            <fieldset class="group-box">
              <legend class="group-box-title">Birth Place</legend>
              <div class="row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="bplace_bldg">Building / Block / House</label>
                    <input type="text" name="bplace_bldg" class="form-control" id="bplace_bldg" placeholder="Building / Block / House..." value="<?=$info['building']?>" required/>
                  </div>
                </div><!-- /.col-sm-5 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="bplace_strt">Street</label>
                    <input type="text" name="bplace_strt" class="form-control" id="bplace_strt" placeholder="Street..." value="<?=$info['street']?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="bplace_brgy">Barangay</label>
                    <input type="text" name="bplace_brgy" class="form-control" id="bplace_brgy" placeholder="Barangay..." value="<?=$info['barangay']?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="bplace_city">City / Municipality</label>
                    <input type="text" name="bplace_city" class="form-control" id="bplace_city" placeholder="City / Municipality..." value="<?=$info['city']?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="bplace_prov">Province / Region</label>
                    <input type="text" name="bplace_prov" class="form-control" id="bplace_prov" placeholder="Province / Region..." value="<?=$info['province']?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="bplace_zip">Zip Code</label>
                    <input type="text" name="bplace_zip" class="form-control" id="bplace_zip" placeholder="Zip Code..." value="<?=$info['zip']?>" required/>
                  </div>
                </div><!-- /.col-sm-2 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="bplace_ctry">Country</label>
                    <input type="text" name="bplace_ctry" class="form-control" id="bplace_ctry" placeholder="Country..."  value="<?=$info['country']?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
              </div><!-- /.row -->              
            </fieldset><!-- /.group-box -->
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



  <!-- ///////////////////////////// Educational Attainment //////////////////////////////////// -->

  <div class="modal fade" id="EducInfoModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?=form_open('borrowers/Update_Education')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Eductional Attainment</h4>
        </div>
        <div class="modal-body">          
            <div class="row">
              <div class="col-md-7 col-sm-12">
                <fieldset class="group-box">
                  <legend class="group-box-title">Highest Educational Level Attained</legend><!-- /.group-box-title -->
                  <div class="form-group">
                    <div class="col-xs-3">
                      <label>
                        <input type="radio" name="educ_level" value="0" class="minimal-red" <?php if($info['educ_level']==0)echo"checked";?> required>
                        Elem. Grad
                      </label>
                    </div><!-- /.col-xs-3 -->
                    <div class="col-xs-3">
                      <label>
                        <input type="radio" name="educ_level" value="1" class="minimal-red" <?php if($info['educ_level']==1)echo"checked";?> required>
                        High Sch. Grad
                      </label>
                    </div><!-- /.col-xs-4 --> 
                    <div class="col-xs-3">
                      <label>
                        <input type="radio" name="educ_level" value="2" class="minimal-red" <?php if($info['educ_level']==2)echo"checked";?> required>
                        College Grad
                      </label>
                    </div><!-- /.col-xs-3 --> 
                    <div class="col-xs-3">
                      <label>
                        <input type="radio" name="educ_level" value="3" class="minimal-red" <?php if($info['educ_level']==3)echo"checked";?> required>
                        Undergrad
                      </label>
                    </div><!-- /.col-xs-3 --> 
                  </div>
                </fieldset><!-- /.group-box -->
              </div><!-- /.col-md-7 col-sm-12 -->
              <div class="col-md-5 col-sm-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="educ_school">Last School Attended / Graduated</label>
                      <input type="text" name="educ_school" id="educ_school" class="form-control" placeholder="School / University / Academy" value="<?=$info['educ_school']?>" required/>
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 -->
                </div><!-- /.row -->
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="educ_course">Course / Track</label>
                      <input type="text" name="educ_course" id="educ_course" class="form-control" placeholder="Course / Track / Level" value="<?=$info['educ_course']?>" required/>
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 col-md-6 -->
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="educ_year">Year Attended</label>
                      <input type="text" name="educ_year" id="educ_year" class="form-control" placeholder="Attended / Graduated" value="<?=$info['educ_year']?>" required/>
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 col-md-6 -->
                </div><!-- /.row -->
              </div><!-- /.col-md-5 col-sm-12 -->
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


  <!-- ///////////////////////////// Spouse Information //////////////////////////////////// -->

  <div class="modal fade" id="SpouseInfoModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?=form_open('borrowers/Update_Spouse')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Spouse Information</h4>
        </div>
        <div class="modal-body">          
            <div class="form-group">
              <div class="row">
               <div class="col-md-4 col-sm-12">
                  <label for="spouse_fname">Spouse First Name</label>
                  <input type="text" class="form-control" name="spouse_fname" id="spouse_fname" placeholder="Enter First Name..." value="<?=$info['spouse_fname']?>">
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="spouse_mname">Spouse Middle Name</label>
                  <input type="text" class="form-control" name="spouse_mname" id="spouse_mname" placeholder="Enter Middle Name (Maiden)..." value="<?=$info['spouse_mname']?>">
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="spouse_lname">Spouse Last Name</label>
                  <input type="text" class="form-control" name="spouse_lname" id="spouse_lname" placeholder="Enter Last Name (Maiden)..." value="<?=$info['spouse_lname']?>">
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
            </div><!-- /.form-group -->

              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Birth Date:</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="spouse_bdate" class="form-control bootstrap-datepicker" id="spouse_bdate" value="<?=dateform($info['spouse_bdate'])?>" placeholder="mm/dd/yyyy" />
                    </div>
                    <!-- /.input group -->
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-8 col-sm-12">
                  <div class="form-group">
                    <label for="spouse_bplace">Spouse Birth Place</label>     
                    <input type="text" name="spouse_bplace" id="spouse_bplace" class="form-control" value="<?=$info['spouse_bplace']?>" />              
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->

              <div class="row">
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="spouse_contact">Contact Number</label>     
                    <input type="text" class="form-control" id="spouse_contact" name="spouse_contact" value="<?=$info['spouse_contact']?>"  data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask> 
                  </div>
                </div><!-- /.col-md-3 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="spouse_occupation">Current Occupation</label>     
                    <input type="text" name="spouse_occupation" id="spouse_occupation" class="form-control" value="<?=$info['spouse_occupation']?>" />   
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="spouse_occuaddr">Occupation Address</label>     
                    <input type="text" name="spouse_occuaddr" id="spouse_occuaddr" class="form-control" value="<?=$info['spouse_work']?>" />              
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
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

    //Initialize input mask
    $('[data-mask]').inputmask();

    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    });

    //Date picker
    $('input[type="text"].bootstrap-datepicker').datepicker({
      autoclose: true
    });


    //enable new address in UpdateCurrentAddr
    
    function enable_new() {
      if(document.getElementById("new_address").checked == true) {

        console.log("checked");

        
        //enable fields
        document.getElementById("addr_list").disabled = true;

        document.getElementById("new_addr_bldg").disabled = false;
        document.getElementById("new_addr_strt").disabled = false;
        document.getElementById("new_addr_brgy").disabled = false;
        document.getElementById("new_addr_city").disabled = false;
        document.getElementById("new_addr_prov").disabled = false;
        document.getElementById("new_addr_zip").disabled = false;
        document.getElementById("new_addr_ctry").disabled = false; 

      } else {

        console.log("unchecked");
        //disable fields
        
        document.getElementById("addr_list").disabled = false;   

        document.getElementById("new_addr_bldg").disabled = true;
        document.getElementById("new_addr_strt").disabled = true;
        document.getElementById("new_addr_brgy").disabled = true;
        document.getElementById("new_addr_city").disabled = true;
        document.getElementById("new_addr_prov").disabled = true;
        document.getElementById("new_addr_zip").disabled = true;
        document.getElementById("new_addr_ctry").disabled = true;
      }


    }

    </script>
  
</body>
</html>
