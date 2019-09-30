<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Request Barang</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_request/tambahRequest' ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="t_request" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Kode Request</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>User</th>
                <th>Status</th>
                <th style="width: 15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listRequest as $lr) : ?>
                <tr>
                  <td><?php echo $lr->Kode_Request ?></td>
                  <td><?php echo $lr->Tanggal_Request ?></td>
                  <td><?php echo  'Rp. ' . number_format($lr->Total, 0, '.', '.') ?></td>
                  <td><?php echo  $lr->Nama_User ?></td>
                  <td class="text-center"><?php echo  $lr->isStatus == '0' ? '<div class="badge badge-warning">BELUM DIORDER</div>' : '<div class="badge badge-success">DIORDER</div>' ?></td>
                  <td align="center" style="width: 15%">
                    <?php if ($lr->isStatus == '0') : ?>
                      <a href="<?php echo base_url() . 'c_request/editRequest/' . $lr->Kode_Request ?>" class="btn btn-warning btn-sm" title="Ubah Request"><i class="fas fa-pencil-alt"></i></a>
                    <?php endif; ?>
                    <button id-req="<?php echo $lr->Kode_Request ?>" class="btn btn-secondary btn-sm btnDetil" title="Detil Request"><i class="fas fa-eye"></i></button>
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

<div class="modal fade" id="modalDetil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detil Request Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="t_detil">
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th>Subtotal</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  $(function() {
    $('#t_request').DataTable({
      columnDefs: [{
        targets: [2],
        render: $.fn.dataTable.render.number('.', ',', '', 'Rp ')
      }],
    });

    var detil = $('#t_detil').DataTable({
      columnDefs: [{
        targets: [2, 4],
        render: $.fn.dataTable.render.number('.', ',', '', 'Rp ')
      }],
    });
    let kode_request = null;

    $(document).on('click', '.btnDetil', function(e) {
      kode_request = $(this).attr('id-req');
      $.ajax({
        url: "<?php echo base_url() . 'c_request/detil/' ?>" + kode_request,
        method: "POST",
        dataType: "JSON",
        success: function(respon) {
          for (let index = 0; index < respon.length; index++) {
            console.log(respon[index]);
            detil.row.add([
              respon[index].Kode_Barang,
              respon[index].Nama_Barang,
              respon[index].Harga_Barang,
              respon[index].Quantity,
              respon[index].Subtotal,
            ]).draw();
          }
          $('#modalDetil').modal('show');
        }
      });
    });
  });
</script>