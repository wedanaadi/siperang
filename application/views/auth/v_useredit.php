<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tambah User</h3>
      </div>
      <form action="">
        <div class="card-body">
          <input type="hidden" name="id" value="<?php echo $dataUbah->Kode_User ?>">
          <div class="form-group">
            <label for="formNamaUser">Nama User</label>
            <input type="text" name="NamaUser" id="formNamaUser" class="form-control" placeholder="Masukan nama user" value="<?php echo $dataUbah->Nama_User ?>">
            <small id="NamaUser" class="error_msg invalid-feedback"></small>
          </div>
          <div class="form-group">
            <label for="formUsername">Username</label>
            <input type="text" name="Username" id="formUsername" class="form-control" placeholder="Masukan nama username" value="<?php echo $dataUbah->Username ?>">
            <small id="Username" class="error_msg invalid-feedback"></small>
          </div>
          <div class="form-group">
            <label for="formPassword">Password</label>
            <input type="password" name="Password" id="formPassword" class="form-control" placeholder="Masukan ulang passoword">
            <small id="Password" class="error_msg invalid-feedback"></small>
          </div>
          <div class="form-group">
            <label for="formNomortelepon">Nomor telepon</label>
            <input type="text" name="telepon" id="formNomortelepon" class="form-control" placeholder="Masukan nama nomor telepon" value="<?php echo $dataUbah->Nomor_Telepon ?>">
            <small id="telepon" class="error_msg invalid-feedback"></small>
          </div>
          <div class="form-group">
            <label for="formBagian">Bagian Akses</label>
            <select name="bagian" id="formBagian" class="form-control select2" style="width: 100%;">
              <?php foreach ($listBagian as $bagian) : ?>
                <?php if ($dataUbah->bagian == $bagian->Kode_bagian) : ?>
                <option selected="selected" value="<?php echo $bagian->Kode_bagian ?>"><?php echo $bagian->Nama_bagian ?></option>
                <?php else : ?>
                <option value="<?php echo $bagian->Kode_bagian ?>"><?php echo $bagian->Nama_bagian ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
            <small id="bagian" class="error_msg invalid-feedback"></small>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
          <a href="<?php echo base_url() . 'c_auth/listUser' ?>" class="btn btn-default"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $('form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?php echo base_url() . 'c_auth/updateUser/' ?>"+$('[name=id]').val(),
      method: "POST",
      dataType: "JSON",
      data: {
        NamaUser: $('[name=NamaUser]').val(),
        Username: $('[name=Username]').val(),
        Password: $('[name=Password]').val(),
        telepon: $('[name=telepon]').val(),
        bagian: $('[name=bagian]').val(),
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
            window.location = "<?php echo base_url() . 'c_auth/listUser' ?>";
          });
        }
      }
    });
    return false;
  })
</script>