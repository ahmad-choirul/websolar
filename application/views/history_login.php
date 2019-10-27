  <!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
  <section class="content" >
    <div class="row">
      
      <div class="col-lg-12">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">History Login</h3>

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
                    <th> username </th>
                    <th> IP Address </th>
                    <th> browser </th>
                    <th> os </th>
                    <th> waktu </th>=                  </tr>
                </thead>
                <tbody>

                  <?php 
                  $no=1;
                  foreach ($daftarlogin as $data): ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $data->username; ?></td>
                      <td><?php echo $data->ip_address; ?></td>
                      <td><?php echo $data->browser; ?></td>
                      <td><?php echo $data->os; ?></td>
                      <td><?php echo $data->waktu; ?></td>
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
     document.getElementById("alamat").value = '';
     document.getElementById("username").value = '';
     document.getElementById("password").value = '';
     document.getElementById("set").value = "insert";
   }
 </script>