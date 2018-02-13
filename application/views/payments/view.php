
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
        <li><a href="<?=base_url('payments')?>">Payments</a></li>
        <li class="active"><?=$title?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12">
          <?=$this->sessnotif->showNotif()?>
        </div><!-- /.col-xs-12 -->
      </div><!-- /.row -->

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?=$info['id'].' - '.$info['payee']?></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
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
            </div><!-- /.col-md-12 -->
          </div><!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?=current_url()?>/print" target="_blanl" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print Invoice</a>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">    
    <?php $this->load->view('inc/footer')?>    
  </footer>

</div>
<!-- ./wrapper -->

    <?php $this->load->view('inc/js')?>    
  
</body>
</html>
