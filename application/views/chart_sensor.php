<?php

$updateInterval = 5000; //in millisecond
$initialNumberOfDataPoints = 50;
$x = time() * 1000 - $updateInterval * $initialNumberOfDataPoints;
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
<script>
  window.onload = function() {
    var dataSeries = { type: "line" };
       var datajson = getdatatotal();
  // // adding random value
  // var v1=datajson['rataatas'];
  // var v2=datajson['ratabawah'];
  // var v3=datajson['ratakanan'];
  // var v4=datajson['ratakiri'];
  // var xValue = datajson['waktu'];


  var dataPoints1 = [];
  var dataPoints2 = [];
  var dataPoints3 = [];
  var dataPoints4 = [];
  var updateInterval = <?php echo $updateInterval ?>;
  var arrayjs = <?php echo json_encode($dataPointsphp); ?>;

  var as = 0;
  for (var j = 0; j < arrayjs.length; j++) {
    dataPoints1.push({  
    // x: arrayjs[j][4],
    x: as,
    y: parseFloat(arrayjs[j][0])
  });
    dataPoints2.push({
      x: as,
      y: parseFloat(arrayjs[j][1])
    });
    dataPoints3.push({
     x: as,
     y: parseFloat(arrayjs[j][2])
   });
    dataPoints4.push({
      x: as,
      y: parseFloat(arrayjs[j][3])
    });

    as++;
  }
    var yValue1 = arrayjs[arrayjs.length-1][0];
  var yValue2 = arrayjs[arrayjs.length-1][1];
  var yValue3 = arrayjs[arrayjs.length-1][2];
  var yValue4 =arrayjs[arrayjs.length-1][3];
  var xValue = arrayjs[arrayjs.length-1][4];
     // console.table(arrayjs);

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
     // setInterval(function(){updateChart()}, updateInterval);

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
 function getdatatotal() {
 var datatotal = new Array();
   var request = new XMLHttpRequest();
   request.open('GET', 'ambildatasensor', true);
   request.onload = function () {
    datatotal = JSON.parse(this.response);
  }
  request.send();
  console.table(datatotal);
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
<section class="content">
  graph sensor tracker
  <small></small>
</h1>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="<?php echo base_url('assets/canva/canvasjs.min.js') ?>" type="text/javascript"></script>
</section><!-- /.content -->  

</script>

