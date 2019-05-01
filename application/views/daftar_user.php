  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $judul; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-lg-4">
          <div class="box">
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
                <form class="form-horizontal" method="POST" action="<?php echo site_url('Csales/inupdelsales') ?>" >
                  <div class="box-body">
                   <div class="form-group">
                    <label for="alamat" class="col-sm-3 control-label">ID </label>

                    <div class="col-sm-9">

                      <input type="text" value="insert" hidden="hidden" name="set"   id="set">
                      <input type="text" readonly="readonly" maxlength="100" name="id_sales" id="id_sales" class="form-control"  placeholder="ID Sales">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama_sales" class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-9">
                      <input type="text" name="nama_sales" id="nama_sales" maxlength="50" class="form-control"  placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alamat" class="col-sm-3 control-label">Username</label>

                    <div class="col-sm-9">
                      <input type="text" maxlength="30" name="alamat" id="alamat" class="form-control"  placeholder="Alamat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="hp" class="col-sm-3 control-label" >Password</label>

                    <div class="col-sm-9">
                      <input type="text" maxlength="30" name="no_hp" id="no_hp" class="form-control"  placeholder="NoHP">
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
                      <th> ID </th>
                      <th> Nama </th>
                      <th> Username </th>
                      <th> Password </th>
                      <th style="width: 125px;"> Aksi</p> </th>
                    </tr>
                  </thead>
                  <tbody>

                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">
                          <button class="btn btn-sm btn-warning" onclick=""><i class="glyphicon glyphicon-edit"></i></button>
                            <button class="btn btn-sm btn-danger" onclick=""><i class="glyphicon glyphicon-trash"></i></button>
                          </td>
                        </tr>

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

        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script type="text/javascript">
      function update_sales(id_sales,nama_sales,alamat,no_hp,status) {
       document.getElementById("id_sales").value = id_sales;
       document.getElementById("nama_sales").value = nama_sales;
       document.getElementById("alamat").value = alamat;
       document.getElementById("no_hp").value = no_hp;
       document.getElementById("status").value = status;
       document.getElementById("set").value = "update";
     }
     function delete_sales(a) {
       if (confirm('yakin hapus barang?')) {
         var form = $('<form action="<?php echo site_url('Csales/inupdelsales'); ?>" method="POST">' +
          '<input type="hidden" name="id_sales" value="' + a + '" />' +
          '<input type="hidden" name="set" value="delete" />' +
          '</form>');
         $('body').append(form);
         $(form).submit();
       } else {
         return false;
       }

     }
     function bersih() {
       document.getElementById("id_sales").value = '';
       document.getElementById("nama_sales").value = '';
       document.getElementById("alamat").value = '';
       document.getElementById("no_hp").value = '';
       document.getElementById("set").value = "insert";
     }
   </script>