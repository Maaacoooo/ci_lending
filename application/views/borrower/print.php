
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
<body onload="#window.print();">
<div class="wrapper">
  <!-- Main content --> 
  <section class="invoice">
        <h2 class="page-header">
          <?=$site_title?>                  
          <img src="<?=base_url('code/qr/'.$info['id'].'/3')?>" alt="" class="img-thumbnail pull-right"/>

          <br />
          <small class="title"><?=$title?></small>
          <br />
          <br />
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
                            <?php if ($emp['type']): ?>
                              <span class="label bg-red">GOVT</span> 
                            <?php else: ?>
                              <span class="label bg-green">PRIV</span> 
                            <?php endif ?>
                            <?=$emp['position_nature']?> - 
                            <?=$emp['employer_business']?> (<?=$emp['year_started']?>-<?php if($emp['year_ended']){echo $emp['year_ended']; } else { echo 'Present'; }?>)
                        </li> 
                        <?php endforeach ?>
                        <?php endif ?>
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
                            <?=$buss['employer_business']?> - <?=$buss['address']?> 
                            (<?=$buss['year_started']?>-<?php if($buss['year_ended']){echo $buss['year_ended']; } else { echo 'Present'; }?>)
                        </li> 
                        <?php endforeach ?>
                        <?php endif ?>
                      </ul>
                    </td>
                  </tr>
                </table><!-- /.table table-condensed table-dark-border -->     


                <table class="table table-condensed table-dark-border">
                  <thead>
                    <tr>
                      <th colspan="5">LOAN APPLICATIONS</th>
                    </tr>
                    <tr>
                      <th>ID</th>
                      <th>Amount</th>
                      <th>Applicate Date</th>
                      <th>Due Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($loans): ?>
                    <?php foreach ($loans as $loan): ?>
                    <tr>
                      <td><?=$loan['id']?></td>
                      <td><?=$loan['borrowed_amount']?></td>
                      <td><?=$loan['created_at']?></td>
                      <td><?=$loan['due_date']?></td>
                      <td>
                        <?php if ($loan['status']==0): ?>
                          <span class="badge bg-red">Pending</span>
                        <?php elseif($loan['status']==1): ?>                      
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
                    <?php endforeach ?>
                    <?php endif ?>
                  </tbody>
                </table><!-- /.table .table-condensed table-striped -->
    

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
