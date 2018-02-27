
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
                                <li><?=$cred['fullname']?> - <?=$cred['address']?> -- Amount: <?=$cred['amount']?> | Remarks: <?=$cred['remarks']?></li>
                              <?php endforeach ?>
                              </ol>
                            <?php endif ?>
                          </td>
                        </tr>
                      </table><!-- /.table table-condensed table-dark-border -->
                    </div><!-- /.col-md-12 -->
                  </div><!-- /.row -->


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
