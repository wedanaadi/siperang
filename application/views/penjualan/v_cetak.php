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
      <td colspan="2" align="center" style="font-size:14px;"> <strong> List Transaksi </strong> </td>
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
      <th>Kode Transaksi</th>
      <th>Tanggal Transaksi</th>
      <th>Total</th>
      <th>Status</th>
      <th>DP</th>
      <th>Tanggal Jatuh Tempo</th>
      <th>Tanggal Pelunasan</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($konten as $trx) : ?>
      <tr>
        <td style="width: 20%"><?php echo $trx->Kode_Transaksi ?></td>
        <td style="width: 10%"><?php echo $trx->Tanggal_Transaksi ?></td>
        <td><?php echo  'Rp. ' . number_format($trx->Total, 0, '.', '.') ?></td>
        <td class="text-center"><?php echo $trx->StatusTransaksi == '1' ? '<div class="badge badge-success">LUNAS</div>' : '<div class="badge badge-warning">BELUM LUNAS</div>' ?></td>
        <td><?php echo  'Rp. ' . number_format($trx->DP, 0, '.', '.') ?></td>
        <td style="width: 10%"><?php echo $trx->StatusTransaksi == '1' ? '-' : $trx->Tanggal_JatuhTempo ?></td>
        <td style="width: 10%"><?php echo $trx->StatusTransaksi == '1' ? '-' : $trx->Tanggal_Pelunasan ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>