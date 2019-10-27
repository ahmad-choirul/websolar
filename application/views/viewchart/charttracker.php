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
	array_push($temp, str_replace(',','.',$value['pitch']));
	array_push($temp,  str_replace(',','.',$value['roll']));
	array_push($temp,  str_replace(',','.',$value['waktu']));
	array_push($dataPointsphp, $temp);
}
echo "<pre>";
// print_r ($dataPointsphp);
echo "</pre>";
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
		text: "Chart Sudut Aktuator" 
	},
	axisY :{
		includeZero:false
	},
	// data: data  // random generator below
	data: [{ 
        type: "spline",
        name: "Pitch",
        xValueType: "dateTime",
        yValueFormatString: "#,### derajat",
        xValueFormatString: "hh:mm:ss TT",
        showInLegend: true,
        dataPoints: dataPoints
      },
      { 
        type: "spline",
        name: "Roll",
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
</head>
<body>
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	<script src="<?php echo base_url('assets/canva/canvasjs.min.js') ?>" type="text/javascript"></script>
</body>
</html>    