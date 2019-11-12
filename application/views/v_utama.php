<div class="content">
  <div class="content-fluid">
    <?php if ($this->session->userdata('bagian') == '1') : ?>
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3><?php echo $totalBarang->total . ' Barang' ?></h3>

              <p>Jumlah Barang yang tercatat dalam sistem</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $orderBarang->total . ' Order' ?></h3>

              <p>Jumlah Order Barang ( Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?> )</p>
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
              <h3 class="card-title">Grafik Order Barang Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?></h3>
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
              <h3><?php echo $requestBarang->total ?> Request Barang</h3>

              <p>( Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?> )</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $barangMasuk->total ?> Barang Masuk</h3>
              <p>( Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?> )</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $returnBarang->total ?> Return Barang</h3>
              <p>( Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?> )</p>
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
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Grafik Request Barang Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?></h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <div id="chart_request" style="height: 200px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Grafik Return Barang Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?></h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <div id="chart_return" style="height: 200px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Grafik Barang Masuk Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?></h3>
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

              <p>Total Transaksi Penjualan</p> ( <small>Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?></small> )
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
              <p>Total Transaksi Pembelian</p> ( <small>Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?></small> )
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
              <h3 class="card-title">Grafik Penjualan Pembelian Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?></h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <div id="chart_pb" style="height: 200px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Grafik 5 Barang Terlaris Periode <?php echo $tanggal1 . ' s/d ' . $tanggal2 ?></h3>
          </div>
          <div class="card-body">
            <div class="chart">
              <div id="chart_bt" style="height: 200px; margin: 0 auto"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    var akses = "<?php echo $this->session->userdata('bagian') ?>";

    if (akses == '1') {
      var dataBarang = JSON.parse('<?php echo isset($chart1['chartData']) ? $chart1['chartData'] : "{}" ?>');

      var dataOrder = JSON.parse('<?php echo isset($chart2['chartData']) ? $chart2['chartData'] : "{}" ?>');

      Highcharts.chart('chart_order', {
        title: {
          text: ''
        },
        yAxis: {
          title: {
            text: 'Total Order'
          }
        },
        xAxis: {
          categories: dataOrder.cat,
          title: {
            text: 'Tanggal'
          }
        },
        tooltip: {
          useHTML: true,
          formatter: function() {
            var serieI = this.series.index;
            var index = dataOrder.cat.indexOf(this.x);
            var tool = dataOrder.tool[index];
            return 'Tgl ' + tool + '<br>' +
              'Order Barang : ' + this.y;
          }
        },
        series: [{
          name: 'Jumlah Order Barang (Group berdasarkan Tanggal)',
          data: dataOrder.jumlah
        }],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }
      });
    }

    if (akses == '3') {
      var dataRequest = JSON.parse('<?php echo isset($chart3['chartData']) ? $chart3['chartData'] : "{}" ?>');

      Highcharts.chart('chart_request', {
        title: {
          text: ''
        },
        yAxis: {
          title: {
            text: 'Jumlah'
          }
        },
        xAxis: {
          categories: dataRequest.cat,
          title: {
            text: 'Tanggal'
          }
        },
        tooltip: {
          useHTML: true,
          formatter: function() {
            var serieI = this.series.index;
            var index = dataRequest.cat.indexOf(this.x);
            var tool = dataRequest.tool[index];
            return 'Tgl ' + tool + '<br>' +
              'Request Barang : ' + this.y;
          }
        },
        series: [{
          name: 'Jumlah Order Barang (Group berdasarkan Tanggal)',
          data: dataRequest.jumlah
        }],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }
      });

      var dataBarangMasuk = JSON.parse('<?php echo isset($chart5['chartData']) ? $chart5['chartData'] : "{}" ?>');

      Highcharts.chart('chart_barangmasuk', {
        title: {
          text: ''
        },
        yAxis: {
          title: {
            text: 'Jumlah'
          }
        },
        xAxis: {
          categories: dataBarangMasuk.cat,
          title: {
            text: 'Tanggal'
          }
        },
        tooltip: {
          useHTML: true,
          formatter: function() {
            var serieI = this.series.index;
            var index = dataBarangMasuk.cat.indexOf(this.x);
            var tool = dataBarangMasuk.tool[index];
            return 'Tgl ' + tool + '<br>' +
              'Barang Masuk : ' + this.y;
          }
        },
        series: [{
          name: 'Jumlah Order Barang (Group berdasarkan Tanggal)',
          data: dataBarangMasuk.jumlah
        }],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }
      });

      var dataReturn = JSON.parse('<?php echo isset($chart4['chartData']) ? $chart4['chartData'] : "{}" ?>');
      console.log(dataReturn);

      Highcharts.chart('chart_return', {
        title: {
          text: ''
        },
        yAxis: {
          title: {
            text: 'Jumlah'
          }
        },
        xAxis: {
          categories: dataReturn.cat,
          title: {
            text: 'Tanggal'
          }
        },
        tooltip: {
          useHTML: true,
          formatter: function() {
            var serieI = this.series.index;
            var index = dataReturn.cat.indexOf(this.x);
            var tool = dataReturn.tool[index];
            return 'Tgl ' + tool + '<br>' +
              'Barang Masuk : ' + this.y;
          }
        },
        series: [{
          name: 'Jumlah Order Barang (Group berdasarkan Tanggal)',
          data: dataReturn.jumlah
        }],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }
      });

    }

    if (akses == '4') {

      function IDRFormatter(angka, prefix) {
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
          split = number_string.split(','),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
      }

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
            overflow: 'justify',
            // formatter: function() {
            //   return IDRFormatter(this.value, 'Rp. ');
            // }
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