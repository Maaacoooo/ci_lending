
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
        <li><a href="<?=base_url('borrowers')?>">Borrowers</a></li>
        <li><a href="<?=base_url('borrowers/view/'.$info['id'])?>"><?=$info['name']?></a></li>
        <li class="active"><?=$title?></li>
      </ol>
    </section>

   <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <?php
            //ALERT / NOTIFICATION
            //ERROR ACTION        
            $flash_settings = $this->session->flashdata('settings');
            $flash_valid =  validation_errors();                 
         ?>                       
        <?=$this->sessnotif->showNotif()?>
        </div><!-- /.col-xs-12 -->
      </div><!-- /.row -->

      <div class="row">        
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li <?php if(!($flash_settings))echo'class="active"'?>><a href="#application" data-toggle="tab">Application Information</a></li>
              <li><a href="#personal" data-toggle="tab">Account Information</a></li>
              <li><a href="#activity" data-toggle="tab">Activity Logs</a></li>
              <li <?php if($flash_settings)echo'class="active"'?>><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">

              <!-- /////////////////////////////////////////////// Application Information //////////////////////////////////////////////// -->
              <div class="tab-pane <?php if(!($flash_settings))echo'active';?>" id="application">
                  Application info
              </div>
              <!-- /.tab-pane -->
              
              <!-- /////////////////////////////////////////////// Account Information //////////////////////////////////////////////// -->

              <div class="tab-pane" id="personal">
                <div class="row">
                  <div class="col-sm-12">
                    <a href="<?=current_url()?>/print" target="_blank" class="pull-right"><i class="fa fa-print"></i> Print Information</a>
                  </div><!-- /.col-sm-12 -->
                </div><!-- /.row -->
                <table class="table table-condensed table-dark-border">
                  <tr>
                    <td colspan="6"><strong>Personal Information</strong></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Fullname</strong> <small><em>(First Middle Last)</em></small></td>
                    <td colspan="4" class="bg-warning"><?=$info['firstname'] . ' ' . $info['middlename'] . ' ' . $info['lastname']?></td>
                  </tr>
                  <tr>
                    <th width="10%">Sex</th>                    
                    <td width="10%" class="bg-warning">
                      <?php if ($info['sex']): ?>
                        <span class="badge bg-blue">Male</span>
                      <?php else: ?>
                        <span class="badge bg-maroon">Female</span>
                      <?php endif ?>
                    </td>
                    <th width="20%">Civil Status</th>
                    <td class="bg-warning"><?=$info['civil_status']?></td>
                    <th width="15%">Birth Date</th>
                    <td class="bg-warning"><?=$info['birthdate']?> (<?=getAge($info['birthdate'])?> y.o)</td>
                  </tr>
                  <tr>
                    <th colspan="2">Birth Place</th>
                    <td colspan="4" class="bg-warning"><?=$info['bplace']?></td>
                  </tr>
                  <?php if ($info['civil_status'] == 'Married'): ?>
                  <tr>
                    <td colspan="6"><strong>Spouse Information</strong></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Fullname</strong> <small><em>(First Middle Last)</em></small></td>
                    <td colspan="2" class="bg-warning"><?=$info['spouse_name']?></td>
                    <th>Birth Date</th>
                    <td class="bg-warning"><?=$info['spouse_bdate']?> (<?=getAge($info['spouse_bdate'])?> y.o)</td>
                  </tr>
                  <tr>
                    <th colspan="2">Birth Place</th>
                    <td colspan="2" class="bg-warning"><?=$info['spouse_bplace']?></td>
                    <th>Contact Number</th>
                    <td class="bg-warning"><?=$info['spouse_contact']?></td>
                  </tr>
                  <tr>
                    <th colspan="2">Occupation</th>
                    <td class="bg-warning"><?=$info['spouse_occupation']?></td>
                    <th>Work Address</th>
                    <td colspan="2" class="bg-warning"><?=$info['spouse_work']?></td>
                  </tr>
                  <?php endif ?>
                  <tr>
                    <td colspan="6"><strong>Educational Attainment</strong></td>
                  </tr>
                  <tr>
                    <th>Level</th>
                    <td class="bg-warning">
                      <?php if ($info['educ_level'] == 0): ?>
                        Elementary Graduate
                      <?php elseif ($info['educ_level'] == 1): ?>
                        High School Graduate
                      <?php elseif ($info['educ_level'] == 2): ?>
                        College Graduate
                      <?php elseif ($info['educ_level'] == 3): ?>
                        Undergraduate
                      <?php endif ?>
                    </td>
                    <th>Course and School</th>
                    <td class="bg-warning"><?=$info['educ_course']?> - <?=$info['educ_school']?></td>
                    <th>Year</th>
                    <td class="bg-warning"><?=$info['educ_year']?></td>
                  </tr>
                </table><!-- /.table table-condensed table-dark-border-->
                <table class="table table-condensed table-dark-border">
                  <tr>
                    <th colspan="4">Address and Contact Information</th>
                  </tr>
                  <tr>
                    <td><strong>Current Address</strong></td>
                    <td class="bg-warning" colspan="3"><?=$info['current_addr']?></td>
                  </tr>
                  <tr>
                    <th>Other Addresses</th>
                    <td class="bg-warning" colspan="3">
                      <ul>
                        <?php foreach ($addresses as $addr): ?>
                          <?php 
                          if ($addr['type'] == 1) {
                            $type = "Home";
                          } elseif ($addr['type'] == 2) {
                            $type = "Current";                            
                          } elseif ($addr['type'] == 3) {
                            $type = "Other";                            
                          }
                          ?>                        
                        <?php endforeach ?>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <th width="18%">Contact Numbers</th>
                    <td class="bg-warning">
                      <ul>
                        <?php if ($mobiles): ?>
                        <?php foreach ($mobiles as $mob): ?>
                        <li><?=$mob['value']?></li>
                        <?php endforeach ?>
                        <?php endif ?>
                      </ul>
                    </td>
                    <th width="15%">Email Addresses</th>
                    <td class="bg-warning">
                      <ul>
                        <?php if ($emails): ?>
                        <?php foreach ($emails as $email): ?>
                        <li><?=$email['value']?></li>
                        <?php endforeach ?>
                        <?php endif ?>
                      </ul>
                    </td>
                  </tr>
                </table><!-- /.table .table-condensed table-dark-border -->

             
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="activity">
                <h4 class="title">Last Activity</h4>
                <?php if ($logs): ?>
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th width="45%">Action</th>
                      <th>Date Time</th>
                      <th>IP Address</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($logs as $lg): ?>
                    <tr>
                      <td><?=$lg['user']?></td>
                      <td><?=$lg['action']?>
                        <?php if ($lg['tag'] == 'user'): ?>
                          <a href="<?=base_url('users/update/'.$lg['tag_id'])?>" title="Check out..."><i class="fa fa-external-link"></i></a>
                        <?php endif ?>
                      </td>
                      <td><?=$lg['date_time']?></td>
                      <td><?=$lg['ip_address']?></td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table><!-- /.table table-condensed -->
                <?php else: ?>
                  <div class="alert alert-warning">               
                    <h4><i class="icon fa fa-warning"></i> No records found!</h4>         
                    No Activity Logs record found in the system
                  </div>
                <?php endif ?>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane <?php if($flash_settings)echo'active'?>" id="settings">

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col-md-9 -->
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-danger">
            <div class="box-body box-profile">             
              <?php if (filexist($info['img']) && $info['img']): ?>
                <img class="profile-user-img img-responsive img-circle" src="<?=base_url($info['img'])?>" alt="User profile picture">
              <?php else: ?>
                <img class="profile-user-img img-responsive img-circle" src="<?=base_url('assets/img/no_image.gif')?>" alt="User profile picture">                
              <?php endif ?>

              <h3 class="profile-username text-center"><?=$info['name']?></h3>

              <p class="text-muted text-center"><?=$info['id']?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Loan Applications</b> <span class="pull-right badge bg-red">Nah</span>
                </li>       
                <li class="list-group-item">
                  <b>Date Registered</b> <a class="pull-right"><?=$info['created_at']?></a>
                </li>  
                <li class="list-group-item">
                  <a href="#" data-target="#AddLoan" data-toggle="modal" class="btn btn-danger btn-block btn-flat"><i class="fa fa-money"></i> Apply Loan</a>
                </li>                         
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col-md-3 -->
      </div>
      <!-- /.row -->

    </section>
  </div>
  <!-- /.content-wrapper -->


  <footer class="main-footer">    
    <?php $this->load->view('inc/footer')?>    
  </footer>

</div>
<!-- ./wrapper -->

    <?php $this->load->view('inc/js')?>    
    <script src="<?=base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/input-mask/jquery.inputmask.js')?>"></script>
    <script src="<?=base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js')?>"></script>

    <script src="<?=base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>

    <script type="text/javascript">

    $(document).ready(function(){
      $('#add_creditor').click(function(e) {
              var creditors = $('#creditors').clone();
              $( "#creditors" ).after( creditors );
          });

      $('.test').focus(function(e) {
              var value = $('#test').val();
              if(!value) {

              } else {
                value = parseFloat(value).toFixed(2);
                $('#test').val(value);
              }
              
          });
      });

    //Initialize input mask
    $('[data-mask]').inputmask();

    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    });

    //Date picker
    $('input[type="text"].bootstrap-datepicker').datepicker({
      autoclose: true
    });


    //enable new address in UpdateCurrentAddr
    
    function enable_new() {
      if(document.getElementById("new_address").checked == true) {

        console.log("checked");

        
        //enable fields
        document.getElementById("addr_list").disabled = true;

        document.getElementById("new_addr_bldg").disabled = false;
        document.getElementById("new_addr_strt").disabled = false;
        document.getElementById("new_addr_brgy").disabled = false;
        document.getElementById("new_addr_city").disabled = false;
        document.getElementById("new_addr_prov").disabled = false;
        document.getElementById("new_addr_zip").disabled = false;
        document.getElementById("new_addr_ctry").disabled = false; 

      } else {

        console.log("unchecked");
        //disable fields
        
        document.getElementById("addr_list").disabled = false;   

        document.getElementById("new_addr_bldg").disabled = true;
        document.getElementById("new_addr_strt").disabled = true;
        document.getElementById("new_addr_brgy").disabled = true;
        document.getElementById("new_addr_city").disabled = true;
        document.getElementById("new_addr_prov").disabled = true;
        document.getElementById("new_addr_zip").disabled = true;
        document.getElementById("new_addr_ctry").disabled = true;
      }


    }

    </script>
  
</body>
</html>
