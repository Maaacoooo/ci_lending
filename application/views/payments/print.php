
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
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <?=$site_title?>
          <small class="pull-right">Printed: <?=unix_to_human(now())?></small><br />
          <small><?=$title?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
   
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <?php $total[]=0;  if ($results): ?>
          <table class="table table-bordered table-condensed table-hover">             
            <thead>
              <tr>
                <th>PAYID</th>
                <th>O.R / S.I / D.R</th>
                <th>PAYEE</th>
                <th>DESCRIPTION</th>
                <th>AMOUNT</th>
                <th>DATE | TIME</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($results as $res): ?>
                <tr>
                  <td><?=$res['id']?></td>
                  <td><?=$res['receipt']?></td>
                  <td><?=$res['payee']?></td>
                  <td><?=ellipsize($res['description'], 20,1)?></td>
                  <td class="bg-warning"><?php $total[]=$res['amount']; echo moneytize($res['amount']);?></td>
                  <td><?=$res['created_at']?><span class="badge bg-blue"><?=$res['name']?></span></a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>                       
            <tfoot>
              <tr>
                <th colspan="4" class="text-right">TOTAL</th>
                <th class="bg-warning"><?=moneytize(array_sum($total))?></th>
                <td></td>
              </tr>
            </tfoot>
          </table><!-- /.table table-bordered -->
        <?php else: ?>
          <p>No Results Found!</p>
        <?php endif ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

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
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%"><h4>Total:</h4></th>
              <td class="text-red"><h3><?=moneytize(array_sum($total))?></h3></td>
            </tr>            
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
