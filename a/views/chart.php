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
    generate: {           // c3 chart object
      bindto: '#chart'
    }
  });
</script>
</head>
<?php 
$this->load->model('Madd');

?>
<body>
 <div class="navbar"><span>Rata Atas</span></div>
 <div class="wrapper">

  <div id="chart"></div>
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
     var data1 = 0;

    function getDataatas() {

     var request = new XMLHttpRequest();
     request.open('GET', 'ambildatarataatas', true);
     request.onload = function () {
      data1 = JSON.parse(this.response);
      console.log(data1);
    }
    request.send();
    return data1;
  }

   var data2 = 0;

  function getDatabawah() {

   var request = new XMLHttpRequest();
   request.open('GET', 'ambildataratabawah', true);
   request.onload = function () {
    data2 = JSON.parse(this.response);
    console.log(data2);
  }
  request.send();
  return data2;
}

var data3 = 0;

  function getDatakiri() {

   var request = new XMLHttpRequest();
   request.open('GET', 'ambildataratakanan', true);
   request.onload = function () {
    data3 = JSON.parse(this.response);
    console.log(data3);
  }
  request.send();
  return data3;
}

var data4 = 0;

  function getDatakanan() {

   var request = new XMLHttpRequest();
   request.open('GET', 'ambildataratakiri', true);
   request.onload = function () {
    data4 = JSON.parse(this.response);
    console.log(data4);
  }
  request.send();
  return data4;
}

var pubnub = PUBNUB.init({
  publish_key: 'demo',
  subscribe_key: 'demo'
});

setInterval(function(){
// var data = getData();
pubnub.publish({
  channel: 'c3-spline',
  message: {
    eon: {
      'Rata atas': getDataatas(),
      'Rata Bawah': getDatabawah(),
      'Rata Kiri': getDatakiri(),
      'Rata Kanan': getDatakanan()
    }
  }
});

}, 1000);
</script>
</div>


</body>
</html>