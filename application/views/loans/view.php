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
        <?=$title?> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>">Dashboard</a></li>
        <li><a href="<?=base_url('borrowers')?>">Borrowers</a></li>
        <li><a href="<?=base_url('borrowers/view/'.$info['id'])?>"><?=$info['name']?></a></li>
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
        <?php if ($loan['status']==1 && $loan['due_date'] <= unix_to_human(now(), 'eu', TRUE)):?>
          <div class="callout callout-danger">
            <h4><i class="fa fa-warning"></i> OVERDUE</h4>
            <p>This Loan Application is on its due! Please Remind the Borrower</p>
          </div><!-- /.callout callout-danger -->
        <?php endif ?>
        </div><!-- /.col-xs-12 -->
      </div><!-- /.row -->


      <div class="row">        
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li <?php if(!($flash_settings))echo'class="active"'?>><a href="#application" data-toggle="tab">Application Information</a></li>
              <li><a href="#personal" data-toggle="tab">Account Information</a></li>
              <li><a href="#files" data-toggle="tab">File Archive</a></li>
              <li><a href="#payments" data-toggle="tab">Payments</a></li>
              <li><a href="#activity" data-toggle="tab">Activity Logs</a></li>
            </ul>
            <div class="tab-content">

              <!-- /////////////////////////////////////////////// Application Information //////////////////////////////////////////////// -->
              <div class="tab-pane <?php if(!($flash_settings))echo'active';?>" id="application">

                  <div class="row">
                    <div class="col-md-12">
                      <?php if ($loan['status']==0): ?>
                        <div class="callout callout-danger">
                          <h4><i class="fa fa-info-circle"></i> Pending for Approval</h4>
                          <p>This Loan Request is pending for Admin Approval.</p>
                        </div><!-- /.callout callout-gray -->
                      <?php elseif($loan['status']==2): ?>
                        <div class="callout bg-navy">
                          <h4><i class="fa fa-warning"></i> Loan Disapproved</h4>
                          <p>Oops! This Loan Request has been disapproved.</p>
                        </div><!-- /.callout callout-gray -->
                      <?php endif ?>
                    </div><!-- /.col-md-12 -->
                  </div><!-- /.row -->
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-condensed table-dark-border">
                        <tr>
                          <th colspan="6">Loan Information</th>
                        </tr>
                        <tr>
                          <th>Loan ID</th>
                          <td class="bg-warning"><?=$loan['id']?></td>
                          <th>Registered</th>
                          <td class="bg-warning"><?=$loan['created_at']?></td>
                          <th>Status</th>
                          <td class="bg-warning">
                            <?php if ($loan['status']==0): ?>
                              <span class="badge bg-red">Pending</span>
                            <?php elseif($loan['status']==1): ?>                      
                              <?=$loan['approved_at']?>
                              <span class="badge bg-green">Approved</span>
                            <?php elseif($loan['status']==2): ?>                      
                              <span class="badge bg-navy">Declined</span>
                            <?php elseif($loan['status']==3): ?>                      
                              <span class="badge bg-blue">Closed</span>
                            <?php elseif($loan['status']==4): ?>                      
                              <span class="badge bg-black">Cancelled</span>
                            <?php endif ?>

                          </td>
                        </tr>
                        <tr>
                          <th>Borrower</th>
                          <td colspan="5" class="bg-warning"><?=$info['name']?></td>
                        </tr>
                        <tr>
                          <th>Requested Amount</th>
                          <td width="20%" class="bg-warning"><?=moneytize($loan['borrowed_amount'])?></td>
                          <th>Days of Period / Due date</th>
                          <td width="20%" class="bg-warning"><?=$loan['due_days']?> days | <?=$loan['due_date']?></td>
                          <th>Rate(%) per Annum</th>
                          <td width="20%" class="bg-warning"><?=$loan['borrowed_percentage']?></td>
                        </tr>
                        <tr>
                          <th>Guarantors: </th>
                          <td colspan="5" class="bg-warning">
                            <?php if ($creditors): ?>
                              <ol>
                              <?php foreach ($creditors as $cred): ?>
                                <li><?=$cred['fullname']?> - <?=$cred['address']?> | Remarks: <?=$cred['remarks']?></li>
                              <?php endforeach ?>
                              </ol>
                            <?php endif ?>
                          </td>
                        </tr>
                      </table><!-- /.table table-condensed table-dark-border -->

                      <?php if ($schedules): ?>
                      <table class="table table-condensed table-dark-border">
                        <thead>
                          <tr>
                            <th colspan="6">Payment Schedules</th>
                          </tr>
                          <tr>
                            <th width="2%"></th>
                            <th>Schedule</th>
                            <th>Due Amount</th>
                            <th class="bg-success">Paid Amount</th>
                            <th class="bg-success">Balance</th>
                            <th class="bg-success">Date Paid</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $totPaid[] = 0;
                          $totAmt[] = 0;
                          $totBal[] = 0;
                          $x = 1;
                          foreach ($schedules as $sched): ?>
                          <tr>
                            <?php 
                            $balance = $sched['amount'] - $sched['paid_actual'];
                            $totBal[] = $balance;
                            $totAmt[] = $sched['amount'];
                            $totPaid[] = $sched['paid_actual'];
                            ?>
                            <td><?=$x++?></td>
                            <td><?=date('Y-m-d (D M, d)', strtotime($sched['schedule']))?></td>
                            <td class="text-danger"><?=moneytize($sched['amount'])?></td>
                            <td class="bg-success"><?=moneytize($sched['paid_actual'])?></td>
                            <td class="bg-success">
                              <?php if ($sched['paid_actual'] < $sched['amount']): ?>                                
                                <strong class="text-danger"><?=moneytize($sched['amount'] - $sched['paid_actual'])?></strong>
                              <?php else: ?>
                                <?=moneytize($balance)?>
                              <?php endif ?>
                            </td>
                            <td class="bg-success"><?=$sched['paid_date']?></td>
                          </tr>
                          <?php endforeach ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="2" class="text-right">TOTAL</th>
                            <td><?=moneytize(array_sum($totAmt))?></td>
                            <td><?=moneytize(array_sum($totPaid))?></td>
                            <td><?=moneytize(array_sum($totBal))?></td>
                            <td></td>
                          </tr>
                        </tfoot>
                      </table><!-- /.table table-condensed table-dark-border -->                        
                      <?php endif ?>
                    </div><!-- /.col-md-12 -->
                  </div><!-- /.row -->
                  <?php if ($loan['status']==1): ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h5 class="box-title">Loan Ledger</h5>
                          <div class="box-tools pull-right">
                              <div class="btn-group pull-right">
                                <button type="button" data-toggle="modal" data-target="#AddDebit" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> Add Debit</button>
                                <button type="button" data-toggle="modal" data-target="#AddCredit" class="btn btn-sm btn-default"><i class="fa fa-minus"></i> Add Credit</button>
                              </div>        
                          </div><!-- /.box-tools pull-right -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <hr />
                              <table class="table table-condensed table-striped table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th width="25%">DATE | TIME</th>
                                    <th>CODE</th>
                                    <th width="35%">DESCRIPTION</th>
                                    <th>DEBIT</th>
                                    <th>CREDIT</th>
                                    <th>BALANCE</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $bal=0; if ($ledger): ?>
                                    <?php foreach ($ledger as $ld): ?>
                                    <tr>
                                      <td><span class="badge bg-blue"><?=$ld['user']?></span> <?=$ld['created_at']?></td>
                                      <td><?=$ld['code']?></td>
                                      <td><?=$ld['description']?></td>
                                      <td class="text-danger"><?=moneytize($ld['debit'], '')?></td>
                                      <td class="text-success"><?=moneytize($ld['credit'], '')?></td>
                                      <td class="bg-warning">
                                        <?php
                                          $bal = ($bal + $ld['debit']) - ($ld['credit']);
                                          echo moneytize($bal, '');
                                        ?>
                                      </td>
                                    </tr>
                                    <?php endforeach ?>
                                  <?php endif ?>
                                </tbody>
                              </table><!-- /.table table-condensed table-striped -->
                            </div><!-- /.col-sm-12 -->
                          </div><!-- /.row -->
                        </div><!-- /.box-body -->
                      </div><!-- /.box box-default -->
                    </div><!-- /.col-md-12 -->
                  </div><!-- /.row -->
                  <?php endif ?>
              </div>
              <!-- /.tab-pane -->
              
              <!-- /////////////////////////////////////////////// Account Information //////////////////////////////////////////////// -->

              <div class="tab-pane" id="personal">
                <table class="table table-condensed table-dark-border">
                  <tr>
                    <td colspan="6"><strong>Personal Information</strong></td>
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
                    <td colspan="6"><strong>Spouse Information</strong></td>
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
                    <td colspan="6"><strong>Educational Attainment</strong></td>
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
                    <td><strong>Current Address</strong></td>
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
                        <?php endforeach ?>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <th width="18%">Contact Numbers</th>
                    <td class="bg-warning">
                      <ul>
                        <?php if ($mobiles): ?>
                        <?php foreach ($mobiles as $mob): ?>
                        <li><?=$mob['value']?></li>
                        <?php endforeach ?>
                        <?php endif ?>
                      </ul>
                    </td>
                    <th width="15%">Email Addresses</th>
                    <td class="bg-warning">
                      <ul>
                        <?php if ($emails): ?>
                        <?php foreach ($emails as $email): ?>
                        <li><?=$email['value']?></li>
                        <?php endforeach ?>
                        <?php endif ?>
                      </ul>
                    </td>
                  </tr>
                </table><!-- /.table .table-condensed table-dark-border -->

                <table class="table table-condensed table-dark-border">
                  <tr>
                    <th colspan="4">Monthly Income and Expenses</th>
                  </tr>
                  <tr>
                    <td width="5%"></td>
                    <th colspan="3">Income</th>
                  </tr>
                  <?php $totInc[]=0; if ($income): ?>
                  <?php $x=1; foreach ($income as $inc): ?>
                  <tr>
                    <?php $totInc[] = $inc['amount']; ?>
                    <td colspan="2" width="10%"></td>
                    <td><?=$x++?>. <?=$inc['title']?></td>
                    <td width="50%" class="bg-warning"><?=moneytize($inc['amount'])?></td>
                  </tr>
                  <?php endforeach ?>
                  <?php endif ?>
                  <tr>
                    <th colspan="3" class="text-right">TOTAL:</th>
                    <td><?=moneytize(array_sum($totInc))?></td>
                  </tr>
                  <tr>
                    <td colspan="4"></td>
                  </tr>
                  <tr>
                    <td width="5%"></td>
                    <th colspan="3">Expenses</th>
                  </tr>
                  <?php $totExp[]=0; if ($expenses): ?>
                  <?php $x=1; foreach ($expenses as $exp): ?>
                  <tr>
                    <?php $totExp[] = $exp['amount']; ?>
                    <td colspan="2" width="10%"></td>
                    <td><?=$x++?>. <?=$exp['title']?></td>
                    <td width="50%" class="bg-warning"><?=moneytize($exp['amount'])?></td>
                  </tr>
                  <?php endforeach ?>
                  <?php endif ?>
                  <tr>
                    <th colspan="3" class="text-right">TOTAL:</th>
                    <td><?=moneytize(array_sum($totExp))?></td>
                  </tr>
                </table><!-- /.table .table-condensed table-dark-border -->             
              </div>
              
              <!-- //////////////////////////////////// FILE ARCHIVE ///////////////////////////////// -->
              <div class="tab-pane <?php if($flash_settings)echo'active'?>" id="files">
                  
                    <?php if ($files): ?>
                    <table class="table table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>TITLE</th>
                        <th>DESCRIPTION</th>
                        <th>DATE | TIME</th>
                      </tr>
                    </thead>
                    <?php foreach ($files as $file): ?>
                      <tr>
                        <td><a href="#" data-toggle="modal" data-target="#file<?=$file['id']?>"><?=$file['title']?></a></td>
                        <td><a href="#" data-toggle="modal" data-target="#file<?=$file['id']?>"><?=$file['description']?></a></td>
                        <td><a href="#" data-toggle="modal" data-target="#file<?=$file['id']?>"><?=$file['created_at']?></a></td>
                      </tr>
                    <?php endforeach ?>
                    </table><!-- /.table table-striped table-condensed -->
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="pull-right">
                          <a href="#" class="btn btn-default" data-toggle="modal" data-target="#AddFile"><i class="fa fa-upload"></i> Upload New File</a>                        
                          <a href="<?=base_url('loans/download/'.$loan['id'])?>" class="btn btn-default"><i class="fa fa-download"></i> Download Archive</a>
                        </div><!-- /.pull-right -->                        
                      </div><!-- /.col-sm-12 -->
                    </div><!-- /.row -->
                    <?php else: ?>
                      <div class="well">
                        <h4>Opps! No files found!</h4>
                        <p><a href="#" data-toggle="modal" data-target="#AddFile">Click here</a> to upload a file!</p>
                      </div><!-- /.well -->
                    <?php endif ?>
              </div>
              <!-- /.tab-pane -->
              <!-- //////////////////////////////////// ACTIVITY LOGS ///////////////////////////////// -->              
              <div class="tab-pane" id="payments">
                <h4 class="title">Payments</h4>
                <?php if ($payments): ?>
                <table class="table table-condensed table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>PAYEE</th>
                      <th>DESCRIPTION</th>
                      <th>AMOUNT</th>
                      <th>DATE | TIME</th>
                      <th>USER</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($payments as $pay): ?>
                    <tr>
                      <?php $totPay[] = $pay['amount']; ?>
                      <td><a href="<?=base_url('payments/view/'.$pay['id'])?>"><?=$pay['id']?></a></td>
                      <td><a href="<?=base_url('payments/view/'.$pay['id'])?>"><?=$pay['payee']?></a></td>
                      <td><a href="<?=base_url('payments/view/'.$pay['id'])?>"><?=ellipsize($pay['description'], 20, 1)?></a></td>
                      <td class="bg-danger"><a href="<?=base_url('payments/view/'.$pay['id'])?>"><?=moneytize($pay['amount'])?></a></td>
                      <td><a href="<?=base_url('payments/view/'.$pay['id'])?>"><?=$pay['created_at']?></a></td>
                      <td><a href="<?=base_url('payments/view/'.$pay['id'])?>"><span class="badge bg-blue"><?=$pay['name']?></span></a></td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="3" class="text-right">TOTAL:</th>
                      <td><?=moneytize(array_sum($totPay))?></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table><!-- /.table table-condensed -->
                <?php else: ?>
                  <div class="well">               
                    <h4><i class="icon fa fa-warning"></i> No records found!</h4>         
                    No Payment Records found in the system.
                  </div>
                <?php endif ?>                
              </div>
              <!-- /.tab-pane -->
              <!-- //////////////////////////////////// ACTIVITY LOGS ///////////////////////////////// -->              
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
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->

          <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header">
                  <h5 class="box-title"><i class="fa fa-pencil-square-o"></i> Notes</h5> 
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-default btn-box-tool" data-target="#AddNote" data-toggle="modal"><i class="fa fa-plus"></i> Add Note</button>            
                  </div><!-- /.box-tools pull-right -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php if ($notes): ?>
                  <?php foreach ($notes as $note): ?>
                  <div class="callout callout-info">
                    <p><em><strong>
                      <?php if ($note['user']): ?>
                        <?=$note['name']?>
                      <?php else: ?>
                        System
                      <?php endif ?>
                    </strong> - <?=$note['created_at']?></em>
                    <?php if ($note['user']==$user['username']): ?>
                    <span class="pull-right">
                      <a href="#" data-toggle="modal" data-target="#UpdateNote<?=$note['id']?>"><i class="fa fa-cog"></i></a>
                    </span>
                    <?php endif ?>
                    </p>
                    <p><?=$note['description']?></p>
                  </div><!-- /.callout callout-info --> 
                  <?php endforeach ?>
                  <?php else: ?>
                    <em>No notes found! <a href="#" data-toggle="modal" data-target="#AddNote">Click here to Add a Note!</a></em>
                  <?php endif ?>
                </div><!-- /.box-body -->
              </div><!-- /.box box-default -->
            </div><!-- /.col-md-12 -->
          </div><!-- /.row -->
        </div>
        <!-- /.col-md-9 -->
        <div class="col-md-3">

          <div class="box box-danger">
            <div class="box-body">
              <img src="<?=base_url('code/qr/'.$info['id'].'/8')?>" alt="" class="img-thumbnail" style="margin:auto; display: block" />
            </div><!-- /.box-body -->
          </div><!-- /.box box-danger -->

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
                  <b>Loan ID</b> <a class="pull-right"><?=$loan['id']?></a>
                </li>
                <li class="list-group-item">
                  <b>Requested Amount</b> <a class="pull-right"><?=moneytize($loan['borrowed_amount'])?></a>
                </li>
                <li class="list-group-item">
                  <b>Interest</b> <a class="pull-right"><?=moneytize($loan['borrowed_amount']*($loan['borrowed_percentage']/100))?></a>
                </li>
                <li class="list-group-item">
                  <b>Total Payable</b> <a class="pull-right"><?=moneytize($loan['borrowed_amount'] + $loan['borrowed_amount']*($loan['borrowed_percentage']/100))?></a>
                </li>
                <li class="list-group-item">
                  <b>Date Registered</b> <a class="pull-right"><?=$loan['created_at']?></a>
                </li>
                <li class="list-group-item">
                  <b>Last Activity</b> <a class="pull-right"><?=$loan['updated_at']?></a>
                </li>  
                <?php if($loan['status']==0 && $user['user_level'] > 8): ?>
                <li class="list-group-item">
                  <a href="#" data-target="#ApproveLoan" data-toggle="modal" class="btn btn-success btn-block btn-flat"><i class="fa fa-check"></i> Approve Loan</a>
                </li>
                <li class="list-group-item">
                  <a href="#" data-target="#UpdateRequest" data-toggle="modal" class="btn btn-flat btn-warning btn-block"><i class="fa fa-edit"></i> Update Request</a>                  
                </li><!-- /.list-group-item -->
                <?php endif; ?>  
                <?php if ($loan['status']==1 && $ledger): ?>
                <li class="list-group-item">
                  <a href="#" data-target="#AddPayment" data-toggle="modal" class="btn btn-success btn-block btn-flat"><i class="fa fa-money"></i> Add Payment</a>
                </li>                
                <?php elseif(($loan['status']==1 || $loan['status']==0) && $user['user_level'] > 8): ?>
                <li class="list-group-item">
                  <a href="#" data-target="#DisapproveLoan" data-toggle="modal" class="btn bg-navy btn-block btn-flat"><i class="fa fa-ban"></i> Disapprove Loan</a>
                </li>                
                <?php endif; ?>  
                <?php if ($loan['status'] == 1 && !$ledger): ?>
                <li class="list-group-item">
                  <a href="#" data-target="#disburse" data-toggle="modal" class="btn btn-success btn-block btn-flat"><i class="fa fa-money"></i> Disburse Cash</a>
                </li>
                <?php endif ?>
                <li class="list-group-item">
                  <a href="<?=current_url()?>/print" target="_blank" class="btn btn-primary btn-block btn-flat"><i class="fa fa-print"></i> Print Loan Application</a>
                </li>
                <li class="list-group-item">
                  <a href="<?=current_url()?>/print/statement" target="_blank" class="btn btn-primary btn-block btn-flat"><i class="fa fa-print"></i> Print Statement</a>
                </li>
                                       
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col-md-3 -->
      </div>
      <!-- /.row -->

    </section>
  </div>
  <!-- /.content-wrapper -->


  <?php if($loan['status']==0 && $user['user_level'] > 8): ?>
  <!-- ///////////////////////// Approbe Loan ////////////////////////////// -->
  <div class="modal fade" id="ApproveLoan">
    <div class="modal-dialog">
      <div class="modal-content">
        <?=form_open('loans/loan_status')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Approve Loan</h4>
        </div>
        <div class="modal-body">               
          <div class="row">
            <div class="col-md-6">
              <div class="callout callout-info">
                <p><i class="fa fa-warning"></i> You are to approve this loan of <?=$info['name']?></p>
                <p><i class="fa fa-info-circle"></i> You cannot undo any action!</p>
              </div><!-- /.callout callout-info -->    
               <div class="form-group">
                <label for="">Requested Amount</label>
                <input type="text" id="" class="form-control input-lg" disabled="" value="<?=moneytize($loan['borrowed_amount'])?>" />
              </div><!-- /.form-group -->
              <div class="form-group">
                <label for="">Interest(<?=$loan['borrowed_percentage']?>%)</label>
                <input type="text" id="" class="form-control input-lg" disabled="" value="<?=moneytize($loan['borrowed_amount']*($loan['borrowed_percentage']/100))?>" />
              </div><!-- /.form-group -->
              <div class="form-group">
                <label for="">Total Payables</label>
                <input type="text" id="" class="form-control input-lg" disabled="" value="<?=moneytize(($loan['borrowed_amount'])+(($loan['borrowed_amount']*($loan['borrowed_percentage']/100))))?>" />
              </div><!-- /.form-group -->        
              <div class="form-group">
                <label for="description">Approval Remarks</label>
                <textarea name="description" class="form-control" id="description" rows="5" required></textarea>
              </div><!-- /.form-group -->
            </div><!-- /.col-md-6 -->
            <div class="col-md-6">
              <table class="table table-condensed table-dark-bordered">
                <thead>
                  <tr>
                    <th colspan="2">PAYMENT SCHEDULE (as per today's approval)</th>
                  </tr>
                  <tr>
                    <th>Schedule</th>
                    <th>Due Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pre_sched as $ps): ?>
                    <tr>
                      <td><?=$ps['schedule']?></td>
                      <td><?=$ps['amount']?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table><!-- /.table table-condensed table-dark-bordered -->
            </div><!-- /.col-md-6 -->
          </div><!-- /.row -->
        </div>
        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($loan['id'])?>" />
        <input type="hidden" name="key" value="<?=$this->encryption->encrypt('approve')?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-check"></i> Approve Loan</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- ///////////////////////// Update Request ////////////////////////////// -->
  <div class="modal fade" id="UpdateRequest">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?=form_open('loans/update')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Loan Application</h4>
        </div>
        <div class="modal-body">   
          <div class="row">
            <div class="col-md-8">
              <div class="callout callout-info">              
              <p><i class="fa fa-exclamation-circle"></i> <strong>ATTENTION!</strong> <br />
              This Loan Application is subject for Approval. <br />
              After submitting this application, please print and sign the formal document.</p>
              <p><i class="fa fa-info-circle"></i> Please fill up all the important fields</p>
            </div><!-- /.callout callout-info -->       
            <hr />
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="">Borrower</label>
                  <input type="text" name="" id="" class="form-control input-lg" value="<?=$info['name']?>" disabled/>
                </div><!-- /.form-group -->
              </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="">Amount</label>
                  <input type="number" name="loan_amount" id="loan_amount" value="<?=$loan['borrowed_amount']?>" class="form-control input-lg"/>
                </div><!-- /.form-group -->
              </div><!-- /.col-sm-4 -->
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="">Days of Due</label>
                  <input type="number" name="loan_days" id="loan_days" value="<?=$loan['due_days']?>" class="form-control input-lg"/>
                </div><!-- /.form-group -->
              </div><!-- /.col-sm-4 -->
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="">Interest Rate</label>
                  <input type="number" step=".05" name="loan_rate" id="loan_rate" value="<?=$loan['borrowed_percentage']?>" max="100" class="form-control input-lg" value="8.5" />
                </div><!-- /.form-group -->
              </div><!-- /.col-sm-4 -->
            </div><!-- /.row -->
            <hr />
            <p><strong>Monthly Income and Expenses of the Borrower:</strong></p>
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <table class="table table-bordered table-condensed">
                  <tr>
                    <th colspan="2">Income</th>
                  </tr>
                  <?php $y=1; $totInc=array(); foreach($income as $inc): ?>
                  <tr>
                    <?php $totInc[] = $inc['amount']; ?>
                    <th><?=$y++.'. '.$inc['title']?></th>
                    <td width="30%"><input type="number" class="integer income" value="<?=$inc['amount']?>" name="income[<?=$inc['id']?>]"/></td>
                  </tr>
                  <?php endforeach; ?>
                  <tr>
                    <th class="text-right">TOTAL</th>
                    <td id="total_income" class="bg-info"><?=decimalize(array_sum($totInc))?></td>
                  </tr>
                </table><!-- /.table table-bordered table-condensed -->

                <table class="table table-bordered table-condensed">
                  <tr>
                    <th colspan="2" class="bg-danger italic">Expenses (Less)</th>
                  </tr>
                  <?php $x=1; $totExp=array(); foreach($expenses as $exp): ?>
                  <tr>
                    <?php $totExp[] = $exp['amount']; ?>
                    <th><?=$x++.'. '.$exp['title']?></th>
                    <td width="30%"><input type="number" class="integer expense" value="<?=$exp['amount']?>" name="expense[<?=$exp['id']?>]"/></td>
                  </tr>
                  <?php endforeach; ?>
                  <tr>
                    <th class="text-right">TOTAL</th>
                    <td id="total_expense" class="bg-info"><?=decimalize(array_sum($totExp))?></td>
                  </tr>
                </table><!-- /.table table-bordered table-condensed -->
              </div><!-- /.col-md-6 col-md-3-offset -->
            </div><!-- /.row -->
            <hr />
            <p><strong>Summary of other Outstanding Obligations</strong></p>
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <em>Clear the name to delete a guarantor</em>
                  <?php foreach ($creditors as $cred): ?>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Name of Guarantor</label>
                        <input type="text" name="creditors_name[<?=$cred['id']?>]" value="<?=$cred['fullname']?>" class="form-control" />
                      </div><!-- /.form-group -->  
                    </div><!-- /.col-sm-4 -->
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" name="creditors_address[<?=$cred['id']?>]" value="<?=$cred['address']?>" class="form-control" />
                      </div><!-- /.form-group -->  
                    </div><!-- /.col-sm-4 -->
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Remarks</label>
                        <input type="text" name="creditors_remarks[<?=$cred['id']?>]" value="<?=$cred['remarks']?>" class="form-control" />
                      </div><!-- /.form-group -->  
                    </div><!-- /.col-sm-2 -->
                  </div><!-- /.row -->
                  <?php endforeach ?>
                  <hr />
                  <strong>Add Guarantor</strong>
                  <div class="row" id="creditors">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Name of Guarantor</label>
                        <input type="text" name="new_creditors_name[]" class="form-control" />
                      </div><!-- /.form-group -->  
                    </div><!-- /.col-sm-4 -->
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" name="new_creditors_address[]" class="form-control" />
                      </div><!-- /.form-group -->  
                    </div><!-- /.col-sm-4 -->
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Remarks</label>
                        <input type="text" name="new_creditors_remarks[]" class="form-control" />
                      </div><!-- /.form-group -->  
                    </div><!-- /.col-sm-2 -->
                  </div><!-- /.row -->
                   <div class="row">
                    <div class="col-sm-12">
                      <button type="button" class="btn btn-default btn-sm pull-right" id="add_creditor"><i class="fa fa-plus"></i> Add Guarantor</button>
                    </div><!-- /.col-sm-12 -->
                  </div><!-- /.row -->
              </div><!-- /.col-md-10 col-md-offset-1 -->
            </div><!-- /.row -->
            <hr />
            </div><!-- /.col-md-8 -->
            <div class="col-md-4">

              <table class="table table-striped table-dark-border">
                <thead>
                  <tr>
                    <th colspan="2">Interest</th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <input type="text" id="service_interest" class="form-control" placeholder="Interest..." value="<?=decimalize($loan['borrowed_amount']*($loan['borrowed_percentage']/100))?>" disabled="" />
                    </td>
                  </tr>
                  <tr>
                    <th colspan="2">Total Payable</th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <input type="text" id="payable" class="form-control" placeholder="Total Payables..." value="<?=decimalize($loan['borrowed_amount']+($loan['borrowed_amount']*($loan['borrowed_percentage']/100)))?>" disabled="" />
                    </td>
                  </tr>
                  <tr>
                    <th colspan="2">Service Charge (5%)</th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <input type="text" id="service_charge" class="form-control" placeholder="Service Charge..."  value="<?=decimalize($loan['borrowed_amount']*(5/100))?>" disabled="" />
                    </td>
                  </tr>
                  <tr>
                    <th colspan="2">Approx. Date of Approval</th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <input type="text" id="approve_date" class="form-control bootstrap-datepicker" placeholder="Approx. Date of Approval" />
                    </td>
                  </tr>
                  <tr>
                    <th colspan="2">PAYMENT SCHEDULES</th>
                  </tr>
                  <tr>
                    <th>Date</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody id="payment_table">
                </tbody>
              </table><!-- /.table table-striped table-dard-border -->
            </div><!-- /.col-md-4 -->
          </div><!-- /.row -->
        </div>

        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($loan['id'])?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-warning">Update Request</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php endif; ?>  

  <?php if ($loan['status']==1 && $ledger): ?>

  <?php elseif(($loan['status']==1 || $loan['status']==0) && $user['user_level'] > 8): ?>
  <!-- ///////////////////////// Disapprove Loan ////////////////////////////// -->
  <div class="modal fade" id="DisapproveLoan">
    <div class="modal-dialog">
      <div class="modal-content">
        <?=form_open('loans/loan_status')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Disapprove Loan</h4>
        </div>
        <div class="modal-body">   
            <div class="callout callout-info">
              <p><i class="fa fa-info-circle"></i> You cannot undo any action!</p>
            </div><!-- /.callout callout-info -->
            <div class="form-group">
              <label for="description">Disapproval Remarks</label>
              <textarea name="description" class="form-control" id="description" rows="10" required></textarea>
            </div><!-- /.form-group -->
        </div>
        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($loan['id'])?>" />
        <input type="hidden" name="key" value="<?=$this->encryption->encrypt('disapprove')?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-ban"></i> Disapprove Loan</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php endif; ?>     


  <?php if ($loan['status'] == 1 && !$ledger): ?>
  <!-- ///////////////////////// Disburse Cash ////////////////////////////// -->
  <div class="modal fade" id="disburse">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <?=form_open('loans/disburse')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Disburse Cash</h4>
        </div>
        <div class="modal-body">   
          <div class="row">
            <div class="col-md-12">
              <div class="callout callout-info">
                <p><i class="fa fa-info"></i> You are to Disburse Cash</p>
              </div><!-- /.callout callout-info -->
              <div class="form-group">
                <label for="">Requested Amount</label>
                <input type="text" id="" class="form-control input-lg" disabled="" value="<?=moneytize($loan['borrowed_amount'])?>" />
              </div><!-- /.form-group -->
              <div class="form-group">
                <label for="">Service Charge</label>
                <input type="text" id="" class="form-control input-lg" disabled="" value="<?=moneytize(($loan['borrowed_amount'])*0.05)?>" />
              </div><!-- /.form-group -->
              <div class="form-group">
                <label for="">Actual Disbursement</label>
                <input type="text" id="" class="form-control input-lg" disabled="" value="<?=moneytize(($loan['borrowed_amount'])-(($loan['borrowed_amount'])*0.05))?>" />
              </div><!-- /.form-group -->
            </div><!-- /.col-md-12 -->
          </div><!-- /.row -->
        </div>
        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($loan['id'])?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-check"></i> Disburse Cash</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php endif ?>

  <!-- ///////////////////////// Add Debit ////////////////////////////// -->
  <div class="modal fade" id="AddDebit">
    <div class="modal-dialog">
      <div class="modal-content">
        <?=form_open('loans/add_ledger')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Debit</h4>
        </div>
        <div class="modal-body">   
            <div class="callout callout-info">
              <p><i class="fa fa-info-circle"></i> All inputs provided are as is final. You cannot undo any action!</p>
            </div><!-- /.callout callout-info -->
            <div class="row">
              <div class="col-sm-4 col-md-3">
                <label for="code">Code</label>
                <select name="code" id="code" class="form-control">
                  <option disabled selected>Code...</option>
                  <?php if ($ledger_debit): ?>
                  <?php foreach ($ledger_debit as $ldb): ?>
                    <option value="<?=$ldb['code']?>"><?=$ldb['code']. ' - '. $ldb['description']?></option>
                  <?php endforeach ?>
                  <?php endif ?>
                </select>
              </div><!-- /.col-sm-4 col-md-4 -->
              <div class="col-sm-4 col-md-3">
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="text" name="amount" class="form-control integer" id="amount" placeholder="50.00" />
                </div><!-- /.form-group -->
              </div><!-- /.col-sm-4 col-md-3 -->
              <div class="col-sm-4 col-md-6">
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" name="description" id="description" class="form-control" placeholder="Description / Official Receipt / Note..." />
                </div><!-- /.form-group -->
              </div><!-- /.col-sm-4 col-md-6 -->
            </div><!-- /.row -->
            <div class="row">
              <div class="col-sm-12">
                <div class="checkbox pull-right">
                  <label>
                    <input type="checkbox" id="" required /> I have verified all the inputs
                  </label>
                </div><!-- /.checkbox -->
              </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->
        </div>
        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($loan['id'])?>" />
        <input type="hidden" name="key" value="<?=$this->encryption->encrypt('debit')?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-danger">Add Debit</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- ///////////////////////// Add Debit ////////////////////////////// -->
  <div class="modal fade" id="AddCredit">
    <div class="modal-dialog">
      <div class="modal-content">
        <?=form_open('loans/add_ledger')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Credit</h4>
        </div>
        <div class="modal-body">   
            <div class="callout callout-info">
              <p><i class="fa fa-info-circle"></i> All inputs provided are as is final. You cannot undo any action!</p>
            </div><!-- /.callout callout-info -->
            <div class="row">
              <div class="col-sm-4 col-md-3">
                <label for="code">Code</label>
                <select name="code" id="code" class="form-control" required>
                  <option disabled selected>Code...</option>
                  <?php if ($ledger_credit): ?>
                  <?php foreach ($ledger_credit as $ldc): ?>
                    <option value="<?=$ldc['code']?>"><?=$ldc['code']. ' - '. $ldc['description']?></option>
                  <?php endforeach ?>
                  <?php endif ?>
                </select>
              </div><!-- /.col-sm-4 col-md-4 -->
              <div class="col-sm-4 col-md-3">
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="text" name="amount" class="form-control integer" id="amount" placeholder="50.00"  required/>
                </div><!-- /.form-group -->
              </div><!-- /.col-sm-4 col-md-3 -->
              <div class="col-sm-4 col-md-6">
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" name="description" id="description" class="form-control" placeholder="Description / Official Receipt / Note..."  required/>
                </div><!-- /.form-group -->
              </div><!-- /.col-sm-4 col-md-6 -->
            </div><!-- /.row -->
            <div class="row">
              <div class="col-sm-12">
                <div class="checkbox pull-right">
                  <label>
                    <input type="checkbox" id="" required /> I have verified all the inputs
                  </label>
                </div><!-- /.checkbox -->
              </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->
        </div>
        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($loan['id'])?>" />
        <input type="hidden" name="key" value="<?=$this->encryption->encrypt('credit')?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-success">Add Credit</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- ///////////////////////// Add Files ////////////////////////////// -->
  <div class="modal fade" id="AddFile">
    <div class="modal-dialog">
      <div class="modal-content">
        <?=form_open_multipart('files/create')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Upload a File</h4>
        </div>
        <div class="modal-body">   
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" />
          </div><!-- /.form-group -->
          <div class="form-group">
            <label for="description">File Description</label>
            <textarea name="description" id="description" rows="5" class="form-control"></textarea>
          </div><!-- /.form-group -->
          <fieldset class="group-box">
            <legend class="group-box-title">File</legend><!-- /.group-box-title -->
            <div class="row">
              <div class="col-sm-3">
                <label for="">Upload File</label>
              </div><!-- /.col-sm-3 -->
              <div class="col-sm-5">
                <input type="file" name="file" id="file">  
              </div><!-- /.col-sm-5 -->
            </div><!-- /.row -->    
           </fieldset><!-- /.group-box -->
        </div>
        <input type="hidden" name="p" value="<?=$this->encryption->encrypt('borrowers/'.$info['id'].'/loans/'.$loan['id'])?>" />
        <input type="hidden" name="tag_id" value="<?=$this->encryption->encrypt($loan['id'])?>" />
        <input type="hidden" name="tag" value="<?=$this->encryption->encrypt('loan')?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-upload"></i> Upload File</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  
  <!-- ///////////////////////// Files ////////////////////////////// -->
  <?php if ($files): ?>
  <?php foreach ($files as $file): ?>
  <div class="modal fade" id="file<?=$file['id']?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><?=$file['title']?></h4>
        </div>
        <div class="modal-body">   
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#"" data-toggle="tab" data-target="#file_info<?=$file['id']?>">Information</a></li>
              <li><a href="#" data-toggle="tab" data-target="#file_delete<?=$file['id']?>">Delete</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="file_info<?=$file['id']?>">
                <div class="row">
                  <div class="col-md-12">

                    <?php if (isImage($file['url'])): ?>
                      <img src="<?=base_url($file['url'])?>" class="img-thumbnail center file-img" alt="" />
                    <hr />
                    <?php endif; ?>
                    <strong>Title</strong>
                    <p class="text-muted"><?=$file['title']?></p><!-- /.text-muted -->
                    <hr /> 
                    <strong>Description</strong>
                    <p class="text-muted"><?=$file['description']?></p><!-- /.text-muted -->
                    <hr /> 
                    <strong>Uploader</strong>
                    <p class="text-muted"><?=$file['name']?></p><!-- /.text-muted -->
                    <hr />     
                    <strong>Uploaded</strong>
                    <p class="text-muted"><?=$file['created_at']?></p><!-- /.text-muted -->
                    <hr />   
                    <a href="<?=base_url('files/download/'.$file['id'])?>" class="btn btn-flat btn-success btn-block"><i class="fa fa-download"></i> Download File</a> 
                  </div><!-- /.col-md-12 -->
                </div><!-- /.row -->             
              </div>
              <div id="file_delete<?=$file['id']?>" class="tab-pane">
                <div class="callout callout-danger">
                  <h4><i class="fa fa-warning"></i> Are you sure to delete <?=$file['title']?>?</h4>
                  <p>This will be deleted in the database and the storage. This action cannot be undone!</p>

                  <div class="row">
                    <?=form_open('files/delete')?>
                    <div class="col-sm-12">
                      <div class="checkbox">
                        <label>
                          <input name="checkbox" type="checkbox" required/> Yes. I am sure to delete this File.
                        </label>
                          <input type="hidden" name="id" value="<?=$this->encryption->encrypt($file['id'])?>" />
                        <button class="btn btn-danger btn-outline btn-flat btn-sm pull-right"><i class="fa fa-trash"></i> Delete</button>
                      </div><!-- /.checkbox -->                      
                    </div><!-- /.col-sm-6 -->
                    <?=form_close()?>
                  </div><!-- /.row -->
                </div><!-- /.callout callout-danger -->
              </div><!-- /#file_delete.tab-pane -->
            </div><!-- /.tab-content -->
          </div><!-- /.nav-tabs-custom -->
        </div><!-- ./modal-body -->
        <input type="hidden" name="p" value="<?=$this->encryption->encrypt('borrowers/'.$info['id'].'/loans/'.$loan['id'])?>" />
        <input type="hidden" name="tag_id" value="<?=$this->encryption->encrypt($loan['id'])?>" />
        <input type="hidden" name="tag" value="<?=$this->encryption->encrypt('loan')?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php endforeach ?>
  <?php endif ?>



  <!-- ///////////////////////// Add Note ////////////////////////////// -->
  <div class="modal fade" id="AddNote">
    <div class="modal-dialog">
      <div class="modal-content">
        <?=form_open('notes/create')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create Note</h4>
        </div>
        <div class="modal-body">   
          <div class="form-group">
            <label for="description">Note Description</label>
            <textarea name="description" id="description" rows="10" class="form-control"></textarea>
          </div><!-- /.form-group -->
        </div>
        <input type="hidden" name="tag_id" value="<?=$this->encryption->encrypt($loan['id'])?>" />
        <input type="hidden" name="tag" value="<?=$this->encryption->encrypt('loan')?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-success">Save Note</button>
        </div>
      </div>
      <?=form_close()?>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- ///////////////////////// Update Note ////////////////////////////// -->
 <?php if ($notes): ?>
  <?php foreach ($notes as $note): ?>
    <?php if ($note['user'] == $user['username']): ?>
      <div class="modal fade" id="UpdateNote<?=$note['id']?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#" data-toggle="tab" data-target="#update_note<?=$note['id']?>">Update</a></li>
                  <li><a href="#" data-toggle="tab" data-target="#delete_note<?=$note['id']?>">Delete</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="update_note<?=$note['id']?>">
                    <?=form_open('notes/update')?>
                    <div class="form-group">
                      <label for="description">Note Description</label>
                      <textarea name="description" id="description" rows="10" class="form-control"><?=$note['description']?></textarea>
                    </div><!-- /.form-group -->
                    <div class="row">
                      <div class="col-md-12">                    
                        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($note['id'])?>" />
                        <button type="submit" class="btn btn-flat btn-warning pull-right">Update</button>
                      </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->
                    <?=form_close()?>          
                  </div>
                  <div id="delete_note<?=$note['id']?>" class="tab-pane">
                    <?=form_open('notes/delete')?>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" required/>I am sure to delete this Note.
                      </label>
                    </div><!-- /.checkbox -->
                    <div class="row">
                      <div class="col-md-12">                    
                        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($note['id'])?>" />
                        <button type="submit" class="btn btn-flat btn-danger pull-right">Delete</button>
                      </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->
                    <?=form_close()?>          
                  </div><!-- /.callout callout-danger -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    <?php endif ?>
  <?php endforeach ?>
 <?php endif ?>



 <!-- ///////////////////////// Add Payment ////////////////////////////// -->
  <div class="modal fade" id="AddPayment">
    <div class="modal-dialog">
      <div class="modal-content">
        <?=form_open('payments/create')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Payment</h4>
        </div>
        <div class="modal-body">   
          <div class="row">
            <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount" class="form-control input-lg integer" placeholder="500.00" />
              </div><!-- /.form-group -->
            </div><!-- /.col-sm-12 col-md-4 -->
            <div class="col-sm-12 col-md-8">
              <div class="form-group">
                <label for="receipt">Receipt / Invoice No.</label>
                <input type="text" name="receipt" id="receipt" class="form-control" placeholder="#1234567890" />
              </div><!-- /.form-group -->
              <div class="form-group">
                <label for="payee">Payee</label>
                <input type="text" name="payee" id="payee" class="form-control" placeholder="Borrower's Name...." value="<?=$info['name']?>"  required/>
              </div><!-- /.form-group -->
            </div><!-- /.col-sm-12 col-md-8 -->
          </div><!-- /.row -->
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
          </div><!-- /.form-group -->
        </div>
        <input type="hidden" name="id" value="<?=$this->encryption->encrypt($loan['id'])?>" />
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-success">Add Payment</button>
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

    $(document).ready(function(){
      $('#add_creditor').click(function(e) {
              var creditors = $('#creditors').clone();
              $( "#creditors" ).after( creditors );
          });

      <?php if($pay_id): ?>
        $('body').ready(function(e) {      
            window.open("<?=base_url('payments/view/'.$pay_id.'/print')?>", "_blank", "toolbar=no, location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=1000, height=400");
        });
      <?php endif; ?>
    });

    $('.integer').focusout(function(e) {
              var value = $(this).val();
              if(!value) {

              } else {
                value = parseFloat(value).toFixed(2);
                $(this).val(value);
              }
              
    });


    $('.expense').on('change keydown', function(e) {
              var expenses = $('.expense').map(function() { return $(this).val();}).get();
              var total_expense = expenses.reduce((a,b) => +a + +b, 0);

              $('#total_expense').text(parseFloat(total_expense).toFixed(2));
          });

      $('.income').on('change keydown', function(e) {
              var income = $('.income').map(function() { return $(this).val();}).get();
              var total_income = income.reduce((a,b) => +a + +b, 0);

              $('#total_income').text(parseFloat(total_income).toFixed(2));
          });

       $('#loan_amount, #loan_days, #loan_rate, #approve_date').on('load keyup change', function(e) {
              $('#payment_table').children().remove();

               jQuery.support.cors = true;

              var loan_amount = $('#loan_amount').val();
              var loan_days = $('#loan_days').val();
              var loan_rate = $('#loan_rate').val();

              var loan_amount = parseFloat(loan_amount).toFixed(2);
              var loan_rate = parseFloat(loan_rate).toFixed(2);
              var loan_days = parseFloat(loan_days);

              var interest = parseFloat((loan_amount)*(loan_rate/100)).toFixed(2);
              var total = parseFloat(+interest + +loan_amount).toFixed(2);

              var serv_charge = parseFloat(loan_amount * (5/100)).toFixed(2);

              //show service charge and interest
              $('#service_charge').val(serv_charge);
              $('#service_interest').val(interest);
              $('#payable').val(total);

              var start_date = $('#approve_date').val();
              if ((start_date)=="") {
                start_date = "";
              }

    $.ajax(
    {
        type: "GET",
        url: "<?=base_url('loans/Schedules/')?>" + loan_days + "/" + total + "/?start=" + start_date,
        data: "[]",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        success: function (data) {
            
        var trHTML = '';
                
        $.each(data, function (i, item) {
            
            trHTML += '<tr><td>' + data[i].schedule + '</td><td>' + data[i].amount + '</td></tr>';
        });
        
         //     $('#payment_table').append('<tr><td>'+value+'</td></tr>');
        $('#payment_table').append(trHTML);
        
        },
        
        error: function (msg) {
            
           //console.log(msg.responseText);
        }
    });
              
          });

      $('#loan_amount').focusout(function(e) {
              var value = $('#loan_amount').val();
              if(value) {
                value = parseFloat(value).toFixed(2);
                $('#loan_amount').val(value);
              }
              
          });


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
