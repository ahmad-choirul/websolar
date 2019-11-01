
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Blank
      <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
     <?php if ($this->session->flashdata('succesinsert') != null): ?>
  <div class="alert alert-info alert-dismissible" data-auto-dismiss role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>sukses!</strong><?php echo $this->session->flashdata('succesinsert'); ?>
  </div>
<?php endif ?>
<?php if ($this->session->flashdata('failinsert') != null): ?>
  <div class="alert alert-danger alert-dismissible" data-auto-dismiss role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>warning!</strong> <?php echo $this->session->flashdata('failinsert'); ?>
  </div>
<?php endif ?>

    <div >
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Akun</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
            title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <form class="form-horizontal" >
              <div class="box-body">
               <div class="form-group">
                <label for="alamat" class="col-sm-3 control-label">ID </label>

                <div class="col-sm-9">
                 <?=form_input(array('id' => 'id','name' => 'id', 'value' =>$id,'placeholder'=>'id akun', 'class' => 'form-control col-md-7 col-xs-12', 'required' => true,'readonly' => true,'maxlength'=>'1'));?>
                </div>
              </div>
              <div class="form-group">
                <label for="username" class="col-sm-3 control-label">username</label>
                <div class="col-sm-9">
                  <?=form_input(array('id' => 'username','name' => 'username', 'value' =>$username,'placeholder'=>'username', 'class' => 'form-control col-md-7 col-xs-12', 'required' => true,'maxlength'=>'1'));?>
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-3 control-label">password</label>
                <div class="col-sm-9">
                 <?=form_input(array('id' => 'password','name' => 'password','type'=>'password', 'value' =>$password,'placeholder'=>'password', 'class' => 'form-control col-md-7 col-xs-12', 'required' => true,'maxlength'=>'12'));?>
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Ulangi password</label>
                <div class="col-sm-9">
                  <?=form_input(array('id' => 'password2','name' => 'password2','type'=>'password', 'value' =>$password,'placeholder'=>'password', 'class' => 'form-control col-md-7 col-xs-12', 'required' => true,'maxlength'=>'12'));?>
                </div>
              </div>
             <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Status</label>
                <div class="col-sm-9">
                  <?php if ($status='1'): ?>
                    aktif
                    <?php else: ?>
                      nonaktif
                  <?php endif ?>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a class="btn btn-primary pull-right" onclick="kirim()"> Simpan <i class="glyphicon glyphicon-trash"></i></a>

            </div>
            <!-- /.box-footer -->
          </form>
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer-->
      </div>
    </div>
  </section>
  <!-- /.content -->
<!-- </div> -->
<!-- /.content-wrapper -->
<script type="text/javascript">
  function kirim() {
    var id = document.getElementById("id").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;
    var str = '';
    if (username=='') {
      var str = str.concat('username belum diisi,'); 
    }
     if (password==''||password2=='') {
      var str = str.concat('password belum diisi,'); 
    }
    if (password!==password2) {
      var str = str.concat('password tidak sama,'); 
    }
    if (str!='') {
      alert(str);
    }else{
      var form = $('<form action="<?php echo site_url("Cuser/updateprofil"); ?>" method="POST">' +
          '<input type="hidden" name="id" value="' + id + '" />'+
          '<input type="hidden" name="username" value="' + username + '" />'+
          '<input type="hidden" name="password" value="' + password + '" />'+
          '<input type="hidden" name="password2" value="' + password2 + '" />'+
          '<input type="hidden" name="set" value="update" />' +
          '</form>');
        $('body').append(form);
        $(form).submit();
    }
  }
</script>