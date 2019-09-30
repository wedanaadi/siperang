<div class="content">
  <div class="content-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Barang Masuk</h3>
        <div class="card-tools">
          <a href="<?php echo base_url() . 'c_barang/tambahBarang' ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
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
                    <select name="NamaSupplier" id="formSupplier" class="form-control">
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
          <table id="t_barangmasuk" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Quantity</th>
                <th>Harga</th>
                <th>Total</th>
                <th style="width: 15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listBarangMasuk as $key => $BarangMasuk) : ?>
                <tr>
                  <td><?php echo $BarangMasuk->Kode_Barang ?></td>
                  <td><?php echo ucwords($BarangMasuk->Nama_Barang) ?></td>
                  <td><?php echo 'Rp. ' . number_format($BarangMasuk->Harga_Jual, 0, '.', '.') ?></td>
                  <td><?php echo 'Rp. ' . number_format($BarangMasuk->Harga_Beli, 0, '.', '.') ?></td>
                  <td><?php echo $BarangMasuk->Quantity ?></td>
                  <td>
                    <center>
                      <a href="<?php echo base_url() . 'c_barang/editBarang/' . $BarangMasuk->Kode_Barang ?>">Edit</a>
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
    $('#t_barangmasuk').DataTable();
  })
</script>