<?php echo $header ?>
<style type="text/css">
  #TabelKonten tr td {
    padding-right: 7px;
    padding-left: 7px;
    font-size: 11px;
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
      <td colspan="2" align="center" style="font-size:8px;"> <strong> Tanggal: </strong> <?php echo $trx->Tanggal_Transaksi ?> </td>
    </tr>
    <tr>
      <td colspan="2" align="left">&nbsp;</td>
    </tr>
  </table>
</div>

<div style="margin-buttom : 15px;">
  <table border="0">
    <tr>
      <td>Status Transaksi</td>
      <td>:</td>
      <td><?php echo $trx->StatusTransaksi == 1 ? 'LUNAS' : 'BELUM LUNAS' ?></td>
    </tr>
    <?php if ($trx->StatusTransaksi == 2) : ?>
      <tr>
        <td>DP</td>
        <td>:</td>
        <td><?php echo  'Rp. ' . number_format($trx->DP, 0, '.', '.') ?></td>
      </tr>
      <tr>
        <td>Tanggal Jatuh Tempo</td>
        <td>:</td>
        <td><?php echo  $trx->Tanggal_JatuhTempo ?></td>
      </tr>
      <tr>
        <td>Tunggakan</td>
        <td>:</td>
        <td><?php echo  'Rp. ' . number_format($trx->Sisa, 0, '.', '.') ?></td>
      </tr>
    <?php endif; ?>
    <tr>
      <td colspan="3" align="left">&nbsp;</td>
    </tr>
  </table>
</div>

<table id="TabelKonten" border="1" style="border-collapse: collapse; border-color: #000; margin-bottom : 130px;" width="100%">
  <thead>
    <tr>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Harga Barang</th>
      <th>Quantity</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php $hj = 0;
    foreach ($trxDetil as $trx) : ?>
      <tr>
        <td><?php echo $trx->Kode_Barang ?></td>
        <td><?php echo $trx->Nama_Barang ?></td>
        <td><?php echo  'Rp. ' . number_format($trx->Harga_Barang, 0, '.', '.') ?></td>
        <td><?php echo $trx->Quantity ?></td>
        <td><?php echo  'Rp. ' . number_format($trx->Subtotal, 0, '.', '.') ?></td>
      </tr>
      <?php $hj += $trx->Subtotal;
    endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4"><strong>Total</strong></td>
      <td><?php echo  'Rp. ' . number_format($hj, 0, '.', '.') ?></td>
    </tr>
  </tfoot>
</table>