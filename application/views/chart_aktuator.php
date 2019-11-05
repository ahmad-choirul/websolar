<?php
$dataPoints1 = array();
$dataPoints2 = array();
// $dataPoints1 = $arrayerrorver;$dataPoints2 = array();

$updateInterval = 10000; //in millisecond
$initialNumberOfDataPoints = 300;
$x = time() * 1000 - $updateInterval * $initialNumberOfDataPoints;
$y1 = 0;
$y2 = 0;
// generates first set of dataPoints 
$dataPointsphp = array();
foreach ($arrayaktuator as $key => $value) {
	$temp = array();
	array_push($temp, str_replace(',','.',$value['sudut_elevasi']));
	array_push($temp,  str_replace(',','.',$value['sudut_azimuth']));
	array_push($temp,  str_replace(',','.',$value['waktu']));
	array_push($dataPointsphp, $temp);
}
?> 	
<script>
	window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	zoomEnabled: true,
	title:{
		text: "Chart Sudut Aktuator" 
	},
	axisY :{
		includeZero:false
	},
	// data: data  // random generator below
	data: [{ 
        type: "spline",
        name: "sudut_elevasi",
        xValueType: "dateTime",
        yValueFormatString: "#,### derajat",
        xValueFormatString: "hh:mm:ss TT",
        showInLegend: true,
        dataPoints: dataPoints
      },
      { 
        type: "spline",
        name: "sudut_azimuth",
        xValueType: "dateTime",
        yValueFormatString: "#,### derajat",
        xValueFormatString: "hh:mm:ss TT",
        showInLegend: true,
        dataPoints: dataPoints2
      }]
    });
chart.render();

}

  var limit = 1000;

var y = 0;
var data = [];
var dataSeries = { type: "line" };
var dataPoints = [];
var dataPoints2 = [];


var arraylog2 = <?php echo json_encode($dataPointsphp); ?>;
// console.table(arraylog2);
// alert(parseFloat(arraylog2[0][0]))
			var as = 0;

	for (var j = 0; j < 300; j++) {
		dataPoints.push({
			x: as,
			// x: (Math.random()),
			y: parseFloat(arraylog2[j][0])
		});
		dataPoints2.push({
			x: as,
			y: parseFloat(arraylog2[j][1])
		});
		as++;
	}


// for (var i = 0; i < limit; i += 1) {
// 	y += (Math.random() * 10 - 5);
// 	dataPoints.push({
// 		x: i - limit / 2,
// 		y: y                
// 	});
// }
dataSeries.dataPoints = dataPoints;
data.push(dataSeries);               

</script>
<section class="content-header">
	<!-- <div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>150/150<sup style="font-size: 20px">W</sup></h3>
					<p>WATT</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
					<h3>53/53<sup style="font-size: 20px">V</sup></h3>
					<p>VOLTAGE</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>44/44<sup style="font-size: 20px">A</sup></h3>
					<p>AMPERE</p>
				</div>
				<div class="icon">
					<i class="ion ion-pie-graph"></i>
				</div>
			</div>
		</div>
	</div> -->
</section>

<section class="content">
		graph sensor Aktuator
		<small></small>
	</h1>
	<!-- <iframe width="100%" height=400px frameborder="0" src="<?php echo site_url('Cchart/chartpergerakanaktuator') ?>"></iframe> -->
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	<script src="<?php echo base_url('assets/canva/canvasjs.min.js') ?>" type="text/javascript"></script>
</section><!-- /.content -->	

</script>

