<section class="content">
  <div class="content">
    <div class="content-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Supplier</h3>
        </div>
        <form action="javascript:void(0)" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="formNamaSupplier">Nama Supplier</label>
              <input type="text" name="NamaSupplier" id="formNamaSupplier" class="form-control" placeholder="Masukan nama supplier">
              <small id="NamaSupplier" class="error_msg invalid-feedback"></small>
            </div>

            <div class="form-group">
              <label for="formAlamatSupplier">Alamat</label>
              <textarea name="AlamatSupplier" id="formAlamatSupplier" cols="10" rows="5" class="form-control" placeholder="Masukan alamat supplier"></textarea>
              <!-- <input type="text" name="NamaSupplier" id="formNamaSupplier" class="form-control" placeholder="Masukan nama supplier"> -->
              <small id="AlamatSupplier" class="error_msg invalid-feedback"></small>
            </div>

            <div class="form-group">
              <label for="formNoTelp">Telepon Supplier</label>
              <input type="text" name="NoTelp" id="formNoTelp" class="form-control" placeholder="Masukan nomor telepon supplier">
              <small id="NoTelp" class="error_msg invalid-feedback"></small>
            </div>

            <p>
              <small id="BarangSupplier" class="error_msg invalid-feedback"></small> <br>
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                List Barang
              </button>
            </p>
            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                <table class="table table-bordered" id="t_barang" width="100%">
                  <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th style="width: 10%"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($listBarang as $b) : ?>
                      <tr>
                        <td><?php echo $b->Nama_Barang ?></td>
                        <td class="text-center"><input type="checkbox" name="listBarang[]" class="flat-red" value="<?php echo $b->Kode_Barang ?>"></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
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
</section>

<script>
  $('form').on('submit', function(e) {
    e.preventDefault();
    var listBarang = [];
    $('input[name^="listBarang"]:checked').each(function() {
      if ($(this).val() != '') {
        listBarang.push({
          kode: $(this).val(),
        });
      }
    });

    $.ajax({
      url: "<?php echo base_url() . 'c_supplier/buatSupplier' ?>",
      method: "POST",
      dataType: "JSON",
      data: {
        NamaSupplier: $('[name=NamaSupplier]').val(),
        AlamatSupplier: $('[name=AlamatSupplier]').val(),
        NoTelp: $('[name=NoTelp]').val(),
        BarangSupplier: listBarang
      },
      success: function(respon) {
        $('.error_msg').html('');
        $('.form-control').removeClass('is-invalid');
        if (respon.is_error) {
          jQuery.each(respon.errors, function(key, value) {
            if (key === 'BarangSupplier[]') {
              $('#BarangSupplier').fadeIn(0, 300);
              $('#BarangSupplier').html(value);
            } else {
              $('[name=' + key + ']').addClass('is-invalid');
              $('#' + key).fadeIn(0, 300);
              $('#' + key).html(value);
            }
          });
        }
        if (respon.success) {
          Alert.fire({
            type: 'success',
            title: 'Berhasil menambah data.'
          }).then((result) => {
            window.location = "<?php echo base_url() . 'c_supplier/index' ?>";
          });
        }
      }
    });
    return false;
  })
</script>