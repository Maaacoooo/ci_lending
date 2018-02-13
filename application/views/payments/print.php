
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

      @page{
        size: A4;
      }
    }
  </style>

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Custom CSS Helpers-->
  <link rel="stylesheet" href="<?=base_url('assets/dist/css/AdminLTE.min.css')?>">
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

            <table class="table table-dark-border table-condensed">
                <tr>
                  <th width="20%">Loan ID</th>
                  <td class="bg-warning"><a href="<?=base_url('loans/view/'.$info['loan_id'])?>"><?=$info['loan_id']?></a></td>
                </tr>
                <tr>
                  <th>Payee</th>
                  <td class="bg-warning"><?=$info['payee']?></td>
                </tr>
                <tr>
                  <th>OR / SI </th>
                  <td class="bg-warning"><?=$info['receipt']?></td>
                </tr>                
                <tr>
                  <th>Date</th>
                  <td class="bg-warning"><?=$info['created_at']?></td>
                </tr>
                <tr>
                  <th>Amount</th>
                  <td class="bg-warning"><?=moneytize($info['amount'])?></td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td class="bg-warning"><?=$info['description']?></td>
                </tr>
                <tr>
                  <th>Received by</th>
                  <td class="bg-warning"><?=$info['user']?></td>
                </tr>
              </table><!-- /.table table-dark-border table-condensed -->

    

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
  <br />
  <hr />
  <hr />

  <section class="invoice">
        <h2 class="page-header">
          <?=$site_title?>
          <small class="pull-right date">Printed: <?=unix_to_human(now())?></small>
          <br />
          <small class="title"><?=$title?></small>
        </h2>

            <table class="table table-dark-border table-condensed">
                <tr>
                  <th width="20%">Loan ID</th>
                  <td class="bg-warning"><a href="<?=base_url('loans/view/'.$info['loan_id'])?>"><?=$info['loan_id']?></a></td>
                </tr>
                <tr>
                  <th>Payee</th>
                  <td class="bg-warning"><?=$info['payee']?></td>
                </tr>
                <tr>
                  <th>OR / SI </th>
                  <td class="bg-warning"><?=$info['receipt']?></td>
                </tr>                
                <tr>
                  <th>Date</th>
                  <td class="bg-warning"><?=$info['created_at']?></td>
                </tr>
                <tr>
                  <th>Amount</th>
                  <td class="bg-warning"><?=moneytize($info['amount'])?></td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td class="bg-warning"><?=$info['description']?></td>
                </tr>
                <tr>
                  <th>Received by</th>
                  <td class="bg-warning"><?=$info['user']?></td>
                </tr>
              </table><!-- /.table table-dark-border table-condensed -->

    

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
