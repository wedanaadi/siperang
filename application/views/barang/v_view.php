<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Barang</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_barang/tambahBarang' ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="t_barang" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="width: 5%">No.</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Quantity</th>
                <?php if ($this->session->userdata('bagian') == '1') : ?>
                  <th style="width: 15%">Action</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listBarang as $key => $Barang) : ?>
                <tr>
                  <td><?php echo $key + 1 ?></td>
                  <td><?php echo $Barang->Kode_Barang ?></td>
                  <td><?php echo ucwords($Barang->Nama_Barang) ?></td>
                  <td><?php echo 'Rp. ' . number_format($Barang->Harga_Beli, 0, '.', '.') ?></td>
                  <td><?php echo 'Rp. ' . number_format($Barang->Harga_Jual, 0, '.', '.') ?></td>
                  <td><?php echo $Barang->Quantity ?></td>
                  <?php if ($this->session->userdata('bagian') == '1') : ?>
                    <td>
                      <center>
                        <a href="<?php echo base_url() . 'c_barang/editBarang/' . $Barang->Kode_Barang ?>">Edit</a> | <a id-pk="<?php echo $Barang->Kode_Barang ?>" id="btnDelete" href="javascript:void(0)"> Delete</a>
                      </center>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    $('#t_barang').DataTable();

    $(document).on('click', '#btnDelete', function() {
      var id = $(this).attr('id-pk');
      Swal.fire({
        title: 'Kamu yakin?',
        text: "Kamu tidak akan dapat mengembalikan data!",
        type: 'warning',
        showCancelButton: true,
        closeOnConfirm: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus data!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url() . 'c_barang/deleteBarang/' ?>" + id,
            method: "POST",
            dataType: "JSON",
            success: function(respon) {
              if (respon.success) {
                Alert.fire({
                  type: 'success',
                  title: 'Berhasil menghapus data.'
                }).then((result) => {
                  window.location = "<?php echo base_url() . 'c_barang/index' ?>";
                });
              }
            }
          });
        }
      })
    });
  })
</script>