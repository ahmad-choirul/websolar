<?php

$dataPoints1 = array();
$dataPoints2 = array();
$dataPoints3 = array();
$dataPoints4 = array();
$updateInterval = 5000; //in millisecond
$initialNumberOfDataPoints = 20;
$x = time() * 1000 - $updateInterval * $initialNumberOfDataPoints;

$y1 = 700;
$y2 = 700;
$y3 = 700;
$y4 = 700;
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
      var dataPoints3 = <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>;
      var dataPoints4 = <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>;
      var yValue1 = <?php echo $y1 ?>;
      var yValue2 = <?php echo $y2 ?>;
      var yValue3 = <?php echo $y3 ?>;
      var yValue4 = <?php echo $y4 ?>;
      var xValue = <?php echo $x ?>;

      var chart = new CanvasJS.Chart("chartContainer", {
        zoomEnabled: true,
        title: {
          text: "Data Rata-rata Sensor"
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
          name: "Rata-rata Atas",
          xValueType: "dateTime",
          yValueFormatString: "#,### derajat",
          xValueFormatString: "hh:mm:ss TT",
          showInLegend: true,
          legendText: "{name} " + yValue1 + " derajat",
          dataPoints: dataPoints1
        },
        { 
          type: "line",
          name: "Rata-rata Bawah",
          xValueType: "dateTime",
          yValueFormatString: "#,### derajat",
          xValueFormatString: "hh:mm:ss TT",
          showInLegend: true,
          legendText: "{name} " + yValue2 + " derajat",
          dataPoints: dataPoints2
        },
        { 
          type: "line",
          name: "Rata-rata Kanan",
          xValueType: "dateTime",
          yValueFormatString: "#,### derajat",
          xValueFormatString: "hh:mm:ss TT",
          showInLegend: true,
          legendText: "{name} " + yValue3 + " derajat",
          dataPoints: dataPoints3
        },
        {       
          type: "line",
          name: "Rata-rata Kiri" ,
          xValueType: "dateTime",
          yValueFormatString: "#,### derajat",
          showInLegend: true,
          legendText: "{name} " + yValue4 + " derajat",
          dataPoints: dataPoints4
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

  var deltaY1, deltaY2,deltaY5, deltaY4;
  xValue += updateInterval;

  // adding random value
  var v1=datajson['rataatas'];
  var v2=datajson['ratabawah'];
  var v3=datajson['ratakanan'];
  var v4=datajson['ratakiri'];

  yValue1 = parseInt(v1, 10);
  yValue2 = parseInt(v2, 10);
  yValue3 = parseInt(v3, 10);
  yValue4 = parseInt(v4, 10);

  // pushing the new values
  dataPoints1.push({
    x: xValue,
    y: yValue1
  });
  dataPoints2.push({
    x: xValue,
    y: yValue2
  });
  dataPoints3.push({
    x: xValue,
    y: yValue3
  });
  dataPoints4.push({
    x: xValue,
    y: yValue4
  });
if (dataPoints1.length>25) {
  dataPoints4.shift();
  dataPoints3.shift();
  dataPoints2.shift();
  dataPoints1.shift();
} 
  // updating legend text with  updated with y Value 
  chart.options.data[0].legendText = " Rata-rata Atas " + yValue1 + " derajat";
  chart.options.data[1].legendText = " Rata-rata Bawah " + yValue2+ " derajat"; 
  chart.options.data[2].legendText = " Rata-rata Kanan " + yValue3 + " derajat";
  chart.options.data[3].legendText = " Rata-rata Kiri " + yValue4+ " derajat"; 
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