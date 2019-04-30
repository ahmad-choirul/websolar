    <html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
      <!-- <script src='<?php echo base_url('assets/js/plotly.min.js') ?>'></script> -->
      <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->

      <script src='<?php echo base_url('assets/js/eon.js') ?>'></script>

      <link type="text/css" rel="stylesheet" href='<?php echo base_url('assets/js/eon.css') ?>'/>
      <div id="chart"></div>
      <script>
        eon.chart({
    channel: "c3-spline", // the pubnub channel for real time data
    generate: {        // c3 chart object
      bindto: '#chart'
    }
  });
</script>
</head>
<?php 
$this->load->model('Madd');
?>
<body>
 <!-- <div class="navbar"><span>Rata Atas</span></div> -->
 <!-- <div class="wrapper"> -->
  <!-- <div id="chart"></div> -->
  <script>
    eon.chart({
      channel: "c3-spline",
      generate: {
        bindto: '#chart',
        data: {
          labels: true
        }
      }
    });
  </script>
  <script >
var datatotal = new Array();
  function getdatatotal() {

   var request = new XMLHttpRequest();
   request.open('GET', 'ambildataratatotal', true);
   request.onload = function () {
    datatotal = JSON.parse(this.response);
    console.log(datatotal);
  }
  request.send();
  return datatotal;
}
var pubnub = PUBNUB.init({
  publish_key: 'demo',
  subscribe_key: 'demo'
});
setInterval(function(){
  var data = getdatatotal();
// var data = getData();
pubnub.publish({
  channel: 'c3-spline',
  message: {
    eon: {
      'Rata atas': data['rataatas'],
      'Rata Bawah': data['ratabawah'],
      'Rata Kiri': data['ratakiri'],
      'Rata Kanan': data['ratakanan']
    }
  }
});
}, 1000);
</script>
<!-- </div> -->
</body>
</html>