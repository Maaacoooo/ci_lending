
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

    .no-border td {
      border-top: 0px !important;
      border-bottom: 0px !important;    
    }
    .indent-100 {
      text-indent: 100px !important;
    }
    .indent-50 {
      text-indent: 50px !important; 
    }
    .no-border {
      border-top: 2px red solid !important;
      border-bottom: 0px !important;
    }
    .slip {
      width: 70%; 
      margin: auto;
    }
    body {
      height: auto !important;
    }
  </style>

  <?php $this->load->view('inc/css')?>
  <link rel="stylesheet" href="<?=base_url('assets/custom/css/custom.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/custom/css/print.css')?>" />
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <?=COMPANY_NAME?>
          <small class="pull-right">Printed: <?=unix_to_human(now())?></small><br />
          <small>Customer's Copy</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <div class="col-sm-12">
          <h3 class="text-center"><strong>LOAN DISBURSEMENT SLIP</strong></h3>
          <div class="slip">
            <table class="table table-condensed table-dark-border">
              <thead>
                <tr>
                  <th class="text-center">DESCRIPTION</th>
                  <th class="text-center" width="40%">AMOUNT</th>
                </tr>
              </thead>
              <tbody class="no-border">
                <tr>
                  <td>
                    <p style="padding-left: 50px">
                      Borrower: <?=$info['name']?> <br />
                      Account ID : <?=$info['id']?> <br />
                      Loan ID: <?=$loan['id']?>
                    </p><!-- /.indent-50 -->
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td class="indent-100">1. Requested Amount</td>
                  <td class="indent-50"><?=moneytize($loan['borrowed_amount'])?></td>
                </tr>
                <tr>
                  <td class="indent-100">2. Service Charge</td>
                  <td class="indent-50"><?=moneytize($loan['borrowed_amount'] * 0.05)?></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th class="text-right">Net AMOUNT</th>
                  <td class="indent-50"><?=moneytize($loan['borrowed_amount']-($loan['borrowed_amount'] * 0.05))?></td>
                </tr>
              </tfoot>
            </table><!-- /.table table-condensed table-dark-border -->
            
            <p>Disbursed by: <?=$loan['disbursed_by']?> - Date: <?=$loan['disbursed_at']?>  </p>

          </div><!-- /.slip -->
      </div><!-- /.col-sm-12 -->
    </div><!-- /.row -->


    <div class="row">
      <div class="col-xs-6">
        <div class="signature-container">
            <div class="signature" style="width: 200px;">
              <span class="signee"><?=$user['name']?></span>
              <span class="signee-title">Printed by</span>
              </div><!-- /.signature -->
         </div><!-- /.signature-container -->
      </div>

      <div class="col-xs-6">
        <div class="signature-container">
            <div class="signature" style="width: 200px;">
              <span class="signee"><?=$info['name']?></span>
              <span class="signee-title">Received By</span>
              </div><!-- /.signature -->
         </div><!-- /.signature-container -->
      </div>
    </div><!-- /.row -->
   
  </section>
  <!-- /.content -->

  <hr />

  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <?=COMPANY_NAME?>
          <small class="pull-right">Printed: <?=unix_to_human(now())?></small><br />
          <small>Company Copy</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <div class="col-sm-12">
          <h3 class="text-center"><strong>LOAN DISBURSEMENT SLIP</strong></h3>
          <div class="slip">
            <table class="table table-condensed table-dark-border">
              <thead>
                <tr>
                  <th class="text-center">DESCRIPTION</th>
                  <th class="text-center" width="40%">AMOUNT</th>
                </tr>
              </thead>
              <tbody class="no-border">
                <tr>
                  <td>
                    <p style="padding-left: 50px">
                      Borrower: <?=$info['name']?> <br />
                      Account ID : <?=$info['id']?> <br />
                      Loan ID: <?=$loan['id']?>
                    </p><!-- /.indent-50 -->
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td class="indent-100">1. Requested Amount</td>
                  <td class="indent-50"><?=moneytize($loan['borrowed_amount'])?></td>
                </tr>
                <tr>
                  <td class="indent-100">2. Service Charge</td>
                  <td class="indent-50"><?=moneytize($loan['borrowed_amount'] * 0.05)?></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th class="text-right">Net AMOUNT</th>
                  <td class="indent-50"><?=moneytize($loan['borrowed_amount']-($loan['borrowed_amount'] * 0.05))?></td>
                </tr>
              </tfoot>
            </table><!-- /.table table-condensed table-dark-border -->
            
            <p>Disbursed by: <?=$loan['disbursed_by']?> - Date: <?=$loan['disbursed_at']?>  </p>

          </div><!-- /.slip -->
      </div><!-- /.col-sm-12 -->
    </div><!-- /.row -->


    <div class="row">
      <div class="col-xs-6">
        <div class="signature-container">
            <div class="signature" style="width: 200px;">
              <span class="signee"><?=$user['name']?></span>
              <span class="signee-title">Printed by</span>
              </div><!-- /.signature -->
         </div><!-- /.signature-container -->
      </div>

      <div class="col-xs-6">
        <div class="signature-container">
            <div class="signature" style="width: 200px;">
              <span class="signee"><?=$info['name']?></span>
              <span class="signee-title">Received By</span>
              </div><!-- /.signature -->
         </div><!-- /.signature-container -->
      </div>
    </div><!-- /.row -->
   
  </section>
  <!-- /.content -->




</div>
<!-- ./wrapper -->
</body>
</html>
