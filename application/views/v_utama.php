<div class="content">
  <div class="content-fluid">
    <?php if ($this->session->userdata('bagian') == '1') : ?>
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3><?php echo $totalBarang->total ?></h3>

              <p>Total Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $orderBarang->total ?></h3>

              <p>Order Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Grafik Jumlah Barang</h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <div id="chart_barang" style="height: 200px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Grafik Order Barang</h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <div id="chart_order" style="height: 200px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($this->session->userdata('bagian') == '3') : ?>
      <div class="row">
        <div class="col-lg-4 col-12">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $requestBarang->total ?></h3>

              <p>Request Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $barangMasuk->total ?></h3>
              <p>Barang Masuk</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $returnBarang->total ?></h3>
              <p>Return Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card <?php echo $stokMin['jumlah'] > 0 ? 'card-danger' : 'card-success collapsed-card' ?>">
            <div class="card-header">
              <h3 class="card-title">Barang Stok Minimum dibawah 10 (<?php echo $stokMin['jumlah'] ?>)</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fas fa-<?php echo $stokMin['jumlah'] > 0 ? 'minus' : 'plus' ?>"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="t_min" class="table table-striped table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($stokMin['data'] as $v) : ?>
                      <tr>
                        <td><?php echo $v->Kode_Barang ?></td>
                        <td><?php echo $v->Nama_Barang ?></td>
                        <td style="text-align: center; width: 10%; background-color: #F3C2BC"><?php echo $v->Quantity ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Grafik Request Barang</h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <div id="chart_request" style="height: 200px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Grafik Return Barang</h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <div id="chart_return" style="height: 200px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Grafik Barang Masuk</h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <div id="chart_barangmasuk" style="height: 200px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($this->session->userdata('bagian') == '4') : ?>
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo 'Rp. ' . number_format($totalPenjualan->total, 0, '.', '.') ?></h3>

              <p>Total Transaksi Penjualan</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo 'Rp. ' . number_format($totalBarangMasuk->total, 0, '.', '.') ?></h3>

              <p>Total Transaksi Pembelian</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Grafik Penjualan Pembelian</h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <div id="chart_pb" style="height: 200px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Grafik 5 Barang Terlaris Bulan ini</h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <div id="chart_bt" style="height: 200px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
  $(function() {
    var akses = "<?php echo $this->session->userdata('bagian') ?>";

    if (akses == '1') {
      var dataBarang = JSON.parse('<?php echo isset($chart1['chartData']) ? $chart1['chartData'] : "{}" ?>');

      Highcharts.chart('chart_barang', {
        chart: {
          type: 'column'
        },
        title: {
          text: null
        },
        // subtitle: {
        //     text: 'Source: WorldClimate.com'
        // },
        xAxis: {
          categories: [' '],
          title: {
            text: null
          }
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Unit'
          }
        },
        tooltip: {
          useHTML: true,
          formatter: function() {
            return '<h4><span class="label label-success">' + this.series.name + '</span></h4><br>' +
              this.y + ' Unit';
          }
        },
        plotOptions: {
          column: {
            pointPadding: 0.4,
            borderWidth: 0
          }
        },
        series: dataBarang,
      });

      var dataOrder = JSON.parse('<?php echo isset($chart2['chartData']) ? $chart2['chartData'] : "{}" ?>');

      Highcharts.chart('chart_order', {
        chart: {
          type: 'column'
        },
        title: {
          text: null
        },
        // subtitle: {
        //     text: 'Source: WorldClimate.com'
        // },
        xAxis: {
          categories: [' '],
          title: {
            text: null
          }
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Unit'
          }
        },
        tooltip: {
          useHTML: true,
          formatter: function() {
            return '<h4><span class="label label-success">' + this.series.name + '</span></h4><br>' +
              this.y + ' Unit';
          }
        },
        plotOptions: {
          column: {
            pointPadding: 0.4,
            borderWidth: 0
          }
        },
        series: dataOrder,
      });
    }

    if (akses == '3') {
      var dataRequest = JSON.parse('<?php echo isset($chart3['chartData']) ? $chart3['chartData'] : "{}" ?>');

      Highcharts.chart('chart_request', {
        chart: {
          type: 'column'
        },
        title: {
          text: null
        },
        // subtitle: {
        //     text: 'Source: WorldClimate.com'
        // },
        xAxis: {
          categories: [' '],
          title: {
            text: null
          }
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Unit'
          }
        },
        tooltip: {
          useHTML: true,
          formatter: function() {
            return '<h4><span class="label label-success">' + this.series.name + '</span></h4><br>' +
              this.y + ' Unit';
          }
        },
        plotOptions: {
          column: {
            pointPadding: 0.4,
            borderWidth: 0
          }
        },
        series: dataRequest,
      });

      var dataBarangMasuk = JSON.parse('<?php echo isset($chart5['chartData']) ? $chart5['chartData'] : "{}" ?>');

      Highcharts.chart('chart_barangmasuk', {
        chart: {
          type: 'column'
        },
        title: {
          text: null
        },
        // subtitle: {
        //     text: 'Source: WorldClimate.com'
        // },
        xAxis: {
          categories: [' '],
          title: {
            text: null
          }
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Unit'
          }
        },
        tooltip: {
          useHTML: true,
          formatter: function() {
            return '<h4><span class="label label-success">' + this.series.name + '</span></h4><br>' +
              this.y + ' Unit';
          }
        },
        plotOptions: {
          column: {
            pointPadding: 0.4,
            borderWidth: 0
          }
        },
        series: dataBarangMasuk,
      });

      var dataReturn = JSON.parse('<?php echo isset($chart4['chartData']) ? $chart4['chartData'] : "{}" ?>');

      Highcharts.chart('chart_return', {
        chart: {
          type: 'column'
        },
        title: {
          text: null
        },
        // subtitle: {
        //     text: 'Source: WorldClimate.com'
        // },
        xAxis: {
          categories: [' '],
          title: {
            text: null
          }
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Unit'
          }
        },
        tooltip: {
          useHTML: true,
          formatter: function() {
            return '<h4><span class="label label-success">' + this.series.name + '</span></h4><br>' +
              this.y + ' Unit';
          }
        },
        plotOptions: {
          column: {
            pointPadding: 0.4,
            borderWidth: 0
          }
        },
        series: dataReturn,
      });
    }

    if (akses == '4') {
      var dataPB = JSON.parse('<?php echo isset($chart6['chartData']) ? $chart6['chartData'] : "{}" ?>');
      console.log(dataPB);

      Highcharts.chart('chart_pb', {
        chart: {
          type: 'bar'
        },
        title: {
          text: ''
        },
        subtitle: {
          text: ''
        },
        xAxis: {
          categories: [dataPB[0].name, dataPB[1].name],
          title: {
            text: null
          }
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Indonesian Rupiah (IDR)',
            align: 'high'
          },
          labels: {
            overflow: 'justify'
          }
        },
        tooltip: {
          valueSuffix: ' Rupiah'
        },
        plotOptions: {
          bar: {
            dataLabels: {
              enabled: true
            }
          }
        },
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'top',
          x: -40,
          y: 80,
          floating: true,
          borderWidth: 1,
          backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
          shadow: true
        },
        credits: {
          enabled: false
        },
        series: [{
          showInLegend: false,
          data: [{
              y: dataPB[0].data,
              color: '#8CFF8C'
            },
            {
              y: dataPB[1].data,
              color: '#70B8FF'
            }
          ]
          // data: [100000000,150000000]
        }]
      });
    }

    $('#t_min').DataTable({
      processing: true,
      searching: false,
      paging: false,
      language: {
        emptyTable: "No data available in table"
      }
    });

    var dataBarangTerlaris = JSON.parse('<?php echo isset($chart7['chartData']) ? $chart7['chartData'] : "{}" ?>');
    console.log(dataBarangTerlaris);

    Highcharts.chart('chart_bt', {
      chart: {
        type: 'column'
      },
      title: {
        text: null
      },
      // subtitle: {
      //     text: 'Source: WorldClimate.com'
      // },
      xAxis: {
        categories: [' '],
        title: {
          text: null
        }
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Unit'
        }
      },
      tooltip: {
        useHTML: true,
        formatter: function() {
          return '<h4><span class="label label-success">' + this.series.name + '</span></h4><br>' +
            this.y + ' Unit';
        }
      },
      plotOptions: {
        column: {
          pointPadding: 0.4,
          borderWidth: 0
        }
      },
      series: dataBarangTerlaris,
    });


  });
</script>