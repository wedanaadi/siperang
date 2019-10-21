<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Transaksi Penjualan</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_penjualan/tambahTransaksi' ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
        </div>
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
            <table id="t_trx" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Kode Transaksi</th>
                  <th>Tanggal Transaksi</th>
                  <th>Total</th>
                  <th style="width: 8%">Status</th>
                  <th>DP</th>
                  <th>Tanggal Jatuh Tempo</th>
                  <th>Tanggal Pelunasan</th>
                  <th style="width: 150px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listTransaksi as $trx) : ?>
                  <tr>
                    <td><?php echo $trx->Kode_Transaksi ?></td>
                    <td><?php echo $trx->Tanggal_Transaksi ?></td>
                    <td><?php echo  'Rp. ' . number_format($trx->Total, 0, '.', '.') ?></td>
                    <td class="text-center"><?php echo $trx->StatusTransaksi == '1' ? '<div class="badge badge-success">LUNAS</div>' : '<div class="badge badge-warning">BELUM LUNAS</div>' ?></td>
                    <td><?php echo  'Rp. ' . number_format($trx->DP, 0, '.', '.') ?></td>
                    <td><?php echo $trx->StatusTransaksi == '1' ? '-' : $trx->Tanggal_JatuhTempo ?></td>
                    <td><?php echo $trx->StatusTransaksi == '2' ? '-' : $trx->Tanggal_Pelunasan ?></td>
                    <td align="center">
                      <a href="<?php echo base_url() . 'c_penjualan/editTrx/' . $trx->Kode_Transaksi ?>" class="btn btn-warning btn-sm" title="Ubah Trx"><i class="fas fa-pencil-alt"></i></a>
                      <button id-trx="<?php echo $trx->Kode_Transaksi ?>" class="btn btn-secondary btn-sm btnDetil" title="Detil Trx"><i class="fas fa-eye"></i></button>
                      <button id-print="<?php echo $trx->Kode_Transaksi ?>" class="btn btn-danger btn-sm btnPrint" title="Print Trx"><i class="fas fa-print"></i></button>
                      <?php if ($trx->StatusTransaksi == '2') : ?>
                        <button id-trx="<?php echo $trx->Kode_Transaksi ?>" id="btnLunas" class="btn btn-success btn-sm" title="Lunasi Pembayaran" id-sisa="<?php echo $trx->Sisa ?>"><i class="fas fa-money-bill-wave"></i></button>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Penulasan Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formBayar" method="post">
        <div class="modal-body">
          <div class="row">
            <label for="formSisa" class="control-label">Sisa Pembayaran</label>
            <input type="text" name="Sisa" id="formSisa" class="form-control" placeholder="Masukan Sisa Pembayaran">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">
            <i class="fas fa-money-check-alt"></i> Bayar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDetil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detil Trx</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="t_detil">
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th>Subtotal</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  $(function() {
    var tabel = $('#t_trx').DataTable({
      "sScollX": "100%",
      columnDefs: [{
        targets: [2, 4],
        render: $.fn.dataTable.render.number('.', ',', '', 'Rp ')
      }]
    });
    var detil = $('#t_detil').DataTable({
      columnDefs: [{
        targets: [2, 4],
        render: $.fn.dataTable.render.number('.', ',', '', 'Rp ')
      }],
    });
    let kode_trx = null;

    $('#btnView').on('click', function(e) {
      let datestart = $('[name=TanggalAwal]').val();
      let dateend = $('[name=TanggalAkhir]').val();
      tabel.clear().draw();
      $.ajax({
        url: "<?php echo base_url() . 'c_penjualan/getTransaksi' ?>",
        method: "POST",
        dataType: "JSON",
        data: {
          tanggalawal: datestart,
          tanggalakhir: dateend
        },
        success: function(respon) {
          if (respon.length > 0) {
            for (let index = 0; index < respon.length; index++) {
              let btnAct = '<button class="btn btn-warning btn-sm" title="Ubah Trx"><i class="fas fa-pencil-alt"></i></button>' +
                ' <button id-trx="' + respon[index].Kode_Transaksi + '" class="btn btn-secondary btn-sm btnDetil" title="Detil Trx"><i class="fas fa-eye"></i></button>';
              if (respon[index].StatusTransaksi == '2') {
                btnAct += ' <button id-trx="' + respon[index].Kode_Transaksi + '" id="btnLunas" class="btn btn-danger btn-sm" title="Lunasi Pembayaran" id-sisa="' + respon[index].Sisa + '"><i class="fas fa-money-bill-wave"></i></button>';
              };
              tabel.row.add([
                respon[index].Kode_Transaksi,
                respon[index].Tanggal_Transaksi,
                respon[index].Total,
                respon[index].StatusTransaksi == '1' ? '<div class="badge badge-success">LUNAS</div>' : '<div class="badge badge-warning">BELUM LUNAS</div>',
                respon[index].DP,
                respon[index].Tanggal_JatuhTempo,
                respon[index].StatusTransaksi == '1' ? respon[index].Tanggal_Pelunasan : '-',
                btnAct
              ]).draw();
            }
          }
        }
      });
    });

    $(document).on('click', '#btnLunas', function(e) {
      let sisa = $(this).attr('id-sisa');
      kode_trx = $(this).attr('id-trx');
      $('#formBayar')[0].reset();
      $('[name=Sisa]').val(sisa);
      $('#modalBayar').modal('show');
    });

    $(document).on('click', '.btnDetil', function(e) {
      kode_trx = $(this).attr('id-trx');
      $.ajax({
        url: "<?php echo base_url() . 'c_penjualan/detil/' ?>" + kode_trx,
        method: "POST",
        dataType: "JSON",
        success: function(respon) {
          detil.clear().draw();
          for (let index = 0; index < respon.length; index++) {
            console.log(respon[index]);
            detil.row.add([
              respon[index].Kode_Barang,
              respon[index].Nama_Barang,
              respon[index].Harga_Barang,
              respon[index].Quantity,
              respon[index].Subtotal,
            ]).draw();
          }
          $('#modalDetil').modal('show');
        }
      });
    });

    $(document).on('click', '.btnPrint', function(e) {
      let kode_print = $(this).attr('id-print');
      window.open("<?php echo base_url('c_penjualan/printTrx/') ?>" + kode_print);
    });

    $('#btnCetak').on('click', function(e) {
      let datestart = $('[name=TanggalAwal]').val();
      var datestartpisah = datestart.split('/');
      var start = datestartpisah.join('-');
      let dateend = $('[name=TanggalAkhir]').val();
      var dateendpisah = dateend.split('/');
      var end = dateendpisah.join('-');
      window.open("<?php echo base_url() . 'c_penjualan/cetakListTrx/' ?>" + start + '/' + end);
    })

    $('#modalBayar').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?php echo base_url() . 'c_penjualan/PelunasanTrx/' ?>" + kode_trx,
        method: "POST",
        dataType: "JSON",
        success: function(respon) {
          $('#modalBayar').modal('hide');
          Alert.fire({
            type: 'success',
            title: 'Transaksi dilunasi.'
          }).then((result) => {
            window.location = "<?php echo base_url() . 'c_penjualan/index' ?>";
          });
        }
      });
      return false;
    })
  })
</script>