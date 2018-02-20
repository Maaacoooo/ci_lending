
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
          <h3 class="box-title">Borrower's Account Registration Form</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>      
          </div>
        </div>
        <div class="box-body">

          <div class="callout callout-warning hidden">
            <h4>Oh snap!</h4>
            <p>This form seems to be invalid :(</p>
          </div>
          <?=form_open_multipart('borrowers/create', array('id'=>'mainform', 'data-parsley-validate' => ''))?>
          <fieldset>
            <legend>Personal Information</legend>            
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control char-val" name="fname" id="fname" placeholder="Enter First Name..." value="<?=set_value('fname')?>" required="true">
                    </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="mname">Middle Name</label>
                  <input type="text" class="form-control char-val" name="mname" id="mname"  data-parsley-type="alphanum" data-parsley-trigger="change" placeholder="Enter Middle Name..." value="<?=set_value('mname')?>" required="true" data-parsley-required>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="lname">Last Name</label>
                  <input type="text" class="form-control char-val" name="lname" id="lname" placeholder="Enter Last Name..." value="<?=set_value('lname')?>" required>
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->

              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Birth Date:</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control char-val" name="bdate" id="birthdate" value="<?=set_value('bdate')?>" placeholder="mm/dd/yyyy">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="sex">Sex</label>
                  <div class="form-group">
                    <div class="col-xs-6">
                      <label>
                          <input type="radio" name="sex" value="1" class="minimal-red" <?=set_radio('sex', '1'); ?> required>
                        Male
                      </label>
                    </div><!-- /.col-xs-6 -->
                    <div class="col-xs-6">
                      <label>
                          <input type="radio" name="sex" value="0" class="minimal-red" <?=set_radio('sex', '0'); ?>  required>
                        Female
                      </label>
                    </div><!-- /.col-xs-6 -->                    
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="civil_stat">Civil Status</label>
                  <select name="civil_stat" id="civil_stat" class="form-control" required>
                    <option disabled selected> Select Option...</option>
                    <option value="Single" <?=set_select('civil_stat', 'Single')?>>Single</option>
                    <option value="Married" <?=set_select('civil_stat', 'Married')?>>Married</option>
                  </select>
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
            
            <fieldset class="group-box">
              <legend class="group-box-title">Birth Place</legend>
              <div class="row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="bplace_bldg">Building / Block / House</label>
                    <input type="text" name="bplace_bldg" class="form-control" id="bplace_bldg" placeholder="Building / Block / House..." value="<?=set_value('bplace_bldg')?>" required/>
                  </div>
                </div><!-- /.col-sm-5 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="bplace_strt">Street</label>
                    <input type="text" name="bplace_strt" class="form-control" id="bplace_strt" placeholder="Street..." value="<?=set_value('bplace_strt')?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="bplace_brgy">Barangay</label>
                    <input type="text" name="bplace_brgy" class="form-control" id="bplace_brgy" placeholder="Barangay..." value="<?=set_value('bplace_brgy')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="bplace_city">City / Municipality</label>
                    <input type="text" name="bplace_city" class="form-control" id="bplace_city" placeholder="City / Municipality..." value="<?=set_value('bplace_city')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="bplace_prov">Province / Region</label>
                    <input type="text" name="bplace_prov" class="form-control" id="bplace_prov" placeholder="Province / Region..." value="<?=set_value('bplace_prov')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="bplace_zip">Zip Code</label>
                    <input type="text" name="bplace_zip" class="form-control" id="bplace_zip" placeholder="Zip Code..." value="<?=set_value('bplace_zip')?>" required/>
                  </div>
                </div><!-- /.col-sm-2 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="bplace_ctry">Country</label>
                    <input type="text" name="bplace_ctry" class="form-control" id="bplace_ctry" placeholder="Country..."  value="<?php if(set_value('bplace_ctry'))echo set_value('bplace_ctry'); else echo 'Philippines';?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
              </div><!-- /.row -->              
            </fieldset><!-- /.group-box -->
          </fieldset>
          <br />
          <fieldset id="spouse_field" <?php if(!set_select('civil_stat', 'Married'))echo'class="hidden"';?>>
            <legend>Spouse Information</legend>
            <div class="form-group">
              <div class="row">
               <div class="col-md-4 col-sm-12">
                  <label for="spouse_fname">Spouse First Name</label>
                  <input type="text" class="form-control char-val" name="spouse_fname" id="spouse_fname" placeholder="Enter First Name..." value="<?=set_value('spouse_fname')?>">
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="spouse_mname">Spouse Middle Name</label>
                  <input type="text" class="form-control char-val" name="spouse_mname" id="spouse_mname" placeholder="Enter Middle Name (Maiden)..." value="<?=set_value('spouse_mname')?>">
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <label for="spouse_lname">Spouse Last Name</label>
                  <input type="text" class="form-control char-val" name="spouse_lname" id="spouse_lname" placeholder="Enter Last Name (Maiden)..." value="<?=set_value('spouse_lname')?>">
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
            </div><!-- /.form-group -->

              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Birth Date:</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="spouse_bdate" class="form-control" id="spouse_bdate" value="<?=set_value('spouse_bdate')?>" placeholder="mm/dd/yyyy" />
                    </div>
                    <!-- /.input group -->
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-8 col-sm-12">
                  <div class="form-group">
                    <label for="spouse_bplace">Spouse Birth Place</label>     
                    <input type="text" name="spouse_bplace" id="spouse_bplace" class="form-control" value="<?=set_value('spouse_bplace')?>" />              
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->

              <div class="row">
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="spouse_contact">Contact Number</label>     
                    <input type="text" class="form-control" id="spouse_contact" name="spouse_contact" value="<?=set_value('spouse_contact')?>"  data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask> 
                  </div>
                </div><!-- /.col-md-3 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="spouse_occupation">Current Occupation</label>     
                    <input type="text" name="spouse_occupation" id="spouse_occupation" class="form-control" value="<?=set_value('spouse_occupation')?>" />   
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="spouse_occuaddr">Occupation Address</label>     
                    <input type="text" name="spouse_occuaddr" id="spouse_occuaddr" class="form-control" value="<?=set_value('spouse_occuaddr')?>" />              
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
          </fieldset><!-- /#spouse_field -->
          <br />
          <!-- Address and Contact Information -->
          <fieldset>
            <legend>Address and Contact Information</legend>

            <fieldset class="group-box">
              <legend class="group-box-title">Present Address</legend><!-- /.group-box-title -->
              <div class="row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="addr_bldg">Building / Block / House</label>
                    <input type="text" name="addr_bldg" class="form-control" id="addr_bldg" placeholder="Building / Block / House..." value="<?=set_value('addr_bldg')?>" required/>
                  </div>
                </div><!-- /.col-sm-5 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="addr_strt">Street</label>
                    <input type="text" name="addr_strt" class="form-control" id="addr_strt" placeholder="Street..." value="<?=set_value('addr_strt')?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="addr_brgy">Barangay</label>
                    <input type="text" name="addr_brgy" class="form-control" id="addr_brgy" placeholder="Barangay..." value="<?=set_value('addr_brgy')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="addr_city">City / Municipality</label>
                    <input type="text" name="addr_city" class="form-control" id="addr_city" placeholder="City / Municipality..." value="<?=set_value('addr_city')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="addr_prov">Province / Region</label>
                    <input type="text" name="addr_prov" class="form-control" id="addr_prov" placeholder="Province / Region..." value="<?=set_value('addr_prov')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="addr_zip">Zip Code</label>
                    <input type="text" name="addr_zip" class="form-control" id="addr_zip" placeholder="Zip Code..." value="<?=set_value('addr_zip')?>" required/>
                  </div>
                </div><!-- /.col-sm-2 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="addr_ctry">Country</label>
                    <input type="text" name="addr_ctry" class="form-control" id="addr_ctry" placeholder="Country..." value="<?php if(set_value('addr_ctry'))echo set_value('addr_ctry'); else echo 'Philippines';?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
              </div><!-- /.row -->
            </fieldset><!-- /.group-box -->
            
            <br />
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group pull-right">
                  <label onclick="sameAddress()">
                    <input type="checkbox" name="sameAddr" class="minimal-red" id="sameAddr" <?=set_checkbox('sameAddr'); ?>> Home Address is same with Present Address
                  </label>
                </div><!-- /.form-group -->
              </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->

            <fieldset class="group-box">
              <legend class="group-box-title">Home Address</legend><!-- /.group-box-title -->
              <div class="row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="home_bldg">Building / Block / House</label>
                    <input type="text" name="home_bldg" class="form-control" id="home_bldg" placeholder="Building / Block / House..." value="<?=set_value('home_bldg')?>" required/>
                  </div>
                </div><!-- /.col-sm-5 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="home_strt">Street</label>
                    <input type="text" name="home_strt" class="form-control" id="home_strt" placeholder="Street..." value="<?=set_value('home_strt')?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="home_brgy">Barangay</label>
                    <input type="text" name="home_brgy" class="form-control" id="home_brgy" placeholder="Barangay..." value="<?=set_value('home_brgy')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="home_city">City / Municipality</label>
                    <input type="text" name="home_city" class="form-control" id="home_city" placeholder="City / Municipality..." value="<?=set_value('home_city')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="home_prov">Province / Region</label>
                    <input type="text" name="home_prov" class="form-control" id="home_prov" placeholder="Province / Region..." value="<?=set_value('home_prov')?>" required/>
                  </div>
                </div><!-- /.col-sm-3 -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="home_zip">Zip Code</label>
                    <input type="text" name="home_zip" class="form-control" id="home_zip" placeholder="Zip Code..." value="<?=set_value('home_zip')?>" required/>
                  </div>
                </div><!-- /.col-sm-2 -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="home_country">Country</label>
                    <input type="text" name="home_ctry" class="form-control" id="home_country" placeholder="Country..." value="<?php if(set_value('home_country'))echo set_value('home_country'); else echo 'Philippines';?>" required/>
                  </div>
                </div><!-- /.col-sm-4 -->
              </div><!-- /.row -->
            </fieldset><!-- /.group-box -->

            <div class="row">
              <div class="col-md-6 col-sm-12">
                <fieldset class="group-box">
                  <legend class="group-box-title">Contact Numbers</legend><!-- /.group-box-title -->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Personal</label>
                      <input type="text" name="contact[]" id="" class="form-control" value="<?=set_value('contact[0]')?>" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask required="" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 -->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Home</label>
                      <input type="text" name="contact[]" id="" class="form-control" value="<?=set_value('contact[1]')?>" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 -->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Work</label>
                      <input type="text" name="contact[]" id="" class="form-control" value="<?=set_value('contact[2]')?>" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 -->
                </fieldset><!-- /.group-box -->
              </div><!-- /.col-md-6 col-sm-12 -->
              <div class="col-md-6 col-sm-12">
                <fieldset class="group-box">
                  <legend class="group-box-title">Email Addresses</legend><!-- /.group-box-title -->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Personal</label>
                      <input type="email" name="email[]" id="" class="form-control" placeholder="youremail@emailprovider.com" value="<?=set_value('email[0]')?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 -->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Home</label>
                      <input type="email" name="email[]" id="" class="form-control" placeholder="youremail@emailprovider.com" value="<?=set_value('email[1]')?>" />
                  </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 -->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Work</label>
                      <input type="email" name="email[]" id="" class="form-control" placeholder="youremail@emailprovider.com" value="<?=set_value('email[2]')?>" />
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 -->
                </fieldset><!-- /.group-box -->
              </div><!-- /.col-md-6 col-sm-12 -->
            </div><!-- /.row -->
          </fieldset>

          <br />

          <fieldset>
            <legend>Educational Attainment</legend>
            <div class="row">
              <div class="col-md-7 col-sm-12">
                <fieldset class="group-box">
                  <legend class="group-box-title">Highest Educational Level Attained</legend><!-- /.group-box-title -->
                  <div class="form-group">
                    <div class="col-xs-3">
                      <label>
                        <input type="radio" name="educ_level" value="0" class="minimal-red" required <?=set_radio('educ_level', '0'); ?>>
                        Elem. Grad
                      </label>
                    </div><!-- /.col-xs-3 -->
                    <div class="col-xs-3">
                      <label>
                        <input type="radio" name="educ_level" value="1" class="minimal-red" required <?=set_radio('educ_level', '1'); ?>>
                        High Sch. Grad
                      </label>
                    </div><!-- /.col-xs-4 --> 
                    <div class="col-xs-3">
                      <label>
                        <input type="radio" name="educ_level" value="2" class="minimal-red" required <?=set_radio('educ_level', '2'); ?>>
                        College Grad
                      </label>
                    </div><!-- /.col-xs-3 --> 
                    <div class="col-xs-3">
                      <label>
                        <input type="radio" name="educ_level" value="3" class="minimal-red" required <?=set_radio('educ_level', '3'); ?>>
                        Undergrad
                      </label>
                    </div><!-- /.col-xs-3 --> 
                  </div>
                </fieldset><!-- /.group-box -->
              </div><!-- /.col-md-7 col-sm-12 -->
              <div class="col-md-5 col-sm-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="educ_school">Last School Attended / Graduated</label>
                      <input type="text" name="educ_school" id="educ_school" class="form-control" placeholder="School / University / Academy"  value="<?=set_value('educ_school')?>"/>
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 -->
                </div><!-- /.row -->
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="educ_course">Course / Track</label>
                      <input type="text" name="educ_course" id="educ_course" class="form-control" placeholder="Course / Track / Level"  value="<?=set_value('educ_course')?>"/>
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 col-md-6 -->
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="educ_year">Year Attended</label>
                      <input type="text" name="educ_year" id="educ_year" class="form-control" placeholder="Attended / Graduated"  value="<?=set_value('educ_year')?>"/>
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-12 col-md-6 -->
                </div><!-- /.row -->
              </div><!-- /.col-md-5 col-sm-12 -->
            </div><!-- /.row -->
          </fieldset>

          <br />

          <fieldset>
            <legend>Employment and Business Information</legend>

            <fieldset class="group-box">
              <legend class="group-box-title">Employed</legend><!-- /.group-box-title -->
              <div class="row">
                <div class="col-md-3 col-sm-12">
                  <label for="employ_grp">Employer Type</label>
                  <div class="form-group">
                    <div class="col-xs-7">
                      <label>
                          <input type="radio" name="employ_grp" value="1" class="minimal-red" <?=set_radio('employ_grp', '1'); ?>>
                        Government
                      </label>
                    </div><!-- /.col-xs-6 -->
                    <div class="col-xs-5">
                      <label>
                          <input type="radio" name="employ_grp" value="0" class="minimal-red" <?=set_radio('employ_grp', '0'); ?>>
                        Private
                      </label>
                    </div><!-- /.col-xs-6 -->                    
                  </div>
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                      <label for="employ_name">Employer's Name</label>
                      <input type="text" name="employ_name" id="employ_name" class="form-control" placeholder="Name of Company..." value="<?=set_value('employ_name')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                      <label for="employ_position">Position</label>
                      <input type="text" name="employ_position" id="employ_position" class="form-control" placeholder="Position..." value="<?=set_value('employ_position')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-2 col-sm-12">
                  <div class="form-group">
                      <label for="employ_date">Date Started</label>
                      <input type="text" name="employ_date" id="employ_date" class="form-control" placeholder="mm/dd/yyyy" value="<?=set_value('employ_date')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="employ_addr">Work Address</label>
                      <input type="text" name="employ_addr" id="employ_addr" class="form-control" placeholder="Complete Address..." value="<?=set_value('employ_addr')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="employ_contact">Contact Number</label>
                    <input type="text" name="employ_contact" id="" class="form-control" value="<?=set_value('employ_contact')?>" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                      <label for="employ_status">Status</label>
                      <input type="text" name="employ_status" id="employ_status" class="form-control" placeholder="Status..." value="<?=set_value('employ_status')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="employ_remarks">Remarks</label>
                    <textarea name="employ_remarks" id="employ_remarks" class="form-control"></textarea>
                  </div><!-- /.form-group -->
                </div><!-- /.col-sm-12 -->
              </div><!-- /.row -->
            </fieldset><!-- /.group-box -->
            <br />

            <fieldset class="group-box">
              <legend class="group-box-title">Self Employed</legend><!-- /.group-box-title -->
              <div class="row">                
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="business_name">Business Name</label>
                      <input type="text" name="business_name" id="business_name" class="form-control" placeholder="Name of Company..." value="<?=set_value('business_name')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                      <label for="business_nature">Nature of Business</label>
                      <input type="text" name="business_nature" id="business_nature" class="form-control" placeholder="Position..." value="<?=set_value('business_nature')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-2 col-sm-12">
                  <div class="form-group">
                      <label for="business_date">Date Started</label>
                      <input type="text" name="business_date" id="business_date" class="form-control" placeholder="mm/dd/yyyy" value="<?=set_value('business_date')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="business_addr">Business Address</label>
                      <input type="text" name="business_addr" id="business_addr" class="form-control" placeholder="Business Address..." value="<?=set_value('business_addr')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="business_contact">Contact Number</label>
                    <input type="text" name="business_contact" id="" class="form-control" value="<?=set_value('business_contact')?>" data-inputmask='"mask": "(999) 999-9999"' placeholder="(912) 345-6789" data-mask />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                      <label for="business_status">Status</label>
                      <input type="text" name="business_status" id="business_status" class="form-control" placeholder="Status..." value="<?=set_value('business_status')?>" />
                  </div><!-- /.form-group -->
                </div><!-- /.col-md-4 col-sm-12 -->
              </div><!-- /.row -->
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="business_remarks">Remarks</label>
                    <textarea name="business_remarks" id="business_remarks" class="form-control"></textarea>
                  </div><!-- /.form-group -->
                </div><!-- /.col-sm-12 -->
              </div><!-- /.row -->
            </fieldset><!-- /.group-box -->
          </fieldset>
          <br />
          <fieldset>
            <legend>Application Information</legend>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label for="notes">Notes / Remarks</label>
                  <textarea name="notes" id="notes" rows="5" class="form-control"><?=set_value('notes')?></textarea>
                </div><!-- /.form-group -->
                <fieldset class="group-box">
                  <legend class="group-box-title">Applicant's Picture</legend><!-- /.group-box-title -->
                  <div class="row">
                    <div class="col-sm-3">
                      <label for="">Upload Picture</label>
                    </div><!-- /.col-sm-3 -->
                    <div class="col-sm-5">
                      <input type="file" name="img" id="img">  
                    </div><!-- /.col-sm-5 -->
                  </div><!-- /.row -->    
                </fieldset><!-- /.group-box -->
              </div><!-- /.col-md-6 col-sm-12 -->
              <div class="col-md-6 col-sm-12">
                <div class="callout callout-info">
                  <p>Please review all of your input before submitting.</p>
                </div><!-- /.callout callout-info -->
                <div class="row">
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-lg btn-flat btn-block btn-success">Register Account</button>
                  </div><!-- /.col-sm-6 -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>
                        <input type="checkbox" class="minimal-red" required> I have verified all inputs
                      </label>
                    </div><!-- /.form-group -->
                  </div><!-- /.col-sm-6 -->                  
                </div><!-- /.row -->
              </div><!-- /.col-md-6 col-sm-12 -->
            </div><!-- /.row -->
          </fieldset>
          <?=form_close()?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
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
    <script src="<?=base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/input-mask/jquery.inputmask.js')?>"></script>
    <script src="<?=base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js')?>"></script>
    <script src="<?=base_url('assets/custom/js/customvalidation.js')?>"></script>

    <script src="<?=base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>

    <script type="text/javascript">
    $('[data-mask]').inputmask();

    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    });

    //Date picker
    $('#birthdate, #spouse_bdate, #employ_date, #business_date').datepicker({
      autoclose: true
    });


   $(document).ready(function(){
      $('#civil_stat').change(function(e) {
              var stat = $('#civil_stat').val();

              if(stat == "Married") {
                $('#spouse_field').removeClass();
              } else {
                $('#spouse_field').addClass('hidden');
              }

          });


              
      });



    
    function sameAddress() {
      
      if(document.getElementById("sameAddr").checked == true) {

        console.log("unchecked");
        //disable fields  
        
        document.getElementById("home_bldg").value = "";
        document.getElementById("home_strt").value = "";
        document.getElementById("home_brgy").value = "";
        document.getElementById("home_city").value = "";
        document.getElementById("home_prov").value = "";
        document.getElementById("home_zip").value = "";
        document.getElementById("home_ctry").value = "";  
        

      } else {

        
        console.log("checked");

        
        document.getElementById("home_bldg").value = document.getElementById("addr_bldg").value;
        document.getElementById("home_strt").value = document.getElementById("addr_strt").value;
        document.getElementById("home_brgy").value = document.getElementById("addr_brgy").value;
        document.getElementById("home_city").value = document.getElementById("addr_city").value;
        document.getElementById("home_prov").value = document.getElementById("addr_prov").value;
        document.getElementById("home_zip").value = document.getElementById("addr_zip").value;
        document.getElementById("home_ctry").value = document.getElementById("addr_ctry").value;     

       
      }


    }
    
    </script>
  
</body>
</html>
