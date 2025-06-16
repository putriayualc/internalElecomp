<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
  <div class="container-xl">

    <div class="d-block d-md-flex bg-white gap-5 rounded m-2">
        <div id="chart" class="d-inline"></div>

        <table class="table" style="table-layout: fixed; width: 100%; ">
            <thead>
                <tr>
                <th scope="col" style="width: 25%; border: none;">Masuk</th>
                <th scope="col" style="width: 25%; border: none;">Ijin</th>
                <th scope="col" style="width: 25%; border: none;">Sakit</th>
                <th scope="col" style="width: 25%; border: none;">Bolos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: none;">Mark</td>
                    <td style="border: none;">Mark</td>
                    <td style="border: none;">Otto</td>
                    <td style="border: none;">@mdo</td>
                </tr>
            </tbody>
        </table>
    
    </div>


    <div id="chartLine" class="bg-white m-2"></div>
</div>
</div>





<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

// Apex Templat


        var options = {
  series: [
    <?= $statistik['Masuk']; ?>,
    <?= $statistik['Ijin']; ?>,
    <?= $statistik['Sakit']; ?>,
    <?= $statistik['Bolos']; ?>
  ],
  chart: {
    width: 380,
    type: 'pie',
  },
  labels: ['Masuk', 'Izin', 'Sakit', 'Bolos'],
  responsive: [{
    breakpoint: 480,
    options: {
      chart: { width: 200 },
      legend: { position: 'bottom' }
    }
  }]
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();



// =============
var options = {
          series: [{
          name: 'series1',
          data: [31, 40, 28, 51, 42, 109, 100]
        }, {
          name: 'series2',
          data: [11, 32, 45, 32, 34, 52, 41]
        }],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          type: 'datetime',
          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };

        var chart = new ApexCharts(document.querySelector("#chartLine"), options);
        chart.render();
</script>



<?= $this->endSection('content') ?>
