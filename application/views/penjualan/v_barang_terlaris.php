<section class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Laporan Barang Terlaris</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2 mt-1">
            Tanggal
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
          <div class="col-md-2">
            <button id="btnCetak" class="btn btn-danger">Print <i class="fas fa-print"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(function() {
    $('#btnCetak').on('click', function(e) {
      let datestart = $('[name=TanggalAwal]').val();
      var datestartpisah = datestart.split('/');
      var start = datestartpisah.join('-');
      let dateend = $('[name=TanggalAkhir]').val();
      var dateendpisah = dateend.split('/');
      var end = dateendpisah.join('-');
      window.open("<?php echo base_url() . 'c_penjualan/cetakBarangTerlaris/' ?>" + start + '/' + end);
    })
  });
</script>