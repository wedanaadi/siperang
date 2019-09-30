<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tambah Bagian Akses</h3>
      </div>
      <form action="javascript:void(0)" method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="formNamaBagian">Nama Bagian</label>
            <input type="text" name="NamaBagian" id="formNamaBagian" class="form-control" placeholder="Masukan nama bagian akses">
            <small id="NamaBagian" class="error_msg invalid-feedback"></small>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
          <a href="<?php echo base_url() . 'c_auth/listBagian' ?>" class="btn btn-default"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $('form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?php echo base_url() . 'c_auth/buatBagian' ?>",
      method: "POST",
      dataType: "JSON",
      data: {
        NamaBagian: $('[name=NamaBagian]').val()
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
            window.location = "<?php echo base_url() . 'c_auth/listBagian' ?>";
          });
        }
      }
    });
    return false;
  })
</script>