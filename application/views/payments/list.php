

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title?> &middot; <?=$site_title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $this->load->view('inc/css')?>

  <!-- daterange picker -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')?>">
   
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List of Expenses <span class="badge"><?=$total_result?></span></h3>
          <div class="box-tools pull-right">            
            <?=form_open(current_url(), array('method' => 'get', 'class' => 'input-group input-group-sm form-inline', 'style' => 'width: 250px;'))?>
              <input type="text" name="search" class="form-control pull-right" placeholder="Search..." value="<?=$search?>">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>                
            	<button type="button" class="btn btn-box-tool btn-default" data-toggle="modal" data-target="#PrintReport"><i class="fa fa-print"></i> Print</button>        
              </div> 
            <?=form_close()?>  
          </div>
        </div>        
        <?php if ($results): ?>
        <div class="box-body table-responsive no-padding">
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
              <?php $total[]=0; foreach ($results as $res): ?>
                <tr>
                  <td><a href="<?=base_url('payments/view/'.$res['id'])?>"><?=$res['id']?></a></td>
                  <td><a href="<?=base_url('payments/view/'.$res['id'])?>"><?=$res['receipt']?></a></td>
                  <td><a href="<?=base_url('payments/view/'.$res['id'])?>"><?=$res['payee']?></a></td>
                  <td><a href="<?=base_url('payments/view/'.$res['id'])?>"><?=ellipsize($res['description'], 20,1)?></a></td>
                  <td class="bg-warning"><a href="<?=base_url('payments/view/'.$res['id'])?>" class="text-danger"><?php $total[]=$res['amount']; echo moneytize($res['amount']);?></a></td>
                  <td><a href="<?=base_url('payments/view/'.$res['id'])?>"><?=$res['created_at']?>
                  	<span class="badge bg-blue"><?=$res['name']?></span>
                  </a></td>
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
        </div><!-- /.box-body -->
        <?php else: ?>
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Oops! No Results Found</h4>
                  The has found no results. If you feel something wrong, please contact the System Administrator.
                </div>
              </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->   
          </div><!-- /.box-body -->     
        <?php endif; ?>             
        <div class="box-footer">          
          <a href="<?=current_url()?>?action=print" target="_blank" class="btn btn-md btn-primary"><i class="fa fa-print"></i> Print <?=$title?></a>
		  <div class="pull-right">
            <?php foreach ($links as $link) { echo $link; } ?>
          </div><!-- /.pull-right -->
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


   <!-- ///////////////////////// Print Report ////////////////////////////// -->
  <div class="modal fade" id="PrintReport">
    <div class="modal-dialog">
      <div class="modal-content modal-sm">
        <?=form_open(current_url(), array('method'=> 'GET', 'target' => '_blank'))?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Print Report</h4>
        </div>
        <div class="modal-body">   
          <div class="row">
          	<div class="col-sm-12">
          		<div class="form-group">
          			<div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-calendar"></i>
	                  </div>
	                  <input type="text" class="form-control pull-right date-range-picker" name="date">
                    <input type="hidden" name="action" value="print" />
	                </div>
          		</div><!-- /.form-group -->
          	</div><!-- /.col-sm-12 -->
          </div><!-- /.row -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-print"></i> Print</button>
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
    <!-- date-range-picker -->
    <script src="<?=base_url('assets/bower_components/moment/min/moment.min.js')?>"></script>
    <script src="<?=base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js')?>"></script>
    <!-- bootstrap datepicker -->
    <script src="<?=base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>

    <!-- Page script -->
<script>
  $(function () {  
    //Date range picker
    $('.date-range-picker').daterangepicker()

  })
</script>
  
</body>
</html>
