
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
          <?=$site_title?>
          <small class="pull-right">Printed: <?=unix_to_human(now())?></small><br />
          <small><?=$title?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
   
    <p>
      This is 
    </p>
  </section>
  <!-- /.content -->

  <br />
  <br />
  <hr />
  <br />
  <br />

</div>
<!-- ./wrapper -->
</body>
</html>
