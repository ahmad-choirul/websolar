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

?> 	
<!DOCTYPE HTML>
<html>
<head>
	<script>
	window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	zoomEnabled: true,
	title:{
		text: "Try Zooming and Panning" 
	},
	axisY :{
		includeZero:false
	},
	data: data  // random generator below
});
chart.render();

}

  var limit = 1000;

var y = 0;
var data = [];
var dataSeries = { type: "line" };
var dataPoints = [];


var arraylog2 = <?php echo json_encode($arraylog); ?>;

for (var i = 0; i < arraylog2.length; i++) {
	for (var j = 0; j < arraylog2[i].length; j++) {
		dataPoints1.push({
			x: arraylog2[i].waktu,
			y: arraylog2[i].errorvert
		});
		dataPoints2.push({
			x: arraylog2[i].waktu,
			y: arraylog2[i].errorhor
		});
	}
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
</head>
<body>
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	<script src="<?php echo base_url('assets/canva/canvasjs.min.js') ?>" type="text/javascript"></script>
</body>
</html>    