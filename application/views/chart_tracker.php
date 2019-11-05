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
foreach ($arraylog as $key => $value) {
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
		text: "Chart Sudut Tracker" 
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


dataSeries.dataPoints = dataPoints;
data.push(dataSeries);               

</script> 
<section class="content">
		graph sensor tracker
		<small></small>
	</h1>
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	<script src="<?php echo base_url('assets/canva/canvasjs.min.js') ?>" type="text/javascript"></script>
</section><!-- /.content -->	

</script>

