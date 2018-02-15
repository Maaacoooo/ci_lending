
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title?> &middot; <?=$site_title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  

  <?php $this->load->view('inc/css')?>
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
          <small class="pull-right">Printed: <?=unix_to_human(now())?></small>
          <small><?=$title?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
   
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
              <th></th>
              <th>OR/SI/DR/Trans</th>
              <th>PAYEE</th>               
              <th>AMOUNT</th>                    
              <th>DATE | TIME</th>
          </tr>
          </thead>
          <tbody>
            <?php $total[]=0; if ($results): $x=1; ?>
            <?php foreach ($results as $res): $total[]=$res['amount']?>
            <tr>
              <td class="text-center"><?=$x++?>.</td>
              <td><?=$res['receipt']?></td>           
              <td><?=$res['payee']?></td>           
              <td><?=$res['amount']?></td>           
              <td><?=$res['created_at']?></td>           
            </tr>
            <?php endforeach ?>
            <?php else: ?>
            <tr>
              <td colspan="4">No items found!</td>
            </tr>
            <?php endif ?>
          </tbody>
        </table>
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
