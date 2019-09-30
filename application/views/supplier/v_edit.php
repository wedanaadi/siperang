<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Ubah Supplier</h3>
      </div>
      <form action="javascript:void(0)" method="POST">
        <div class="card-body">
        <input type="hidden" name="id" value="<?php echo $dataUbah->Kode_Supplier ?>">
          <div class="form-group">
            <label for="formNamaSupplier">Nama Supplier</label>
            <input type="text" name="NamaSupplier" id="formNamaSupplier" class="form-control" placeholder="Masukan nama supplier" value="<?php echo $dataUbah->Nama_Supplier ?>">
            <small id="NamaSupplier" class="error_msg invalid-feedback"></small>
          </div>

          <div class="form-group">
            <label for="formAlamatSupplier">Alamat</label>
            <textarea name="AlamatSupplier" id="formAlamatSupplier" cols="10" rows="5" class="form-control" placeholder="Masukan alamat supplier"><?php echo $dataUbah->Alamat_Supplier ?></textarea>
            <small id="AlamatSupplier" class="error_msg invalid-feedback"></small>
          </div>

          <div class="form-group">
            <label for="formNoTelp">Telepon Supplier</label>
            <input type="text" name="NoTelp" id="formNoTelp" class="form-control" placeholder="Masukan nomor telepon supplier" value="<?php echo $dataUbah->No_Tlp ?>">
            <small id="NoTelp" class="error_msg invalid-feedback"></small>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
          <a href="<?php echo base_url() . 'c_supplier/index' ?>" class="btn btn-default"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $('form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?php echo base_url() . 'c_supplier/ubahSupplier/' ?>" + $('[name=id]').val(),
      method: "POST",
      dataType: "JSON",
      data: {
        NamaSupplier: $('[name=NamaSupplier]').val(),
        AlamatSupplier: $('[name=AlamatSupplier]').val(),
        NoTelp: $('[name=NoTelp]').val(),
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
            title: 'Berhasil mengubah data.'
          }).then((result) => {
            window.location = "<?php echo base_url() . 'c_supplier/index' ?>";
          });
        }
      }
    });
    return false;
  })
</script>