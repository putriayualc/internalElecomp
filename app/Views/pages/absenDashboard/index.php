<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
  <div class="container-xl">

    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Absen Dashboard</h1>
        </div>
    </div>

    <!-- Ini yang disembunyikan -->
    <div id="btnStatistik" style="display: block;">
        <table class="table table-hover">
          <thead>
            <tr class="text-center">
              <th scope="col" style="width: 10%;">#</th>
              <th scope="col" style="width: 45%;">Nama</th>
              <th scope="col" style="width: 45%;">Data Grafik</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1 ?>
            <?php foreach ($user as $item):?>
                <tr class="text-center">
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $item['username'] ?></td>
                    <td>
                        <button class="btn btn-info" onclick="statistik(<?= $item['id_user'] ?>)">Statistik</button>
                    </td>
                </tr>
            <?php endforeach ?>
          </tbody>
        </table>
    </div>






    <!-- Ini yang ditampilkan saat klik Statistik -->
    <div id="dataGrapik" style="display: none;">
      <button type="button" onclick="closeStatistik()" class="btn btn-danger">Close</button>
        <div class="row">
          <select id="filter-bulan">
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agu</option>
            <option value="9">Sep</option>
            <option value="10">Okt</option>
            <option value="11">Nov</option>
            <option value="12">Des</option>
          </select>
          <input type="number" id="filter-tahun" value="2025" min="2000" max="2100" class="form-control">

          <!-- Start col -->
          <div class="col-lg-7 connectedSortable">
            <div class="card mb-4">
                <div class="card-header">
                    <!-- tombol status -->
                    <button class="btn btn-success" onclick="gantiStatus('Masuk')">Masuk</button>
                    <button class="btn btn-warning" onclick="gantiStatus('Ijin')">Ijin</button>
                    <button class="btn btn-info" onclick="gantiStatus('Sakit')">Sakit</button>
                    <button class="btn btn-danger" onclick="gantiStatus('Bolos')">Bolos</button>
                </div>
                <div class="card-body">
                    <div id="revenue-chart"></div>
                </div>
            </div> <!-- /.card -->
          </div> <!-- /.Start col -->
                    
        </div>
    </div>

  </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function statistik(){
    document.getElementById('btnStatistik').style.display = 'none';
    document.getElementById('dataGrapik').style.display = 'block';
}
function closeStatistik() {
    document.getElementById('dataGrapik').style.display = 'none';
    document.getElementById('btnStatistik').style.display = 'block';
}




let selectedUserId = null;
let selectedStatus = "Masuk"; // default

function statistik(userId) {
    selectedUserId = userId;
    document.getElementById('btnStatistik').style.display = 'none';
    document.getElementById('dataGrapik').style.display = 'block';

    const bulan = document.getElementById("filter-bulan").value;
    const tahun = document.getElementById("filter-tahun").value;
    selectedStatus = "Masuk"; // Reset default
    loadAbsenChart(bulan, tahun, selectedUserId, selectedStatus);
}

function closeStatistik() {
    document.getElementById('dataGrapik').style.display = 'none';
    document.getElementById('btnStatistik').style.display = 'block';
    selectedUserId = null;
}




function gantiStatus(status) {
    selectedStatus = status;
    const bulan = document.getElementById("filter-bulan").value;
    const tahun = document.getElementById("filter-tahun").value;
    loadAbsenChart(bulan, tahun, selectedUserId, selectedStatus);
}

document.getElementById("filter-bulan").addEventListener("change", function () {
    const bulan = this.value;
    const tahun = document.getElementById("filter-tahun").value;
    loadAbsenChart(bulan, tahun, selectedUserId, selectedStatus);
});

document.getElementById("filter-tahun").addEventListener("change", function () {
    const bulan = document.getElementById("filter-bulan").value;
    const tahun = this.value;
    loadAbsenChart(bulan, tahun, selectedUserId, selectedStatus);
});




let chartInstance = null;

function loadAbsenChart(bulan, tahun, userId, status) {
    fetch(`/absenDashboard/grafikMingguan?bulan=${bulan}&tahun=${tahun}&user=${userId}&status=${status}`)
        .then(res => res.json())
        .then(data => {
            const minggu = Object.keys(data);
            const nilai = minggu.map(m => data[m]);

            const options = {
                series: [{ name: status, data: nilai }],
                chart: { height: 300, type: "area" },
                xaxis: { categories: minggu },
                colors: ["#0d6efd"],
                dataLabels: { enabled: true },
                stroke: { curve: "smooth" },
            };

            if (chartInstance) {
                chartInstance.destroy();
            }
            chartInstance = new ApexCharts(document.querySelector("#revenue-chart"), options);
            chartInstance.render();
        });
}

</script>

<!-- 
<script>
const sales_chart_options = {
        series: [{
            name: "Binaan",
            data: [2, 4, 0, 1, 3, 2, 4],
        }, ],
        chart: {
            height: 300,
            type: "area",
            toolbar: {
                show: false,
            },
        },
        legend: {
            show: false,
        },
        colors: ["#0d6efd", "#20c997"],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "straight",
        },
        markers: {
        size: 5, // Ukuran bulatan
        colors: ["#0d6efd"], // Warna isi bulatan
        strokeColors: "#ffffff", // Warna pinggir bulatan
        strokeWidth: 2, // Tebal pinggir
        },
        xaxis: {
            type: "datetime",
            categories: [
                "2023-01-01",
                "2023-02-01",
                "2023-03-01",
                "2023-04-01",
                "2023-05-01",
                "2023-06-01",
                "2023-07-01",
            ],
        },
        tooltip: {
            x: {
                format: "MMMM yyyy",
            },
        },
    };

    const sales_chart = new ApexCharts(
        document.querySelector("#revenue-chart"),
        sales_chart_options,
    );
    sales_chart.render();
</script> -->


<?= $this->endSection('content') ?>
