<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Order Barang</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_order/tambahOrder' ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 text-center">
            <p>CV. Bali Nirvana Komputer</p>
            <p>Jl. Diponogoro No. 48 Lt. 1 Denpasar</p>
            <p>Tlp. 085338253831</p>
          </div>
          <div class="col-md-6">
            <form class="form-horizontal" id="form">
              <div class="card-body">
                <div class="form-group row">
                  <label for="formTanggal" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" name="Tanggal" class="form-control" id="formTanggal" placeholder="Tanggal" value="<?php echo date('Y/m/d') ?>">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="formSupplier" class="col-sm-4 control-label">Nama Supplier</label>
                  <div class="col-sm-8">
                    <select name="NamaSupplier" id="formSupplier" class="form-control" style="width: 100%;">
                      <option value="ALL" selected>-- SEMUA SUPPLIER --</option>
                      <?php foreach ($listSupplier as $supplier) : ?>
                        <option value="<?php echo $supplier->Kode_Supplier ?>"><?php echo $supplier->Nama_Supplier ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="table-responsive">
          <table id="t_order" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Kode Order</th>
                <th>Supplier</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th style="width: 15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listOrder as $order) : ?>
                <tr>
                  <td><?php echo $order->Kode_Order ?></td>
                  <td><?php echo $order->Nama_Supplier ?></td>
                  <td><?php echo $order->Total ?></td>
                  <td><?php echo $order->Tanggal_Order ?></td>
                  <td align="center">
                    <?php if ($order->isStatus == '0') : ?>
                      <a href="<?php echo base_url() . 'c_order/editOrder/' . $order->Kode_Order ?>" class="btn btn-warning btn-sm" title="Ubah Request"><i class="fas fa-pencil-alt"></i></a>
                    <?php endif; ?>
                    <button id-order="<?php echo $order->Kode_Order ?>" class="btn btn-secondary btn-sm btnDetil" title="Detil Request"><i class="fas fa-eye"></i></button>
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
        <h5 class="modal-title" id="exampleModalLabel">Detil Order Barang</h5>
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
    $('[name=NamaSupplier]').select2();

    $('[name=Tanggal]').datepicker({
      format: 'yyyy/mm/dd',
      endDate: new Date,
      autoclose: true
    });

    var tabel = $('#t_order').DataTable({
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
    let kode_order = null;

    $(document).on('click', '.btnDetil', function(e) {
      kode_order = $(this).attr('id-order');
      $.ajax({
        url: "<?php echo base_url() . 'c_order/detil/' ?>" + kode_order,
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

    $(document).on('change', '[name=Tanggal]', function() {
      tabel.clear().draw();
      $.ajax({
        url: "<?php echo base_url() . 'c_order/getOrderJson' ?>",
        method: "POST",
        dataType: "JSON",
        data: {
          Tanggal: $('[name=Tanggal]').val(),
          Supplier: $('[name=NamaSupplier]').val()
        },
        success: function(respon) {
          if (respon.length > 0) {
            for (let index = 0; index < respon.length; index++) {
              if (respon[index].isStatus == '0') {
                var btnAct = '<a href="<?php echo base_url() . "c_order/editOrder/" ?>' + respon[index].Kode_Order + '" class="btn btn-warning btn-sm" title="Ubah Request"><i class="fas fa-pencil-alt"></i></a> ';
              } else {
                var btnAct = ' ';
              }
              btnAct += '<button id-order="' + respon[index].Kode_Order + '" class="btn btn-secondary btn-sm btnDetil" title="Detil Request"><i class="fas fa-eye"></i></button>';
              var rowadd = tabel.row.add([
                respon[index].Kode_Order,
                respon[index].Nama_Supplier,
                respon[index].Total,
                respon[index].Tanggal_Order,
                btnAct
              ]).draw();
              tabel.row(rowadd).column(4).nodes().to$().addClass('text-center');
            }
          }
        }
      });
    });

    $('[name=NamaSupplier]').on('select2:select', function(e) {
      tabel.clear().draw();
      $.ajax({
        url: "<?php echo base_url() . 'c_order/getOrderJson' ?>",
        method: "POST",
        dataType: "JSON",
        data: {
          Tanggal: $('[name=Tanggal]').val(),
          Supplier: $('[name=NamaSupplier]').val()
        },
        success: function(respon) {
          if (respon.length > 0) {
            for (let index = 0; index < respon.length; index++) {
              if (respon[index].isStatus == '0') {
                var btnAct = '<a href="<?php echo base_url() . "c_order/editOrder/" ?> ' + respon[index].Kode_Order + '" class="btn btn-warning btn-sm" title="Ubah Request"><i class="fas fa-pencil-alt"></i></a> ';
              } else {
                var btnAct = ' ';
              }
              btnAct += '<button id-order="' + respon[index].Kode_Order + '" class="btn btn-secondary btn-sm btnDetil" title="Detil Request"><i class="fas fa-eye"></i></button>';
              var rowadd = tabel.row.add([
                respon[index].Kode_Order,
                respon[index].Nama_Supplier,
                respon[index].Total,
                respon[index].Tanggal_Order,
                btnAct
              ]).draw();
              tabel.row(rowadd).column(4).nodes().to$().addClass('text-center');
            }
          }
        }
      });
    });
  });
</script>