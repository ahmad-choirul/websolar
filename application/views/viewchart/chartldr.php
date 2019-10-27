<?php

$updateInterval = 5000; //in millisecond
$initialNumberOfDataPoints = 50;
$x = time() * 1000 - $updateInterval * $initialNumberOfDataPoints;
// for ($i=0; $i <count($arraylog) ; $i++) { 
//   $poin=array("x"=>$arraylog[$i]['waktu'],"y"=>$arraylog[$i]['rataatas']);
//   array_push($dataPoints1, $poin);
//   $poin2=array("x"=>$arraylog[$i]['waktu'],"y"=>$arraylog[$i]['ratabawah']);
//   array_push($dataPoints2, $poin2);
//   $poin3=array("x"=>$arraylog[$i]['waktu'],"y"=>$arraylog[$i]['ratakanan']);
//   array_push($dataPoints3, $poin3);
//   $poin4=array("x"=>$arraylog[$i]['waktu'],"y"=>$arraylog[$i]['ratakiri']);
//   array_push($dataPoints4, $poin4);
// }
$dataPointsphp = array();
foreach ($arraylog as $key => $value) {
  $temp = array();
  array_push($temp, $value['rataatas']);
  array_push($temp,  $value['ratabawah']);
    array_push($temp,$value['ratakanan']);
  array_push($temp, $value['ratakiri']);
  array_push($temp, $value['waktu']);
  array_push($dataPointsphp, $temp);
}
// generates first set of dataPoints 


?>
<!DOCTYPE HTML>
<html>
<head>
  <script>
    window.onload = function() {
 var datatotal = new Array();

     var datajson = getdatatotal();

     var v1=datajson['rataatas'];
     var v2=datajson['ratabawah'];
     var v3=datajson['ratakanan'];
     var v4=datajson['ratakiri'];

     var updateInterval = <?php echo $updateInterval ?>;
     var arrayjs = <?php echo json_encode($dataPointsphp); ?>;
     console.table(arrayjs);
var dataPoints1 = [];
var dataPoints2 = [];
var dataPoints3 = [];
var dataPoints4 = [];

  for (var j = 0; j < 300; j++) {
    dataPoint1.push({
      x: arrayjs[j][4],
      // x: (Math.random()),
      y: parseFloat(arrayjs[j][0])
    });
    dataPoints2.push({
      x: arrayjs[j][4],
      y: parseFloat(arrayjs[j][1])
    });
      dataPoints3.push({
      x: arrayjs[j][4],
      y: parseFloat(arrayjs[j][2])
    });
        dataPoints4.push({
      x: arrayjs[j][4],
      y: parseFloat(arrayjs[j][3])
    });
    as++;
  }
     var yValue1 = parseInt(v1, 10);
     var yValue2 = parseInt(v2, 10);
     var yValue3 =parseInt(v3, 10);
     var yValue4 = parseInt(v4, 10);
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
        type: "spline",
        name: "Rata-rata Atas",
        xValueType: "dateTime",
        yValueFormatString: "#,### derajat",
        xValueFormatString: "hh:mm:ss TT",
        showInLegend: true,
        legendText: "{name} " + yValue1 + " derajat",
        dataPoints: dataPoints1
      },
      { 
        type: "spline",
        name: "Rata-rata Bawah",
        xValueType: "dateTime",
        yValueFormatString: "#,### derajat",
        xValueFormatString: "hh:mm:ss TT",
        showInLegend: true,
        legendText: "{name} " + yValue2 + " derajat",
        dataPoints: dataPoints2
      },
      { 
        type: "spline",
        name: "Rata-rata Kanan",
        xValueType: "dateTime",
        yValueFormatString: "#,### derajat",
        xValueFormatString: "hh:mm:ss TT",
        showInLegend: true,
        legendText: "{name} " + yValue3 + " derajat",
        dataPoints: dataPoints3
      },
      {       
        type: "spline",
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
  <script src="<?php echo base_url('assets/canva/canvasjs.min.js') ?>" type="text/javascript"></script>
</body>
</html>    