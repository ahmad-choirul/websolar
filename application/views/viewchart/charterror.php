<?php
 
$dataPoints1 = array();
$dataPoints2 = array();
$updateInterval = 5000; //in millisecond
$initialNumberOfDataPoints = 20;
$x = time() * 1000 - $updateInterval * $initialNumberOfDataPoints;
$y1 = 0;
$y2 = 0;
// generates first set of dataPoints 
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var updateInterval = <?php echo $updateInterval ?>;
var dataPoints1 = <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>;
var dataPoints2 = <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>;
var yValue1 = <?php echo $y1 ?>;
var yValue2 = <?php echo $y2 ?>;
var xValue = <?php echo $x ?>;
 
var chart = new CanvasJS.Chart("chartContainer", {
	zoomEnabled: true,
	title: {
		text: "Data Error"
	},
	axisX: {
		title: "chart updates every " + updateInterval / 1000 + " secs"
	},
	axisY:{
		suffix: " derajat",
		includeZero: false
	}, 
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		verticalAlign: "top",
		fontSize: 22,
		fontColor: "dimGrey",
		itemclick : toggleDataSeries
	},
	data: [{ 
			type: "line",
			name: "Error Vertikal",
			xValueType: "dateTime",
			yValueFormatString: "#,### derajat",
			xValueFormatString: "hh:mm:ss TT",
			showInLegend: true,
			legendText: "{name} " + yValue1 + " derajat",
			dataPoints: dataPoints1
		},
		{
			type: "line",
			name: "Error Horizontal" ,
			xValueType: "dateTime",
			yValueFormatString: "#,### derajat",
			showInLegend: true,
			legendText: "{name} " + yValue2 + " derajat",
			dataPoints: dataPoints2
	}]
});
 
chart.render();
setInterval(function(){updateChart()}, updateInterval);
 
function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}
 ////////////////////////data json ////////////////
 var datatotal = new Array();
  function getdatatotal() {

   var request = new XMLHttpRequest();
   request.open('GET', 'ambildataratatotal', true);
   request.onload = function () {
    datatotal = JSON.parse(this.response);
  }
  request.send();
  return datatotal;
}
////////////////////////////


function updateChart() {
	var datajson = getdatatotal();

	var deltaY1, deltaY2;
	xValue += updateInterval;

	// adding random value
	var v1=datajson['errorvert'];
	var v2=datajson['errorhor'];

	yValue1 = parseInt(v1, 10);
	yValue2 = parseInt(v2, 10);
if (typeof yValue1 === "undefined") {
  yValue1 = 100;
	yValue2 = 100;
}
    console.log(yValue2);

	// pushing the new values
	dataPoints1.push({
		x: xValue,
		y: yValue1
	});
	dataPoints2.push({
		x: xValue,
		y: yValue2
	});
 if (dataPoints2.length>25) {
  dataPoints1.shift();
  dataPoints2.shift();
} 
	// updating legend text with  updated with y Value 
	chart.options.data[0].legendText = " Error Vertikal " + yValue1 + " derajat";
	chart.options.data[1].legendText = " Error Horizontal " + yValue2+ " derajat"; 
	chart.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>    