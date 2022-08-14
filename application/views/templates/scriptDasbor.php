<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script>
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';
</script>
<script>
  // Bar Chart Asal KabKot
  <?= "var dataAsalKabKot = [{$asalKabKot['kotmtr']},{$asalKabKot['lobar']},{$asalKabKot['loteng']},{$asalKabKot['lotim']},{$asalKabKot['klu']},{$asalKabKot['ksb']},{$asalKabKot['sumbawa']},{$asalKabKot['bima']},{$asalKabKot['dompu']},{$asalKabKot['kotbima']}];"; ?>
  var barChartAsalKabKot = document.getElementById("barChartAsalKabKot");
  var myBarChart = new Chart(barChartAsalKabKot, {
    type: 'bar',
    data: {
      labels: ["Kota Mataram", "Lombok Barat", "Lombok Tengah", "Lombok Timur", "Lombok Utara", "Sumbawa Barat", "Sumbawa", "Bima", "Dompu", "Kota Bima"],
      datasets: [{
        label: "Jumlah Anggota : ",
        backgroundColor: "#4e73df",
        hoverBackgroundColor: "#2e59d9",
        borderColor: "#4e73df",
        data: dataAsalKabKot,
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 10
          },
          maxBarThickness: 25,
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: 30,
            maxTicksLimit: 10,
            padding: 10,
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + tooltipItem.yLabel;
          }
        }
      },
    }
  });
</script>
<script>
  // Bar Chart Angkatan
  <?= "var dataAngkatan = [{$angkatan['61']},{$angkatan['62']},{$angkatan['63']},{$angkatan['64']}];"; ?>
  var barChartAngkatan = document.getElementById("barChartAngkatan");
  var myBarChart = new Chart(barChartAngkatan, {
    type: 'bar',
    data: {
      labels: ["61", "62", "63", "64"],
      datasets: [{
        label: "Jumlah Anggota : ",
        backgroundColor: "#4e73df",
        hoverBackgroundColor: "#2e59d9",
        borderColor: "#4e73df",
        data: dataAngkatan,
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 6
          },
          maxBarThickness: 25,
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: 30,
            maxTicksLimit: 10,
            padding: 10,
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + tooltipItem.yLabel;
          }
        }
      },

    }
  });
</script>
<script>
  // Pie Chart Jenis Kelamin
  <?= "var datajk = [{$jk['laki']},{$jk['perempuan']}];"; ?>
  var pieChartJenisKelamin = document.getElementById("pieChartJenisKelamin");
  var myPieChart = new Chart(pieChartJenisKelamin, {
    type: 'doughnut',
    data: {
      labels: ["Laki-laki", "Perempuan"],
      datasets: [{
        data: datajk,
        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  })
</script>