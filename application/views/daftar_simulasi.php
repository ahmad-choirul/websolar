  <!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
  <section class="content" >
    <div class="row">
      <div class="col-lg-4">
        <div class="box" >
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Data Alat</h3>
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
              <form class="form-horizontal" method="POST" action="<?php echo site_url('Csimulasi/inupdelsimulasi') ?>" >
                <div class="box-body">
                 <div class="form-group">
                  <label for="alamat" class="col-sm-3 control-label">ID </label>

                  <div class="col-sm-9">

                    <input type="text" value="insert" hidden="hidden" name="set"   id="set">
                    <input type="text" readonly="readonly" maxlength="100" name="id" id="id" class="form-control"  placeholder="ID">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama_sales" class="col-sm-3 control-label">Nama</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" id="nama" maxlength="50" class="form-control"  placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label for="alamat" class="col-sm-3 control-label">Watt</label>

                  <div class="col-sm-9">
                    <input type="text" maxlength="30" name="watt" id="watt" class="form-control"  placeholder="watt">
                  </div>
                </div>
                <div class="form-group">
                  <label for="hp" class="col-sm-3 control-label" >Lama</label>

                  <div class="col-sm-9">
                    <input type="text" maxlength="30" name="lama" id="lama" class="form-control"  placeholder="lama penggunaan">
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
                    <th> Watt </th>
                    <th> Penggunaan </th>
                    <th style="width: 125px;"> Aksi</p> </th>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                  $no=1;
                  foreach ($listsimulasi as $data): ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <!-- <td><?php echo $data->id; ?></td> -->
                      <td><?php echo $data->nama; ?></td>
                      <td><?php echo $data->watt; ?> w</td>
                      <td><?php echo $data->lama; ?> jam</td>
                      <td style="text-align: center;">
                        <button class="btn btn-sm btn-warning" onclick="updatedata(
                            '<?php echo $data->id; ?>',
                            '<?php echo $data->nama; ?>',
                            '<?php echo $data->watt; ?>',
                            '<?php echo $data->lama; ?>')"><i class="glyphicon glyphicon-edit"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="deletedata(
                            '<?php echo $data->id; ?>')"><i class="glyphicon glyphicon-trash"></i></button>
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
    function updatedata(id,nama,watt,lama) {
     document.getElementById("id").value = id;
     document.getElementById("nama").value = nama;
     document.getElementById("watt").value = watt;
     document.getElementById("lama").value = lama;
     document.getElementById("set").value = "update";
   }
 function deletedata(a) {
       if (confirm('yakin hapus barang?')) {
         var form = $('<form action="<?php echo site_url('Csimulasi/inupdelsimulasi'); ?>" method="POST">' +
          '<input type="hidden" name="id" value="' + a + '" />' +
          '<input type="hidden" name="set" value="delete" />' +
          '</form>');
         $('body').append(form);
         $(form).submit();
       } else {
         return false;
       }

     }
   function bersih() {
     document.getElementById("id").value = '';
     document.getElementById("nama").value = '';
     document.getElementById("watt").value = '';
     document.getElementById("lama").value = '';
     document.getElementById("set").value = "insert";
   }
 </script>