<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Supplier</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_supplier/tambahSupplier' ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="t_user" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="width: 5%">No.</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th style="width: 15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listSupplier as $key => $supplier) : ?>
                <tr>
                  <td><?php echo $key + 1 ?></td>
                  <td><?php echo ucwords($supplier->Nama_Supplier) ?></td>
                  <td><?php echo $supplier->Alamat_Supplier ?></td>
                  <td><?php echo $supplier->No_Tlp ?></td>
                  <td>
                    <center>
                      <a href="<?php echo base_url() . 'c_supplier/editSupplier/' . $supplier->Kode_Supplier ?>">Edit</a> | <a id-pk="<?php echo $supplier->Kode_Supplier ?>" id="btnDelete" href="javascript:void(0)"> Delete</a>
                    </center>
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

<script>
  $(function() {
    $('#t_user').DataTable();

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
            url: "<?php echo base_url() . 'c_supplier/deleteSupplier/' ?>" + id,
            method: "POST",
            dataType: "JSON",
            success: function(respon) {
              if (respon.success) {
                Alert.fire({
                  type: 'success',
                  title: 'Berhasil menghapus data.'
                }).then((result) => {
                  window.location = "<?php echo base_url() . 'c_supplier/index' ?>";
                });
              }
            }
          });
        }
      })
    });
  })
</script>