<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Stock Opname</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered" id="t_so">
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Quantity</th>
                <th>Stok</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listBarang as $barang) : ?>
                <tr>
                  <td style="width: 20%"><?php echo $barang->Kode_Barang ?></td>
                  <td style="width: 40%"><?php echo $barang->Nama_Barang ?></td>
                  <td style="width: 15%"><?php echo $barang->Quantity ?></td>
                  <td style="width: 25%">
                    <input type="text" name="inputStok[]" class="form-control" value="0">
                    <input type="hidden" name="stok[]" class="form-control" value="<?php echo $barang->Quantity ?>">
                    <input type="hidden" name="kodeBarang[]" class="form-control" value="<?php echo $barang->Kode_Barang ?>">
                    <input type="hidden" name="hargaBeli[]" class="form-control" value="<?php echo $barang->Harga_Beli ?>">
                    <input type="hidden" name="namaBarang[]" class="form-control" value="<?php echo $barang->Nama_Barang ?>">
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <button class="btn btn-primary save"> <i class="fa fa-check"></i> Proses</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    $('#t_so').DataTable();

    $(document).on('click', '.save', function(e) {
      let inputStok = $("input[name='inputStok[]']").map(function() {
        return $(this).val();
      }).get();
      let kodeBarang = $("input[name='kodeBarang[]']").map(function() {
        return $(this).val();
      }).get();
      let stok = $("input[name='stok[]']").map(function() {
        return $(this).val();
      }).get();
      let hargaBeli = $("input[name='hargaBeli[]']").map(function() {
        return $(this).val();
      }).get();
      let namaBarang = $("input[name='namaBarang[]']").map(function() {
        return $(this).val();
      }).get();

      $.ajax({
        url: "<?php echo base_url('c_stockopname/insertSO') ?>",
        method: "POST",
        type: "POST",
        dataType: "JSON",
        data: {
          inputStok,
          kodeBarang,
          stok,
          hargaBeli,
          namaBarang
        },
        success: function(respon) {
          if (respon.is_error) {
            Alert.fire({
              type: 'error',
              title: 'Stock opname gagal'
            });
          }
          if (respon.success) {
            Alert.fire({
              type: 'success',
              title: 'Stock opname berhasil.'
            }).then((result) => {
              window.location = "<?php echo base_url() . 'c_stockopname/index' ?>";
            });
          }
        }
      });
    });
  });
</script>