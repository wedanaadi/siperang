<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Laporan Penjualan</h3>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-2 mt-1">
            Tanggal Transaksi
          </div>
          <div class="col-md-2">
            <div class="input-group">
              <input type="text" name="TanggalAwal" class="form-control tanggalset" id="formTAw" placeholder="Tanggal Awal" value="<?php echo date('Y/m/01') ?>">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-1 mt-1 text-center">
            s/d
          </div>
          <div class="col-md-2">
            <div class="input-group">
              <input type="text" name="TanggalAkhir" class="form-control tanggalset" id="formAk" placeholder="Tanggal Akhir" value="<?php echo date('Y/m/30') ?>">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-md-2 mt-1"></div>
          <div class="col-md-2">
            <button id="btnView" class="btn btn-success" style="width: 100%">Tampilkan <i class="fas fa-eye"></i></button>
          </div>
          <div class="col-md-1 mt-1 text-center"></div>
          <div class="col-md-2">
            <button id="btnCetak" class="btn btn-danger" style="width: 100%">Print <i class="fas fa-print"></i></button>
          </div>
        </div>

        <div class="row mt-4">
          <div class="table-responsive">
            <table class="table table-striped table-bordered" id="t_trx">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Kode Trx</th>
                  <th>Nama Barang</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Quantity</th>
                  <th>Untung</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listdata as $trx) : ?>
                  <tr>
                    <td><?php echo $trx->Tanggal_Transaksi ?></td>
                    <td><?php echo $trx->Kode_Transaksi ?></td>
                    <td><?php echo $trx->Nama_Barang ?></td>
                    <td><?php echo $trx->Harga_Beli ?></td>
                    <td><?php echo $trx->Harga_Jual ?></td>
                    <td><?php echo $trx->Quantity ?></td>
                    <td><?php echo $trx->Untung ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    var tabel = $('#t_trx').DataTable({
      columnDefs: [{
        targets: [3, 4, 6],
        render: $.fn.dataTable.render.number('.', ',', '', 'Rp ')
      }],
      footerCallback: function(row, data, start, end, display) {
        var api = this.api();
        var hitung = api.column(4).data().reduce(function(a, b) {
          return parseInt(a) + parseInt(b);
        }, 0);
        var untung = api.column(6).data().reduce(function(a, b) {
          return parseInt(a) + parseInt(b);
        }, 0);
        var quantity = api.column(5).data().reduce(function(a, b) {
          return parseInt(a) + parseInt(b);
        }, 0);
        // total = hitung;
        var numFormat = $.fn.dataTable.render.number('.', ',', '', 'Rp ').display;

        $(api.column(0).footer()).html("TOTAL").addClass('text-center');
        $(api.column(4).footer()).html(numFormat(hitung));
        $(api.column(5).footer()).html(quantity);
        $(api.column(6).footer()).html(numFormat(untung));
      }
    });

    $('#btnView').on('click', function(e) {
      let datestart = $('[name=TanggalAwal]').val();
      let dateend = $('[name=TanggalAkhir]').val();
      tabel.clear().draw();
      $.ajax({
        url: "<?php echo base_url() . 'c_penjualan/getLaporan' ?>",
        method: "POST",
        dataType: "JSON",
        data: {
          tanggalawal: datestart,
          tanggalakhir: dateend
        },
        success: function(respon) {
          console.log(respon);

          if (respon.length > 0) {
            for (let index = 0; index < respon.length; index++) {
              tabel.row.add([
                respon[index].Tanggal_Transaksi,
                respon[index].Kode_Transaksi,
                respon[index].Nama_Barang,
                respon[index].Harga_Beli,
                respon[index].Harga_Jual,
                respon[index].Quantity,
                respon[index].Untung,
              ]).draw();
            }
          }
        }
      });
    });

    $('#btnCetak').on('click', function(e) {
      let datestart = $('[name=TanggalAwal]').val();
      var datestartpisah = datestart.split('/');
      var start = datestartpisah.join('-');
      let dateend = $('[name=TanggalAkhir]').val();
      var dateendpisah = dateend.split('/');
      var end = dateendpisah.join('-');
      window.open("<?php echo base_url() . 'c_penjualan/cetakLaporan/' ?>" + start + '/' + end);
    })

  });
</script>