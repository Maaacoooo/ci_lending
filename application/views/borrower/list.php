
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
          <h3 class="box-title">Account List  <span class="badge"><?=$total_result?></span></h3>
          <div class="box-tools pull-right">            
            <?=form_open('borrowers', array('method' => 'get', 'class' => 'input-group input-group-sm', 'style' => 'width: 150px;'))?>
              <input type="text" name="search" class="form-control pull-right" placeholder="Search..." value="<?=$search?>">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                <button type="button" class="btn btn-default btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i>
                </button>  
              </div> 
            <?=form_close()?>            
          </div>
        </div>        
        <?php if ($results): ?>
        <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-condensed">             
            <thead>
              <tr>
                <th width="8%"></th>
                <th>Name</th>
                <th>Spouse</th>
                <th>Active Loans</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($results as $res): ?>
                <tr>
                  <td>
                    <a href="<?=base_url('borrowers/view/'.$res['id'])?>">
                      <?php if (filexist($res['img']) && $res['img']): ?>
                        <img class="profile-user-img img-responsive img-circle" src="<?=base_url($res['img'])?>" alt="User profile picture">
                      <?php else: ?>
                        <img class="profile-user-img img-responsive img-circle" src="<?=base_url('assets/img/no_image.gif')?>" alt="User profile picture">                
                      <?php endif ?>
                    </a>
                  </td>
                  <td><a href="<?=base_url('borrowers/view/'.$res['id'])?>"><?=$res['lastname'].', '.$res['firstname']?></a></td>
                  <td><a href="<?=base_url('borrowers/view/'.$res['id'])?>"><?=$res['spouse_name']?></a></td>
                  <td><a href="<?=base_url('borrowers/view/'.$res['id'])?>"><?=$res['id']?></a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>                       
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

  <footer class="main-footer">    
    <?php $this->load->view('inc/footer')?>    
  </footer>

</div>
<!-- ./wrapper -->

    <?php $this->load->view('inc/js')?>    
  
</body>
</html>
