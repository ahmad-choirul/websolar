  <!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
  <section class="content" >
    <div class="row">
      
      <div class="col-lg-12">
       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">History Tracker</h3>
         
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
                    <th> elevasi </th>
                    <th> sudut elevasi </th>
                    <th> azimuth </th>
                    <th> sudut azimuth </th>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                  $no=1;
                  foreach ($daftar as $data): ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $data->waktu; ?></td>
                      <td><?php echo $data->elevasi; ?></td>
                      <td><?php echo $data->sudut_azimuth; ?></td>
                      <td><?php echo $data->azimuth; ?></td>
                      <td><?php echo $data->sudut_elevasi; ?></td>

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