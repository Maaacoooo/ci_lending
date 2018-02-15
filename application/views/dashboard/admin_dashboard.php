
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

      <?php if ($passwordverify): ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="callout callout-danger">
            <div class="row">
              <div class="col-lg-6">
                <h4><i class="fa fa-warning"></i> Change your password!</h4>
                <p>Hi <?=$user['name']?>! Welcome and Thank you for using <?=APP_NAME?>! <br />
                The system has detected that you are currently using the system's default password. <br />
                Please change your password immediately for your privacy and account security
                </p>
                <p>To change your password,
                    <ol>
                      <li>Go to upper right of your screen</li>
                      <li>Click <em>Your Name</em></li>
                      <li>Go to <em>Profile</em></li>
                      <li>Click the <em>Settings Tab</em></li>
                    </ol>
                </p>
                <a href="<?=base_url('settings/profile')?>" class="btn btn-outline btn-flat pull-right" style="text-decoration: none"><i class="fa fa-wrench"></i> Change Password</a>
              </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
          </div><!-- /.callout callout-danger -->
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
      <?php endif ?>

      <div class="row">
        <div class="col-lg-5 col-sm-12">
          <!-- Default box -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Pending Loans</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>      
              </div>
            </div>
            <div class="box-body">
              <?php if ($pendings): ?>
              <div class="box-body table-responsive no-padding">
                <table class="table table-striped table-condensed">             
                  <tbody>
                    <?php foreach ($pendings as $res): ?>
                      <tr>
                        <td><a href="<?=base_url('loans/view/'.$res['id'])?>"><?=$res['lastname'].', '.$res['firstname']?></a></td>
                        <td><a href="<?=base_url('loans/view/'.$res['id'])?>"><?=$res['id']?></a></td>
                        <td><a href="<?=base_url('loans/view/'.$res['id'])?>"><?=moneytize($res['borrowed_amount'])?> <span class="badge bg-red">Approve Me</span></a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>                       
                </table><!-- /.table table-bordered -->
              </div><!-- /.box-body -->
              <?php else: ?>
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="well">
                        <strong><i class="icon fa fa-ban"></i> Oops! No Results Found</strong><br />
                        The has found no results. If you feel something wrong, please contact the System Administrator.
                      </div>
                    </div><!-- /.col-sm-12 -->
                  </div><!-- /.row -->   
                </div><!-- /.box-body -->     
              <?php endif; ?>             
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div><!-- /.col-lg-5 col-sm-12 -->
        <div class="col-lg-5 col-sm-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Overdue Loans</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>      
              </div>
            </div>
            <div class="box-body">
              Start creating your amazing application!
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div><!-- /.col-lg-5 col-sm-12 -->
        <div class="col-lg-2 col-sm-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Options</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>      
              </div>
            </div>
            <div class="box-body">
              <a href="<?=base_url('users')?>" class="btn btn-block btn-flat btn-primary"><i class="fa fa-users"></i> Register User</a>
              <a href="<?=base_url('borrowers/create')?>" class="btn btn-block btn-flat btn-primary">Register Borrower</a>
              <button class="btn btn-default btn-flat btn-block" data-toggle="modal" data-target="#AddExpense"><i class="fa fa-plus"></i> Add Expense</button>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div><!-- /.col-lg-2 col-sm-12 -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-lg-7 col-sm-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">System Logs</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>      
              </div>
            </div>
            <div class="box-body">
              <table class="table table-condensed table-striped">
                <tbody>
                  <?php if ($logs): ?>
                    <?php foreach ($logs as $log): ?>
                    <tr>
                      <td width="20%"><span class="badge bg-blue"><?=$log['name']?></span></td>
                      <td><?=$log['action']?> <small><em><?=$log['tag'].'/'.$log['tag_id']?></em></small></td>
                      <td><?=$log['date_time']?></td>
                    </tr>
                    <?php endforeach ?>
                  <?php endif ?>
                </tbody>
              </table><!-- /.table table-condensed table-striped -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div><!-- /.col-lg-7 col-sm-12 -->
        <div class="col-lg-5 col-sm-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Today's Expenses</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>      
              </div>
            </div>
            <div class="box-body">
              <table class="table table-condensed table-striped">
                <?php if ($expenses): ?>
                  <?php foreach ($expenses as $exp): ?>
                  <tr>
                    <td><?=$exp['payee']?></td>
                    <td><?=ellipsize($exp['description'], 20,1)?></td>
                    <td><?=moneytize($exp['amount'])?></td>
                  </tr>
                  <?php endforeach ?>
                <?php else: ?>
                  <div class="well">
                    <p>No Expenses Record for today</p>
                  </div><!-- /.well -->
                <?php endif ?>
              </table><!-- /.table table-condensed table-striped -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button class="btn btn-default pull-right btn-flat btn-sm" data-toggle="modal" data-target="#AddExpense"><i class="fa fa-plus"></i> Add Expense</button>
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Today's Payments</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>      
              </div>
            </div>
            <div class="box-body">
              <table class="table table-striped table-condensed">
                <?php if ($payments): ?>
                  <?php foreach ($payments as $pay): ?>
                  <tr>
                    <td><a href="<?=base_url('payments/view/'.$pay['id'])?>"><?=$pay['payee']?></a></td>
                    <td><a href="<?=base_url('payments/view/'.$pay['id'])?>"><?=$pay['loan_id']?></a></td>
                    <td><a href="<?=base_url('payments/view/'.$pay['id'])?>"><?=$pay['amount']?></a></td>
                  </tr>
                  <?php endforeach ?>
                <?php else: ?>
                  <div class="well">
                    <p>No Payments Received Today.</p>
                  </div><!-- /.well -->
                <?php endif ?>
              </table><!-- /.table table-striped table-condensed -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div><!-- /.col-lg-5 col-sm-12 -->

      </div><!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- ///////////////////////// Add Expense ////////////////////////////// -->
  <div class="modal fade" id="AddExpense">
    <div class="modal-dialog">
      <div class="modal-content">
        <?=form_open('expenses/create')?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Record Expense</h4>
        </div>
        <div class="modal-body">   
          <div class="row">
            <div class="col-md-8 col-sm-6">
              <div class="form-group">
                 <label for="payee">Payee</label>
                 <input type="text" name="payee" id="payee" class="form-control" placeholder="Redwoods Lending..." required="" />
              </div><!-- /.form-group -->
            </div><!-- /.col-md-8 col-sm-6 -->
            <div class="col-md-4 col-sm-6">
              <div class="form-group">
              <label for="amount">Amount</label>
              <input type="text" name="amount" id="amount" class="form-control" placeholder="500.00..." required="" />
            </div><!-- /.form-group -->
            </div><!-- /.col-md-4 col-sm-6 -->
          </div><!-- /.row -->
          <div class="form-group">
            <label for="receipt">Receipt</label>
            <input type="text" name="receipt" id="receipt" class="form-control" placeholder="Official Receipt / Sales Invoice / Serial # / Delivery Receipt..." />
          </div><!-- /.form-group -->
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" class="form-control" required></textarea>
          </div><!-- /.form-group -->
          <div class="row">
            <div class="col-sm-12">
              <div class="checkbox pull-right">
                  <label>
                    <input type="checkbox" required/>I have verified all inputs.
                  </label>
                </div><!-- /.checkbox -->
            </div><!-- /.col-sm-12 -->
          </div><!-- /.row -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-success">Save Expense</button>
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
  
</body>
</html>
