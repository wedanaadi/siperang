<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Bagian Akses</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_auth/tambahBagian' ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="t_bagian" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="width: 5%">No.</th>
                <th>Bagian</th>
                <th style="width: 15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listBagian as $key => $data) : ?>
                <tr>
                  <td><?php echo $key + 1 ?></td>
                  <td><?php echo $data->Nama_bagian ?></td>
                  <td>
                    <center>
                      <a href="<?php echo base_url() . 'c_auth/editBagian/' . $data->Kode_bagian ?>">Edit</a> | <a id-pk="<?php echo $data->Kode_bagian ?>" href="javascript:void(0)" id="btnDelete"> Delete</a>
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
    $('#t_bagian').DataTable();

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
            url: "<?php echo base_url() . 'c_auth/deleteBagian/' ?>" + id,
            method: "POST",
            dataType: "JSON",
            success: function(respon) {
              if (respon.success) {
                Alert.fire({
                  type: 'success',
                  title: 'Berhasil menghapus data.'
                }).then((result) => {
                  window.location = "<?php echo base_url() . 'c_auth/listBagian' ?>";
                });
              }
            }
          });
        }
      })
    });
  })
</script>