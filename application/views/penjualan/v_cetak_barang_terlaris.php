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
      <td colspan="2" align="center" style="font-size:14px;"> <strong> Laporan Barang Terlaris </strong> </td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="font-size:10px;"> <strong> Tanggal: </strong> <?php echo $start . ' - ' . $end ?> </td>
    </tr>
    <tr>
      <td colspan="2" align="left">&nbsp;</td>
    </tr>
  </table>
</div>

<table id="TabelKonten" border="1" style="border-collapse: collapse; border-color: #000; margin-bottom : 130px;" width="100%">
  <thead>
    <tr>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Quantity</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($konten as $trx) : ?>
      <tr>
        <td style="width: 20%"><?php echo $trx->Kode_Barang ?></td>
        <td><?php echo $trx->Nama_Barang ?></td>
        <td style="text-align:center; width: 13%"><?php echo $trx->jumlah ?></td>
      </tr>
    <?php
  endforeach; ?>
  </tbody>
</table>