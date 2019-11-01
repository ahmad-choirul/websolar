  <!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
  <section class="content" >
    <div class="row">
      
      <div class="col-lg-12">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">History Sensor</h3>

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
                    <th> waktu </th>  
                    <th> rata atas </th>
                    <th> rata bawah </th>
                    <th> rata kiri </th>
                    <th> rata kanan </th>
                    <th> error vertikal </th>  
                    <th> error horizontal </th>  
                  </tr>
                </thead>
                <tbody>

                  <?php 
                  $no=1;
                  foreach ($daftar as $data): ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $data->waktu; ?></td>
                      <td><?php echo $data->rataatas; ?></td>
                      <td><?php echo $data->ratabawah; ?></td>
                      <td><?php echo $data->ratakiri; ?></td>
                      <td><?php echo $data->ratakanan; ?></td>
                      <td><?php echo $data->errorvert; ?></td>
                      <td><?php echo $data->errorhor; ?></td>
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