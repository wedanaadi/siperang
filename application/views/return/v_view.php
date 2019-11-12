<div class="content">
  <div class="content-fluid">
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#datapenjualan" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Barang Masuk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#datareturn" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Return Barang</a>
      </li>
    </ul>

    <div class="tab-content" id="custom-content-below-tabContent">
      <div class="tab-pane fade show active" id="datapenjualan" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Barang Masuk</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="t_listpenjualan" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Kode Barang Masuk</th>
                    <th>Kode Order</th>
                    <th>Tanggal</th>
                    <th>Supplier</th>
                    <th>Total</th>
                    <th style="width: 15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listBarangMasuk as $key => $BarangMasuk) : ?>
                    <tr>
                      <td><?php echo $BarangMasuk->Kode_BarangMasuk ?></td>
                      <td><?php echo $BarangMasuk->Kode_Order ?></td>
                      <td><?php echo $BarangMasuk->Tanggal ?></td>
                      <td><?php echo $BarangMasuk->Nama_Supplier ?></td>
                      <td><?php echo 'Rp. ' . number_format($BarangMasuk->Total, 0, '.', '.') ?></td>
                      <td>
                        <center>
                          <a href="<?php echo base_url() . 'c_returnbarang/tambahReturn/' . $BarangMasuk->Kode_BarangMasuk ?>" class="btn btn-warning btn-sm" title="Return Barang"><i class="fas fa-reply"></i></a>
                          <button id-barangmasuk="<?php echo $BarangMasuk->Kode_BarangMasuk ?>" class="btn btn-secondary btn-sm btnDetil" title="Detil Barang Masuk"><i class="fas fa-eye"></i></button>
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

      <div class="tab-pane fade" id="datareturn" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Return Barang</h3>
            <div class="card-tools">
              <a href="<?php echo base_url() . 'c_returnbarang/tambahReturn' ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
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
              <table id="t_return" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Kode Return</th>
                    <th>Kode Barang Masuk</th>
                    <th>Supplier</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th style="width: 15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listReturn as $r) : ?>
                    <tr>
                      <td><?php echo $r->Kode_Return ?></td>
                      <td><?php echo $r->Kode_Barang_Masuk ?></td>
                      <td><?php echo $r->Nama_Supplier ?></td>
                      <td><?php echo $r->Total ?></td>
                      <td><?php echo $r->Tanggal ?></td>
                      <td align="center">
                        <a href="<?php echo base_url() . 'c_returnbarang/editReturn/' . $r->Kode_Return ?>" class="btn btn-warning btn-sm" title="Ubah Request"><i class="fas fa-pencil-alt"></i></a>
                        <button id-return="<?php echo $r->Kode_Return ?>" class="btn btn-secondary btn-sm btnDetilReturn" title="Detil Request"><i class="fas fa-eye"></i></button>
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
            <h5 class="modal-title" id="exampleModalLabel">Detil Trx</h5>
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
  </div>
</div>

<script>
  $(function() {
    $('#t_listpenjualan').DataTable({
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

    let kode_barangmasuk = null;

    $(document).on('click', '.btnDetil', function(e) {
      kode_barangmasuk = $(this).attr('id-barangmasuk');
      $.ajax({
        url: "<?php echo base_url() . 'c_barangmasuk/detil/' ?>" + kode_barangmasuk,
        method: "POST",
        dataType: "JSON",
        success: function(respon) {
          detil.clear().draw();
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

    // bagian lain

    $('[name=NamaSupplier]').select2();

    $('[name=Tanggal]').datepicker({
      format: 'yyyy/mm/dd',
      endDate: new Date,
      autoclose: true
    });

    var tabel = $('#t_return').DataTable({
      columnDefs: [{
        targets: [3],
        render: $.fn.dataTable.render.number('.', ',', '', 'Rp ')
      }],
    });

    let kode_return = null;

    $(document).on('click', '.btnDetilReturn', function(e) {
      kode_return = $(this).attr('id-return');
      $.ajax({
        url: "<?php echo base_url() . 'c_returnbarang/detil/' ?>" + kode_return,
        method: "POST",
        dataType: "JSON",
        success: function(respon) {
          detil.clear().draw();
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
        url: "<?php echo base_url() . 'c_returnbarang/getReturnJson' ?>",
        method: "POST",
        dataType: "JSON",
        data: {
          Tanggal: $('[name=Tanggal]').val(),
          Supplier: $('[name=NamaSupplier]').val()
        },
        success: function(respon) {
          if (respon.length > 0) {
            for (let index = 0; index < respon.length; index++) {
              var btnAct = '<a href="<?php echo base_url() . "c_returnbarang/editReturn/" ?>' + respon[index].Kode_Return + '" class="btn btn-warning btn-sm" title="Ubah Request"><i class="fas fa-pencil-alt"></i></a> ';
              btnAct += '<button id-return="' + respon[index].Kode_Return + '" class="btn btn-secondary btn-sm btnDetil" title="Detil Request"><i class="fas fa-eye"></i></button>';
              var rowadd = tabel.row.add([
                respon[index].Kode_Return,
                respon[index].Nama_Supplier,
                respon[index].Total,
                respon[index].Tanggal,
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
        url: "<?php echo base_url() . 'c_returnbarang/getReturnJson' ?>",
        method: "POST",
        dataType: "JSON",
        data: {
          Tanggal: $('[name=Tanggal]').val(),
          Supplier: $('[name=NamaSupplier]').val()
        },
        success: function(respon) {
          if (respon.length > 0) {
            for (let index = 0; index < respon.length; index++) {
              var btnAct = '<a href="<?php echo base_url() . "c_returnbarang/editReturn/" ?>' + respon[index].Kode_Return + '" class="btn btn-warning btn-sm" title="Ubah Request"><i class="fas fa-pencil-alt"></i></a> ';
              btnAct += '<button id-return="' + respon[index].Kode_Return + '" class="btn btn-secondary btn-sm btnDetil" title="Detil Request"><i class="fas fa-eye"></i></button>';
              var rowadd = tabel.row.add([
                respon[index].Kode_Return,
                respon[index].Nama_Supplier,
                respon[index].Total,
                respon[index].Tanggal,
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