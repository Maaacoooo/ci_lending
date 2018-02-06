
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title?> &middot; <?=$site_title?></title>
  <!-- Tell the browser to be responsive to screen width -->

  <style>
    .page-header {
      margin-top: 0px !important;
      padding: 0 !important;
    }
    @media print {
      .page-header {
        font-size: 25px;
        margin-top: 0px !important;
        padding-top: 0px !important;
        background: red;
      }
      .page-header .title {
        font-size: 15px;
      }
      .page-header .date {
        font-size: 14px;
      }

      th {
        font-size: 14px !important;
      }

      body, th, td {
        font-size: 12px !important;
      }

      td {
        padding: 3px !important;
        margin: 0px !important;
      }

      .page-break-after {
        page-break-after: always;
      }

      .invoice {
        margin: 0
      }
    }
  </style>

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Custom CSS Helpers-->
  <link rel="stylesheet" href="<?=base_url('assets/custom/css/custom.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/custom/css/print.css')?>" />
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content --> 
  <section class="invoice">
        <h2 class="page-header">
          <?=$site_title?>
          <small class="pull-right date">Printed: <?=unix_to_human(now())?></small>
          <br />
          <small class="title"><?=$title?></small>
        </h2>

   
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

                <table class="table table-condensed table-dark-border page-break-after">
                  <tr>
                    <th colspan="4">Monthly Income and Expenses</th>
                  </tr>
                  <tr>
                    <td width="5%"></td>
                    <th colspan="3">Income</th>
                  </tr>
                  <?php if ($income): ?>
                  <?php $x=1; foreach ($income as $inc): ?>
                  <tr>
                    <td colspan="2" width="10%"></td>
                    <td><?=$x++?>. <?=$inc['title']?></td>
                    <td width="50%" class="bg-warning"><?=$inc['amount']?></td>
                  </tr>
                  <?php endforeach ?>
                  <?php endif ?>
                  <tr>
                    <td colspan="4"></td>
                  </tr>
                  <tr>
                    <td width="5%"></td>
                    <th colspan="3">Expenses</th>
                  </tr>
                  <?php if ($expenses): ?>
                  <?php $x=1; foreach ($expenses as $exp): ?>
                  <tr>
                    <td colspan="2" width="10%"></td>
                    <td><?=$x++?>. <?=$exp['title']?></td>
                    <td width="50%" class="bg-warning"><?=$exp['amount']?></td>
                  </tr>
                  <?php endforeach ?>
                  <?php endif ?>
                </table><!-- /.table .table-condensed table-dark-border -->


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
                          <th>Approved / Status</th>
                          <td class="bg-warning"><?=$loan['approved_at']?>
                            <?php if ($loan['status']==0): ?>
                              <span class="badge bg-red">Pending</span>
                            <?php elseif($loan['status']==1): ?>                      
                              <span class="badge bg-primary">Approved</span>
                            <?php elseif($loan['status']==2): ?>                      
                              <span class="badge bg-black">Declined</span>
                            <?php elseif($loan['status']==3): ?>                      
                              <span class="badge bg-green">Closed</span>
                            <?php elseif($loan['status']==4): ?>                      
                              <span class="badge bg-gray">Cancelled</span>
                            <?php endif ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Borrower</th>
                          <td colspan="5" class="bg-warning"><?=$info['name']?></td>
                        </tr>
                        <tr>
                          <th>Requested Amount</th>
                          <td width="20%" class="bg-warning"><?=$loan['borrowed_amount']?></td>
                          <th>Days of Period / Due date</th>
                          <td width="20%" class="bg-warning"></td>
                          <th>Rate(%) per Annum</th>
                          <td width="20%" class="bg-warning"></td>
                        </tr>
                        <tr>
                          <th>Other Creditors: </th>
                          <td colspan="5" class="bg-warning">
                            <?php if ($creditors): ?>
                              <ol>
                              <?php foreach ($creditors as $cred): ?>
                                <li><?=$cred['fullname']?> - <?=$cred['address']?> -- Amount: <?=$cred['amount']?> | Remarks: <?=$cred['remarks']?></li>
                              <?php endforeach ?>
                              </ol>
                            <?php endif ?>
                          </td>
                        </tr>
                      </table><!-- /.table table-condensed table-dark-border -->
                    </div><!-- /.col-md-12 -->
                  </div><!-- /.row -->


                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-condensed table-striped table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th colspan="6" class="text-center">STATEMENT OF ACCOUNT</th>
                                  </tr>
                                  <tr>
                                    <th width="25%">DATE | TIME</th>
                                    <th>CODE</th>
                                    <th width="40%">DESCRIPTION</th>
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
                                      <td class="text-danger"><?=$ld['debit']?></td>
                                      <td class="text-success"><?=$ld['credit']?></td>
                                      <td class="bg-warning">
                                        <?php
                                          $bal = ($bal + $ld['debit']) - ($ld['credit']);
                                          echo decimalize($bal);
                                        ?>
                                      </td>
                                    </tr>
                                    <?php endforeach ?>
                                  <?php endif ?>
                                </tbody>
                              </table><!-- /.table table-condensed table-striped -->
                    </div><!-- /.col-md-12 -->
                  </div><!-- /.row -->



    

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <div class="signature-container">
            <div class="signature" style="width: 200px;">
              <span class="signee"><?=$user['name']?></span>
              <span class="signee-title">Printed by</span>
              </div><!-- /.signature -->
         </div><!-- /.signature-container -->
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <small class="pull-right date">Printed: <?=unix_to_human(now())?></small>
      </div><!-- /.col-xs-6 -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
