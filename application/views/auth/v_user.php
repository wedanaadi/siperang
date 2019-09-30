<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar User</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_auth/tambahUser' ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="t_user" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="width: 5%">No.</th>
                <th style="width: 35%">Nama User</th>
                <th style="width: 15%">Username</th>
                <th style="width: 15%">Password</th>
                <th style="width: 15%">Bagian</th>
                <th style="width: 15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listUser as $key => $user) : ?>
                <tr>
                  <td><?php echo $key + 1 ?></td>
                  <td><?php echo ucwords($user->Nama_User) ?></td>
                  <td><?php echo $user->Username ?></td>
                  <td><?php echo "**********" ?></td>
                  <td><?php echo $user->Nama_bagian ?></td>
                  <td>
                    <center>
                      <a href="<?php echo base_url() . 'c_auth/editUser/' . $user->Kode_User ?>">Edit</a> | <a id="btnDelete" id-pk="<?php echo $user->Kode_User ?>" href="javascript:void(0)"> Delete</a>
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
            url: "<?php echo base_url() . 'c_auth/deleteUser/' ?>" + id,
            method: "POST",
            dataType: "JSON",
            success: function(respon) {
              if (respon.success) {
                Alert.fire({
                  type: 'success',
                  title: 'Berhasil menghapus data.'
                }).then((result) => {
                  window.location = "<?php echo base_url() . 'c_auth/listUser' ?>";
                });
              }
            }
          });
        }
      })
    });
  })
</script>