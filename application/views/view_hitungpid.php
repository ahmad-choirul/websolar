<section class="content-header">
	<h1>
	Hitung Manual    </h1>
</section>
<br>

<br>

<!-- Form Element sizes -->
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">input error</h3>
	</div>
	<form method="POST" action="<?php echo site_url('Chitungpid/inputerror'); ?> ">
		<div class="box-body">
			<input class="form-control input-lg" type="text" name="feedback" id="feedback" placeholder="input error">
			<br>
		</div>
	</form>
	<!-- /.box-body -->
</div>
<!-- /.box -->

<div class="row">
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<i class="fa fa-text-width"></i>

				<h3 class="box-title">Description</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<dl>
					<!-- <dt>Description lists</dt>
					<dd>A description list is perfect for defining terms.</dd>
					<dt>Euismod</dt>
					<dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
					<dd>Donec id elit non mi porta gravida at eget metus.</dd>
					<dt>Malesuada porta</dt>
					<dd>Etiam porta sem malesuada magna mollis euismod.</dd> -->
					<?php echo "<pre>";
					print_r ($hasiloutput);
					echo "</pre>";  ?>
				</dl>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- ./col -->
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<i class="fa fa-text-width"></i>

				<h3 class="box-title">setpoint = <?php echo $setpoint; ?></h3>
			</div>
			<!-- /.box-header -->
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Bordered Table</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered">
								<tr>
									<th style="width: 10px">no</th>
									<th>feedback</th>
									<th>error sebelumnya</th>
									<th >hasil</th>
									<th >aksi</th>
								</tr>
								<?php $no=1; foreach ($listtotal as $data): ?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><span class="badge bg-green"><?php echo $data->feedback; ?></span></td>
									<td>
										<span class="badge bg-blue"><?php echo $data->errorsebelum; ?></span>
									</td>
									<td><span class="badge bg-red"><?php echo $data->hasil; ?></span></td>
									<td>
										<a href="<?php echo site_url();?>Chitungpid/hitungpid/<?php echo $data->feedback; ?>/<?php echo $data->errorsebelum; ?>">
											<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
											</button>	
										</a>
										<a href="<?php echo site_url();?>Chitungpid/hapusdata/<?php echo $data->id; ?>">
											<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
											</button>	
										</a>
									</td>
								</tr>
							<?php endforeach ?>

						</table>
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix">
						<ul class="pagination pagination-sm no-margin pull-right">
							<li><a href="#">&laquo;</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>
					</div>
				</div>
				<!-- /.box -->
			</div>
			<!-- /.row -->

			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->
<!-- Main content -->
<section class="content">

</section><!-- /.content -->
