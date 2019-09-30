<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Ubah Return</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_return/index' ?>" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form id="form1" class="form-horizontal" id="form">
              <div class="card-body">
                <div class="form-group row">
                  <label for="formKodeSupplier" class="col-sm-4 control-label">Kode Supplier</label>
                  <div class="col-sm-8">
                    <select name="KodeSupplier" id="formKodeSupplier" class="form-control" style="width: 100%;">
                      <option value="" selected disabled>-- PILIH KODE SUPPLIER --</option>
                      <?php foreach ($listSupplier as $supplier) : ?>
                        <?php if ($return->Supplier == $supplier->Kode_Supplier) : ?>
                          <option selected value="<?php echo $supplier->Kode_Supplier ?>"><?php echo $supplier->Kode_Supplier ?> || <?php echo $supplier->Nama_Supplier ?></option>
                        <?php else : ?>
                          <option value="<?php echo $supplier->Kode_Supplier ?>"><?php echo $supplier->Kode_Supplier ?> || <?php echo $supplier->Nama_Supplier ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                    <small id="KodeSupplier" class="error_msg invalid-feedback"></small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="formNamaSupplier" class="col-sm-4 control-label">Nama Supplier</label>
                  <div class="col-sm-8">
                    <input type="text" name="NamaSupplier" class="form-control" id="formNamaSupplier" readonly="readonly" placeholder="Nama Supplier" value="<?php echo $dataSupplier->Nama_Supplier ?>">
                    <small id="NamaSupplier" class="error_msg invalid-feedback"></small>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="col-md-6">
            <form id="form2" class="form-horizontal" id="form">
              <div class="card-body">
                <div class="form-group row">
                  <label for="formKode" class="col-sm-4 control-label">Kode Return</label>
                  <div class="col-sm-8">
                    <input type="text" name="KodeReturn" class="form-control" id="formKode" readonly="readonly" value="<?php echo $return->Kode_Return ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="formTanggal" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" name="Tanggal" class="form-control" id="formTanggal" placeholder="Tanggal" value="<?php echo date('Y/m/d') ?>" readonly>
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <hr>
        <button id="btnAdd" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Barang</button>

        <div class="row mt-2">
          <div class="col-md-12 p-0">
            <div class="alert alert-danger" style="display:none; border-radius: 0"></div>
          </div>
        </div>

        <div class="row mt-2">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="t_temp">
              <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <td colspan="4" style="font-weight: 700"></td>
                  <td style="font-weight: 700">0</td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button id="btnSave" type="button" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAdd" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Penulasan Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formAdd" method="post">
        <div class="modal-body">

          <div class="form-group">
            <label for="formKodeBarang">Kode Barang</label>
            <select name="KodeBarang" id="formKodeBarang" class="form-control" style="width: 100%">
              <option value="" selected disabled> -- PILIH KODE BARANG -- </option>
              <?php foreach ($listBarang as $row) : ?>
                <option value="<?php echo $row->Kode_Barang ?>"> <?php echo $row->Kode_Barang ?> | <?php echo $row->Nama_Barang ?> </option>
              <?php endforeach; ?>
            </select>
            <small id="KodeBarang" class="error_msg invalid-feedback"></small>
          </div>

          <div class="form-group">
            <label for="formNamaBarang">Nama Barang</label>
            <input type="text" name="NamaBarang" id="formNamaBarang" class="form-control" placeholder="Pilih Kode Barang" readonly>
            <small id="NamaBarang" class="error_msg invalid-feedback"></small>
          </div>

          <div class="form-group">
            <label for="formHargaJual">Harga</label>
            <input type="text" name="HargaBeli" id="formHargaJual" class="form-control" placeholder="Pilih Kode Barang" readonly>
            <small id="HargaBeli" class="error_msg invalid-feedback"></small>
          </div>

          <div class="form-group">
            <label for="formQuantity">Quantity</label>
            <input type="text" name="Quantity" id="formQuantity" class="form-control" placeholder="Masukan quantity">
            <small id="Quantity" class="error_msg invalid-feedback"></small>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-folder-plus"></i> Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(function() {

    let idReturn = "<?php echo $return->Kode_Return ?>";
    $('[name=KodeSupplier]').select2();
    let total;
    var tabel = $('#t_temp').DataTable({
      columnDefs: [{
        targets: [2, 4],
        render: $.fn.dataTable.render.number('.', ',', '', 'Rp ')
      }],
      footerCallback: function(row, data, start, end, display) {
        var api = this.api();
        var hitung = api.column(4).data().reduce(function(a, b) {
          return parseInt(a) + parseInt(b);
        }, 0);
        total = hitung;
        var numFormat = $.fn.dataTable.render.number('.', ',', '', 'Rp ').display;

        $(api.column(0).footer()).html("GRAND TOTAL").addClass('text-center');
        $(api.column(4).footer()).html(numFormat(hitung));
      }
    });

    let btnaction = '<center>' +
      '<a href="javascript:void(0)" class="btn btn-warning btn-sm edit" title="edit item"><i class="fa fa-pencil-alt"></i></a> ' +
      '<a href="javascript:void(0)" class="btn btn-danger btn-sm remove" title="remove item"><i class="fa fa-trash"></i></a>' +
      '</center>';

    var dataDetil = JSON.parse('<?php echo isset($detil) ? $detil : "{}" ?>');

    for (let index = 0; index < dataDetil.length; index++) {
      tabel.row.add([
        dataDetil[index].Kode_Barang,
        dataDetil[index].Nama_Barang,
        dataDetil[index].Harga_Barang,
        dataDetil[index].Quantity,
        parseFloat(dataDetil[index].Subtotal),
        btnaction
      ]).draw();
    }

    $('[name=KodeBarang]').select2();

    $('#btnAdd').on('click', function() {
      $('#formAdd')[0].reset();
      $('[name=KodeBarang]').val('').trigger('change');
      $('#modalAdd').modal('show');
    });

    $('[name=KodeBarang]').on('select2:select', function(e) {
      $.ajax({
        url: "<?php echo base_url() . 'c_barang/getDetil/' ?>" + $(this).val(),
        method: "POST",
        dataType: "JSON",
        success: function(respon) {
          $('[name=NamaBarang]').val(respon.Nama_Barang);
          $('[name=HargaBeli]').val(respon.Harga_Beli);
        }
      })
    });

    $('#formAdd').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?php echo base_url() . 'c_returnbarang/addBarang' ?>",
        method: "POST",
        dataType: "JSON",
        contentType: false,
        processData: false,
        data: new FormData($("#modalAdd form")[0]),
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
            $('#modalAdd').modal('hide');
            let value = $('[name=KodeBarang]').val();
            let aksi = false;
            $('#t_temp tbody tr').each(function(index) {
              $row = $(this);
              var id = $row.find("td:eq(0)").text();
              if (id.indexOf(value) === 0) {
                row_id = tabel.row(this);
                aksi = true;
              }
            });
            if (aksi == true) {
              let datatb = row_id.data();
              newqQty = parseInt(datatb[3]) + parseInt($('[name=Quantity]').val());
              newSub = parseFloat($('[name=HargaBeli]').val()) * parseFloat(newqQty);
              tabel.cell(row_id, 3).data(newqQty).draw();
              tabel.cell(row_id, 4).data(newSub).draw();
            } else {
              tabel.row.add([
                $('[name=KodeBarang]').val(),
                $('[name=NamaBarang]').val(),
                $('[name=HargaBeli]').val(),
                $('[name=Quantity]').val(),
                parseFloat($('[name=HargaBeli]').val()) * parseFloat($('[name=Quantity]').val()),
                btnaction
              ]).draw();
            }
          }
        }
      });
      return false;
    });

    $(document).on('click', '.remove', function(e) {
      tr = $(this).closest('tr');
      tabel.row(tr).remove().draw();
    });

    $(document).on('click', '.edit', function(e) {
      var tb = tabel.row($(this).parents('tr')).data();
      $('[name=KodeBarang]').val(tb[0]).trigger('change');
      $('[name=NamaBarang]').val(tb[1]);
      $('[name=HargaBeli]').val(tb[2]);
      $('[name=Quantity]').val(tb[3]);
      tr = $(this).closest('tr');
      tabel.row(tr).remove().draw();
      $('#modalAdd').modal('show');
    });

    $('#btnSave').on('click', function() {
      $.ajax({
        url: "<?php echo base_url() . 'c_returnbarang/updateReturn/' ?>" + idReturn,
        method: "POST",
        dataType: "JSON",
        data: {
          Kode: $('[name=KodeReturn]').val(),
          Total: total,
          KodeSupplier: $('[name=KodeSupplier]').val(),
          NamaSupplier: $('[name=NamaSupplier]').val(),
          Detil: tabel.rows().count() === 0 ? null : tabel.rows().data().toArray(),
          old: dataDetil
        },
        success: function(respon) {
          $('.alert-danger').hide();
          $('.alert-danger').html('');
          $('.error_msg').html('');
          $('.form-control').removeClass('is-invalid');
          if (respon.is_error) {
            jQuery.each(respon.errors, function(key, value) {
              if (key == 'Detil[]') {
                $('.alert-danger').show();
                $('.alert-danger').append('<p>' + value + '</p>');
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
              title: 'Return barang berhasil.'
            }).then((result) => {
              window.location = "<?php echo base_url() . 'c_returnbarang/index' ?>";
            });
          }
        }

      });
    });

    $('[name=KodeSupplier]').on('select2:select', function(e) {
      $.ajax({
        url: "<?php echo base_url('c_returnbarang/getSupplierData') ?>",
        method: "POST",
        type: "POST",
        dataType: "JSON",
        data: {
          id: $(this).val()
        },
        success: function(respon) {
          $('[name=NamaSupplier]').val(respon.Nama_Supplier);
        }
      });
    });

  });
</script>