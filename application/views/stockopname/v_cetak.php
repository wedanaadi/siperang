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
      <td colspan="2" align="center" style="font-size:14px;"> <strong> Stock Opname </strong> </td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="font-size:8px;"> <strong> Tanggal: </strong> <?php echo $start ?> </td>
    </tr>
    <tr>
      <td colspan="2" align="left">&nbsp;</td>
    </tr>
  </table>
</div>

<table id="TabelKonten" border="1" style="border-collapse: collapse; border-color: #000; margin-bottom : 130px;" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Barang</th>
      <th>Nama barang</th>
      <th style="width: 15%">Harga</th>
      <th>Quantity</th>
      <th>Input Stok</th>
      <th>Selisih</th>
      <th style="width: 15%">Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($konten as $key => $trx) : ?>
      <tr>
        <td style="width: 5%"><?php echo $key + 1 ?></td>
        <td style="width: 15%"><?php echo $trx->Kode_Barang ?></td>
        <td style="width: 20%"><?php echo $trx->Nama_Barang ?></td>
        <td><?php echo  'Rp. ' . number_format($trx->Harga, 0, '.', '.') ?></td>
        <td style="width: 9%"><?php echo $trx->Quantity ?></td>
        <td style="width: 9%"><?php echo $trx->Input_Stok ?></td>
        <td style="width: 9%"><?php echo $trx->Selisih ?></td>
        <td><?php echo  'Rp. ' . number_format($trx->Subtotal, 0, '.', '.') ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>