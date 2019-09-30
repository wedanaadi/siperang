<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Ubah Transaksi Penjualan</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_penjualan/index' ?>" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
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
                  <label for="formKode" class="col-sm-4 control-label">Kode Transaksi</label>
                  <div class="col-sm-8">
                    <input type="text" name="KodeTransaksi" class="form-control" id="formKode" readonly="readonly" value="<?php echo $trx->Kode_Transaksi ?>">
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
        <div class="row">
          <button id="btnAdd" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Barang</button>
        </div>
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
                  <td colspan="4"></td>
                  <td>0</td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <hr>
        <div class="row mt-2">
          <div class="col-md-4">
            <div class="form-group">
              <label for="formJumlahBayar">Grand Total</label>
              <input type="text" name="JumlahBayar" id="formJumlahBayar" class="form-control" placeholder="Masukan pembayaran" value="<?php echo $trx->Total ?>" readonly>
              <small id="JumlahBayar" class="error_msg invalid-feedback"></small>
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="form-group col-md-4">
            <label>
              <input id="rd-cash" type="radio" class="flat-red" checked>
              Cash
            </label>
            <label>
              <input id="rd-credit" type="radio" class="flat-red">
              Credit
            </label>
          </div>
        </div>
        <div class="row"></div>
        <div id="elCredit" style="display:none">
          <div class="row">
            <div class="form-group col-md-4 has-success" id="eldp">
              <label for="" class="control-label">Down Payment</label>
              <input type="text" name="dp" id="" class="form-control formuang" value="<?php echo $trx->DP ?>">
            </div>
            <div class="form-group col-md-4 has-success" id="elrem">
              <label for="" class="control-label">Sisa Pembayaran</label>
              <input type="text" name="remain" id="" class="form-control formuang" value="<?php echo $trx->Sisa ?>" readonly>
            </div>
            <div class="form-group col-md-4 has-success">
              <label for="" class="control-label">Jatuh Tempo</label>
              <input type="text" name="due" id="" class="form-control tanggalset" value="<?php echo $trx->date_format ?>">
            </div>
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
            <input type="text" name="HargaJual" id="formHargaJual" class="form-control" placeholder="Pilih Kode Barang" readonly>
            <small id="HargaJual" class="error_msg invalid-feedback"></small>
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
    let idTrxEdit = "<?php echo $trx->Kode_Transaksi ?>";
    let total;
    let btnaction = '<center>' +
      '<a href="javascript:void(0)" class="btn btn-warning btn-sm edit" title="edit item"><i class="fa fa-pencil-alt"></i></a> ' +
      '<a href="javascript:void(0)" class="btn btn-danger btn-sm remove" title="remove item"><i class="fa fa-trash"></i></a>' +
      '</center>';
    $('[name=KodeBarang]').select2();

    var dataDetil = JSON.parse('<?php echo isset($detil) ? $detil : "{}" ?>');

    $('#btnAdd').on('click', function() {
      $('#formAdd')[0].reset();
      $('[name=KodeBarang]').val('').trigger('change');
      $('#modalAdd').modal('show');
    });

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

        $(api.column(0).footer()).html("TOTAL");
        $(api.column(4).footer()).html(numFormat(hitung));
      }
    });

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

    let statusTrx = "<?php echo $trx->StatusTransaksi ?>";
    if (statusTrx == '2') {
      $('#rd-cash').iCheck('uncheck');
      $('#elCredit').fadeIn(10);
      $('#rd-credit').iCheck('check');
    } else {
      $('#rd-cash').iCheck('check');
      $('#rd-credit').iCheck('uncheck');
      $('#elCredit').fadeOut(300);
    }

    $('[name=KodeBarang]').on('select2:select', function(e) {
      $.ajax({
        url: "<?php echo base_url() . 'c_barang/getDetil/' ?>" + $(this).val(),
        method: "POST",
        dataType: "JSON",
        success: function(respon) {
          $('[name=NamaBarang]').val(respon.Nama_Barang);
          $('[name=HargaJual]').val(respon.Harga_Jual);
        }
      })
    })

    $('#formAdd').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?php echo base_url() . 'c_penjualan/addBarang' ?>",
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
              newSub = parseFloat($('[name=HargaJual]').val()) * parseFloat(newqQty);
              tabel.cell(row_id, 3).data(newqQty).draw();
              tabel.cell(row_id, 4).data(newSub).draw();
            } else {
              tabel.row.add([
                $('[name=KodeBarang]').val(),
                $('[name=NamaBarang]').val(),
                $('[name=HargaJual]').val(),
                $('[name=Quantity]').val(),
                parseFloat($('[name=HargaJual]').val()) * parseFloat($('[name=Quantity]').val()),
                btnaction
              ]).draw();
            }
            $('[name=JumlahBayar]').val(total);
            hitungRemainAfterDiscount();
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
      $('[name=HargaJual]').val(tb[2]);
      $('[name=Quantity]').val(tb[3]);
      tr = $(this).closest('tr');
      tabel.row(tr).remove().draw();
      $('#modalAdd').modal('show');
    });

    function hitungRemainAfterDiscount() {
      let dp = parseFloat($('[name=dp]').val());
      let totalremafdis = total - dp;
      $('[name=remain]').val(totalremafdis);
    }

    $(document).on('input', '[name=dp]', function() {
      hitungRemainAfterDiscount();
    });

    let methodPay = 1;
    $(document).on('ifClicked', '#rd-credit', function() {
      methodPay = 2;
      hitungRemainAfterDiscount();
      $('#rd-cash').iCheck('uncheck');
      $('#elCredit').fadeIn(10);
      let current = new Date();
      let due = new Date(current.getFullYear(), current.getMonth() + 1, current.getDate());
      let dd = due.getDate();
      let mm = (due.getMonth() + 1);
      let yy = due.getFullYear();
      if (dd < 10) {
        dd = '0' + dd;
      }
      if (mm < 10) {
        mm = '0' + mm;
      }
      let duedate = yy + '/' + mm + '/' + dd;
      $('[name=due]').val(duedate).datepicker('update');
    });

    $(document).on('ifClicked', '#rd-cash', function() {
      methodPay = 1;
      $('#rd-credit').iCheck('uncheck');
      $('#elCredit').fadeOut(300);
      let current = new Date();
      let dd = current.getDate();
      let mm = (current.getMonth() + 1);
      let yy = current.getFullYear();
      if (dd < 10) {
        dd = '0' + dd;
      }
      if (mm < 10) {
        mm = '0' + mm;
      }
      let duedate = yy + '/' + mm + '/' + dd;
      $('[name=due]').val(duedate).datepicker('update');
      $('[name=dp]').val(0);
      $('[name=remain]').val(0);
    });

    $('#btnSave').on('click', function() {
      $.ajax({
        url: "<?php echo base_url() . 'c_penjualan/updateTrx/' ?>" + idTrxEdit,
        method: "POST",
        dataType: "JSON",
        data: {
          Kode: $('[name=KodeTransaksi]').val(),
          Total: total,
          DP: $('[name=dp]').val(),
          sisa: $('[name=remain]').val(),
          duedate: $('[name=due]').val(),
          method: methodPay,
          Detil: tabel.rows().count() === 0 ? null : tabel.rows().data().toArray(),
          old: dataDetil
        },
        success: function(respon) {
          $('.alert-danger').hide();
          $('.alert-danger').html('');
          if (respon.is_error) {
            jQuery.each(respon.errors, function(key, value) {
              $('.alert-danger').show();
              $('.alert-danger').append('<p>' + value + '</p>');
            });
          }

          if (respon.revisi) {
            for (let x = 0; x < respon.jumlah; x++) {
              $('.alert-danger').show();
              $('.alert-danger').append('<p>Jumlah stok minimum item ' + respon.min[x].kodeBarang + ' adalah ' + parseFloat(respon.min[x].stock_available) + ' unit</p>');
            }
          }

          if (respon.success) {
            Alert.fire({
              type: 'success',
              title: 'Transaksi berhasil dirubah.'
            }).then((result) => {
              window.location = "<?php echo base_url() . 'c_penjualan/index' ?>";
            });
          }
        }

      });
    });
  });
</script>