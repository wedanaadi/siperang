<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tambah Barang</h3>
      </div>
      <form action="javascript:void(0)" method="POST">
        <div class="card-body">

          <div class="form-group">
            <label for="formKodeBarang">Kode Barang</label>
            <input type="text" name="KodeBarang" id="formKodeBarang" class="form-control" placeholder="Masukan kode barang">
            <small id="KodeBarang" class="error_msg invalid-feedback"></small>
          </div>

          <div class="form-group">
            <label for="formNamaBarang">Nama Barang</label>
            <input type="text" name="NamaBarang" id="formNamaBarang" class="form-control" placeholder="Masukan nama barang">
            <small id="NamaBarang" class="error_msg invalid-feedback"></small>
          </div>

          <div class="form-group">
            <label for="formHargaBeli">Harga Beli</label>
            <input type="text" name="HargaBeli" id="formHargaBeli" class="form-control" placeholder="Masukan harga beli">
            <small id="HargaBeli" class="error_msg invalid-feedback"></small>
          </div>

          <div class="form-group">
            <label for="formHargaJual">Harga Jual</label>
            <input type="text" name="HargaJual" id="formHargaJual" class="form-control" placeholder="Masukan harga jual">
            <small id="HargaJual" class="error_msg invalid-feedback"></small>
          </div>

          <div class="form-group">
            <label for="formQuantity">Quantity</label>
            <input type="text" name="Quantity" id="formQuantity" class="form-control" placeholder="Masukan quantity">
            <small id="Quantity" class="error_msg invalid-feedback"></small>
          </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
          <a href="<?php echo base_url() . 'c_barang/index' ?>" class="btn btn-default"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $('form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?php echo base_url() . 'c_barang/buatBarang' ?>",
      method: "POST",
      dataType: "JSON",
      data: {
        KodeBarang: $('[name=KodeBarang]').val(),
        NamaBarang: $('[name=NamaBarang]').val(),
        HargaBeli: $('[name=HargaBeli]').val(),
        HargaJual: $('[name=HargaJual]').val(),
        Quantity: $('[name=Quantity]').val(),
      },
      success: function(respon) {
        $('.error_msg').html('');
        $('.form-control').removeClass('is-invalid');
        if (respon.is_error) {
          jQuery.each(respon.errors, function(key, value) {
            $('[name=' + key + ']').addClass('is-invalid');
            $('#' + key).fadeIn(0, 300);
            $('#' + key).html(value);
          });
        }
        if (respon.success) {
          Alert.fire({
            type: 'success',
            title: 'Berhasil menambah data.'
          }).then((result) => {
            window.location = "<?php echo base_url() . 'c_barang/index' ?>";
          });
        }
      }
    });
    return false;
  })
</script>