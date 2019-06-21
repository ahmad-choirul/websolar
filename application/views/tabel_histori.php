<?php 
$datapoin=array();
$datapoin2=array();
for ($i=0; $i <count($arraylog) ; $i++) { 
	$poin=array("label"=>$arraylog[$i]['waktu'],"y"=>$arraylog[$i]['errorvert']);
	array_push($datapoin, $poin);
	$poin2=array("label"=>$arraylog[$i]['waktu'],"y"=>$arraylog[$i]['errorhor']);
	array_push($datapoin2, $poin2);
}

 ?>
<script>
	window.onload = function () {
		var arraylog = <?php echo json_encode($datapoin, JSON_NUMERIC_CHECK); ?>;
		var arraylog2 = <?php echo json_encode($datapoin2, JSON_NUMERIC_CHECK); ?>;

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			exportEnabled: true,
			title:{
				text: "Data Log Error"             
			}, 
			axisY:{
				title: "Besar Error"
			},
			toolTip: {
				shared: true
			},
			legend:{
				cursor:"pointer",
				itemclick: toggleDataSeries
			},
			data: [{        
					type: "spline",
					name: "error vertikal",        
					showInLegend: true,
					dataPoints: arraylog
				}, 
				{        
					type: "spline",
					name: "error horizontal",        
					showInLegend: true,
					dataPoints: arraylog2
				}
				]
			});

		chart.render();

		function toggleDataSeries(e) {
			if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			}
			else {
				e.dataSeries.visible = true;            
			}
			chart.render();
		}

	}
</script>

<section class="content-header">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>150/150<sup style="font-size: 20px">W</sup></h3>
					<p>WATT</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
			</div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3>53/53<sup style="font-size: 20px">V</sup></h3>
					<p>VOLTAGE</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
			</div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>44/44<sup style="font-size: 20px">A</sup></h3>
					<p>AMPERE</p>
				</div>
				<div class="icon">
					<i class="ion ion-pie-graph"></i>
				</div>
			</div>
		</div><!-- ./col -->
	</div><!-- /.row -->
</section>

<section class="content">
	<h1>
		graph sensor realtime
		<small>Error</small>
	</h1>
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	<script src="<?php echo base_url('assets/canva/canvasjs.min.js') ?>" type="text/javascript"></script>

</section><!-- /.content -->	

</script>

