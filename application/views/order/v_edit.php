<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Ubah Order</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_order/index' ?>" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
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
                        <?php if ($order->Supplier == $supplier->Kode_Supplier) : ?>
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
                    <input type="text" name="NamaSupplier" class="form-control" id="formNamaSupplier" readonly="readonly" placeholder="Nama Supplier" value="<?php echo $detilSupplier->Nama_Supplier ?>">
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
                  <label for="formKode" class="col-sm-4 control-label">Kode Order</label>
                  <div class="col-sm-8">
                    <input type="text" name="KodeOrder" class="form-control" id="formKode" readonly="readonly" value="<?php echo $order->Kode_Order ?>">
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
        <button id="btnReq" class="btn btn-warning tombol-enter"> <i class="fas fa-clipboard-list"></i> Request Barang</button>
        <hr>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="formKodeBarang">Kode Barang</label>
              <input type="text" name="KodeBarang" id="formKodeBarang" class="form-control" placeholder="Kode barang">
              <small id="KodeBarang" class="error_msg invalid-feedback"></small>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="formNamaBarang">Nama Barang</label>
              <input type="text" name="NamaBarang" id="formNamaBarang" class="form-control" placeholder="Pilih Kode Barang" readonly>
              <small id="NamaBarang" class="error_msg invalid-feedback"></small>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="formHargaBarang">Harga</label>
              <input type="text" name="HargaBarang" id="formHargaBarang" class="form-control" placeholder="Harga barang">
              <small id="HargaBarang" class="error_msg invalid-feedback"></small>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="formQuantity">Quantity</label>
              <input type="text" name="Quantity" id="formQuantity" class="form-control" placeholder="Masukan quantity">
              <small id="Quantity" class="error_msg invalid-feedback"></small>
            </div>
          </div>

          <div class="col-md-2">
            <button class="btn btn-primary tombol-enter" id="btnAdd"> <i class="fas fa-download"></i> Tambah</button>
          </div>
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
                  <th class="sembunyi">Id Req</th>
                  <th class="sembunyi">Kode Req</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <td colspan="4" style="font-weight: 700"></td>
                  <td style="font-weight: 700">0</td>
                  <td></td>
                  <td class="sembunyi"></td>
                  <td class="sembunyi"></td>
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

<div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftar Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="t_barang">
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ListBarang as $b) : ?>
                <tr>
                  <td><?php echo $b->Kode_Barang ?></td>
                  <td><?php echo $b->Nama_Barang ?></td>
                  <td><?php echo $b->Harga_Beli ?></td>
                  <td><?php echo $b->Quantity ?></td>
                  <td align="center">
                    <button class="btn btn-secondary btn-sm btnPilih" title="Pilih Barang"><i class="fas fa-check"></i></button>
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

<div class="modal fade" id="modalReq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftar Permintaan Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="t_req" style="width:100%">
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th></th>
                <th class="sembunyi">Id</th>
                <th class="sembunyi">Kode Req</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ListReq as $r) : ?>
                <tr>
                  <td><?php echo $r->Kode_Barang ?></td>
                  <td><?php echo $r->Nama_Barang ?></td>
                  <td><?php echo $r->Harga_Barang ?></td>
                  <td><?php echo $r->Jumlah ?></td>
                  <td align="center">
                    <button class="btn btn-secondary btn-sm btnPilihReq" title="Pilih Barang"><i class="fas fa-check"></i></button>
                  </td>
                  <td class="sembunyi"><?php echo $r->id_req ?></td>
                  <td class="sembunyi"><?php echo $r->kode_req ?></td>
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
    var total = 0;
    var id_order = "<?php echo $order->Kode_Order ?>";
    var id_req = null;
    var kode_req = null;
    $('[name=KodeSupplier]').select2();

    $(document).on('click', '#btnReq', function() {
      if ($('[name=KodeSupplier]').val() == null) {
        Swal.fire({
          title: '',
          text: "Pilih Supplier terlebih dahulu!",
          type: 'error',
          closeOnConfirm: true,
        });
      } else {
        $('#modalReq').modal('show');
      }
    });

    var tabel = $('#t_temp').DataTable({
      columnDefs: [{
        targets: [2, 4],
        render: $.fn.dataTable.render.number('.', ',', '', 'Rp ')
      }],
      rowCallback: function(row, data, iDisplayIndex) {
        $('td:eq(6)', row).addClass('sembunyi');
        $('td:eq(7)', row).addClass('sembunyi');
      },
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

    var tabelbarang = $('#t_barang').DataTable({
      columnDefs: [{
        targets: [2],
        render: $.fn.dataTable.render.number('.', ',', '', 'Rp ')
      }],
    });

    var tabelrequest = $('#t_req').DataTable({
      columnDefs: [{
        targets: [2],
        render: $.fn.dataTable.render.number('.', ',', '', 'Rp ')
      }],
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
        btnaction,
        dataDetil[index].id_detil_req,
        dataDetil[index].kode_req,
      ]).draw();
    }

    $(document).on('click', '[name=KodeBarang]', function() {
      if ($('[name=KodeSupplier]').val() == null) {
        Swal.fire({
          title: '',
          text: "Pilih Supplier terlebih dahulu!",
          type: 'error',
          closeOnConfirm: true,
        });
      } else {
        $('#modalBarang').modal('show');
      }
    });

    $('[name=KodeSupplier]').on('select2:select', function(e) {
      $.ajax({
        url: "<?php echo base_url('c_order/getSupplierData') ?>",
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


      $.ajax({
        url: "<?php echo base_url('c_order/getBarang') ?>",
        method: "POST",
        type: "POST",
        dataType: "JSON",
        data: {
          id: $(this).val()
        },
        success: function(respon) {
          tabelbarang.clear().draw();
          for (let index = 0; index < respon.length; index++) {
            var rowadd = tabelbarang.row.add([
              respon[index].Kode_Barang,
              respon[index].Nama_Barang,
              respon[index].Harga_Beli,
              respon[index].Quantity,
              '<button class="btn btn-secondary btn-sm btnPilih" title="Pilih Barang"><i class="fas fa-check"></i></button>'
            ]).draw();
            tabelbarang.row(rowadd).column(4).nodes().to$().addClass('text-center');
          }
        }
      });

      $.ajax({
        url: "<?php echo base_url('c_order/getReq') ?>",
        method: "POST",
        type: "POST",
        dataType: "JSON",
        data: {
          id: $(this).val()
        },
        success: function(respon) {
          tabelrequest.clear().draw();
          for (let index = 0; index < respon.length; index++) {
            var rowadd = tabelrequest.row.add([
              respon[index].Kode_Barang,
              respon[index].Nama_Barang,
              respon[index].Harga_Barang,
              respon[index].Jumlah,
              '<button class="btn btn-secondary btn-sm btnPilihReq" title="Pilih Barang"><i class="fas fa-check"></i></button>',
              respon[index].id_req,
              respon[index].kode_req,
            ]).draw();
            tabelrequest.row(rowadd).column(4).nodes().to$().addClass('text-center');
            tabelrequest.row(rowadd).column(5).nodes().to$().addClass('sembunyi');
            tabelrequest.row(rowadd).column(6).nodes().to$().addClass('sembunyi');
          }
        }
      });
    });

    $(document).on('click', '.btnPilih', function() {
      var tb = tabelbarang.row($(this).parents('tr')).data();
      $('[name=KodeBarang]').val(tb[0]);
      $('[name=NamaBarang]').val(tb[1]);
      $('[name=HargaBarang]').val(tb[2]);
      // $('[name=Quantity]').val(tb[3]);
      $('#modalBarang').modal('hide');
    });

    $(document).on('click', '.btnPilihReq', function() {
      var tb = tabelrequest.row($(this).parents('tr')).data();
      $('[name=KodeBarang]').val(tb[0]);
      $('[name=NamaBarang]').val(tb[1]);
      $('[name=HargaBarang]').val(tb[2]);
      $('[name=Quantity]').val(tb[3]);
      id_req = tb[5];
      kode_req = tb[6];
      $('#modalReq').modal('hide');
    });

    $(document).on('click', '#btnAdd', function(e) {
      e.preventDefault();
      let _data = {
        KodeBarang: $('[name=KodeBarang]').val(),
        NamaBarang: $('[name=NamaBarang]').val(),
        HargaBarang: $('[name=HargaBarang]').val(),
        Quantity: $('[name=Quantity]').val(),
      };

      $.ajax({
        url: "<?php echo base_url('c_order/addBarang') ?>",
        method: "POST",
        dataType: "JSON",
        data: _data,
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
              newSub = parseFloat($('[name=HargaBarang]').val()) * parseFloat(newqQty);
              tabel.cell(row_id, 3).data(newqQty).draw();
              tabel.cell(row_id, 4).data(newSub).draw();
              tabel.cell(row_id, 6).data(id_req).draw();
              tabel.cell(row_id, 7).data(kode_req).draw();
            } else {
              tabel.row.add([
                $('[name=KodeBarang]').val(),
                $('[name=NamaBarang]').val(),
                $('[name=HargaBarang]').val(),
                $('[name=Quantity]').val(),
                parseFloat($('[name=HargaBarang]').val()) * parseFloat($('[name=Quantity]').val()),
                btnaction,
                id_req,
                kode_req
              ]).draw();
            }
            $('[name=KodeBarang]').val('');
            $('[name=NamaBarang]').val('');
            $('[name=HargaBarang]').val('');
            $('[name=Quantity]').val('');
            id_req = null;
            kode_req = null;
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
      $('[name=KodeBarang]').val(tb[0]);
      $('[name=NamaBarang]').val(tb[1]);
      $('[name=HargaBarang]').val(tb[2]);
      $('[name=Quantity]').val(tb[3]);
      tr = $(this).closest('tr');
      tabel.row(tr).remove().draw();
    });

    $('#btnSave').on('click', function() {
      $.ajax({
        url: "<?php echo base_url() . 'c_order/updateOrder/' ?>" + id_order,
        method: "POST",
        dataType: "JSON",
        data: {
          Kode: $('[name=KodeOrder]').val(),
          KodeSupplier: $('[name=KodeSupplier]').val(),
          NamaSupplier: $('[name=NamaSupplier]').val(),
          Total: total,
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
              title: 'Order barang berhasil.'
            }).then((result) => {
              window.location = "<?php echo base_url() . 'c_order/index' ?>";
            });
          }
        }

      });
    });

  });
</script>