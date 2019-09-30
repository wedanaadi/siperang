<?php echo $header ?>
<style type="text/css">
  #TabelKonten tr td {
    padding-right: 7px;
    padding-left: 7px;
    font-size: 15px;
  }

  tr.noBorder td {
    border: 0;
  }
</style>

<div style="margin-buttom : 15px;">
  <table width="100%" border="0">
    <tr>
      <td colspan="2" align="center" style="font-size:14px;"> <strong> Laporan Transaksi </strong> </td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="font-size:8px;"> <strong> Tanggal: </strong> <?php echo $start . ' - ' . $end ?> </td>
    </tr>
    <tr>
      <td colspan="2" align="left">&nbsp;</td>
    </tr>
  </table>
</div>

<table id="TabelKonten" border="1" style="border-collapse: collapse; border-color: #000; margin-bottom : 130px;" width="100%">
  <thead>
    <tr>
      <th>Tanggal</th>
      <th>Kode Trx</th>
      <th>Nama Barang</th>
      <th>Harga Beli</th>
      <th>Harga Jual</th>
      <th>Quantity</th>
      <th>Untung</th>
    </tr>
  </thead>
  <tbody>
    <?php $hj = 0;
    $untung = 0;
    $quantity = 0;
    foreach ($konten as $trx) : ?>
      <tr>
        <td><?php echo $trx->Tanggal_Transaksi ?></td>
        <td><?php echo $trx->Kode_Transaksi ?></td>
        <td><?php echo $trx->Nama_Barang ?></td>
        <td><?php echo  'Rp. ' . number_format($trx->Harga_Beli, 0, '.', '.') ?></td>
        <td><?php echo  'Rp. ' . number_format($trx->Harga_Jual, 0, '.', '.') ?></td>
        <td><?php echo $trx->Quantity ?></td>
        <td><?php echo  'Rp. ' . number_format($trx->Untung, 0, '.', '.') ?></td>
      </tr>
      <?php $hj += $trx->Harga_Jual;
      $untung += $trx->Untung;
      $quantity += $trx->Quantity;
    endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4" class="text-center">Total Omset Penjualan</td>
      <td><?php echo  'Rp. ' . number_format($hj, 0, '.', '.') ?></td>
      <td><?php echo $quantity ?></td>
      <td><?php echo  'Rp. ' . number_format($untung, 0, '.', '.') ?></td>
    </tr>
  </tfoot>
</table>