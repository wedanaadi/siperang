<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Laporan Stock Opname</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3 mt-1">
            Tanggal Stock Opname
          </div>
          <div class="col-md-2">
            <div class="input-group">
              <input type="text" name="Tanggal" class="form-control tanggalset" id="formTAw" placeholder="Tanggal Awal" value="<?php echo date('Y/m/d') ?>">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <button id="btnCetak" class="btn btn-danger" style="width: 100%">Cetak <i class="fas fa-print"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    $(document).on('click', '#btnCetak', function() {
      let datestart = $('[name=Tanggal]').val();
      var datestartpisah = datestart.split('/');
      var tanggalsfix = datestartpisah.join('-');
      window.open("<?php echo base_url() . 'c_stockopname/cetakLaporan/' ?>" + tanggalsfix);
    });
  });
</script>