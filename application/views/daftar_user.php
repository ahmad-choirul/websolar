  <!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
  <section class="content" >
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
    <div class="row">
      <div class="col-lg-4">
        <div class="box" >
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Data User</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <!-- /.box -->
              <form class="form-horizontal" method="POST" action="<?php echo site_url('Cuser/inupdeluser') ?>" >
                <div class="box-body">
                 <div class="form-group">
                  <label for="alamat" class="col-sm-3 control-label">ID </label>

                  <div class="col-sm-9">

                    <input type="text" value="insert" hidden="hidden" name="set"   id="set">
                    <input type="text" readonly="readonly" maxlength="100" name="id" hidden="true" id="id" class="form-control"  placeholder="ID">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama_sales" class="col-sm-3 control-label">Nama</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" id="nama" maxlength="50" class="form-control"  placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label for="alamat" class="col-sm-3 control-label">Username</label>

                  <div class="col-sm-9">
                    <input type="text" maxlength="30" name="username" id="username" class="form-control"  placeholder="username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="hp" class="col-sm-3 control-label" >Password</label>

                  <div class="col-sm-9">
                    <input type="text" maxlength="30" name="password" id="password" class="form-control"  placeholder="password">
                  </div>
                </div>


              </div>
              <!-- /.box-body -->
              <div class="box-footer">

                <button type="submit" class="btn btn-danger pull-right">Simpan</button>
                <a class="btn btn-primary " onclick="bersih()">Clear <i class="glyphicon glyphicon-trash"></i></a>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box-body -->
          <!-- /.box-footer-->
        </div>
      </div>
      <div class="col-lg-8">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar User</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
            title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <!-- /.box -->
            <div class="table-responsive">

              <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th> NO </th>
                    <!-- <th> ID </th> -->
                    <th> Nama </th>
                    <th> Username </th>
                    <th> Password </th>
                    <th style="width: 125px;"> Aksi</p> </th>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                  $no=1;
                  foreach ($listuser as $data): ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <!-- <td><?php echo $data->id; ?></td> -->
                      <td><?php echo $data->nama; ?></td>
                      <td><?php echo $data->username; ?></td>
                      <td><?php echo "*********"; ?></td>
                      <td style="text-align: center;">
                        <button class="btn btn-sm btn-warning" onclick="updatedata(
                            '<?php echo $data->id; ?>',
                            '<?php echo $data->nama; ?>',
                            '<?php echo $data->username; ?>')"><i class="glyphicon glyphicon-edit"></i></button>
                      </td>
                    </tr>

                  <?php endforeach ?>

                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            Footer

          </div>
          <!-- /.box-footer-->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    function updatedata(id,nama,username) {
     document.getElementById("id").value = id;
     document.getElementById("nama").value = nama;
     document.getElementById("username").value = username;
     document.getElementById("set").value = "update";
   }

   function bersih() {
     document.getElementById("id").value = '';
     document.getElementById("nama").value = '';
          document.getElementById("username").value = '';
     document.getElementById("password").value = '';
     document.getElementById("set").value = "insert";
   }
 </script>