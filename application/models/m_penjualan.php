<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_penjualan extends CI_Model
{
  function dataPenjualan()
  {
    return $this->db->query("SELECT * FROM `t_transaksipenjualan` WHERE CONCAT(YEAR(`Tanggal_Transaksi`),'/',MONTH(`Tanggal_Transaksi`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW()))
                            UNION
                            SELECT * FROM `t_transaksipenjualan` WHERE CONCAT(YEAR(`Tanggal_Transaksi`),'/',MONTH(`Tanggal_Transaksi`)) != CONCAT(YEAR(NOW()),'/',MONTH(NOW())) AND `StatusTransaksi` = '2'")->result();
  }

  function dataPenjualanjson($tanggalawal, $tanggalakhir)
  {
    return $this->db->query("SELECT * FROM `t_transaksipenjualan` WHERE DATE_FORMAT(`Tanggal_Transaksi`, '%Y-%m-%d') BETWEEN '$tanggalawal' AND '$tanggalakhir'
    UNION
    SELECT * FROM `t_transaksipenjualan` WHERE DATE_FORMAT(`Tanggal_Transaksi`, '%Y-%m-%d') BETWEEN '$tanggalawal' AND '$tanggalakhir'")->result();
  }

  function updatePelunasan($data, $id)
  {
    $this->db->where('Kode_Transaksi', $id);
    $this->db->update('t_transaksipenjualan', $data);
  }

  function prosesInsertTrx($barang, $data, $detil)
  {
    $this->db->trans_start();
    $this->db->insert('t_transaksipenjualan', $data);
    $this->db->insert_batch('t_transaksipenjualan_detil', $detil);
    $this->db->update_batch('tbl_databarang', $barang, 'Kode_Barang');
    $this->db->trans_complete();
  }

  function prosesUpdateTrx($id, $barang, $data, $detil)
  {
    $this->db->trans_start();
    $this->db->where('Kode_Transaksi', $id);
    $this->db->update('t_transaksipenjualan', $data);

    $this->db->where('Kode_Transaksi', $id);
    $this->db->delete('t_transaksipenjualan_detil');

    $this->db->insert_batch('t_transaksipenjualan_detil', $detil);
    $this->db->update_batch('tbl_databarang', $barang, 'Kode_Barang');
    $this->db->trans_complete();
  }

  function updateStokOld($data)
  {
    return $this->db->update_batch('tbl_databarang', $data, 'Kode_Barang');
  }

  function kode_otomatis()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(Kode_Transaksi,5)) AS kd_max FROM t_transaksipenjualan");
    $kd = "";
    if ($q->num_rows() > 0) {
      foreach ($q->result() as $k) {
        $tmp = ((int)$k->kd_max) + 1;
        $kd = sprintf("%05s", $tmp);
      }
    } else {
      $kd = "00001";
    }
    $kodemax = str_pad($kd, 5, "0", STR_PAD_LEFT);
    $kodejadi  = "TS" . time() . $kodemax;
    return $kodejadi;
  }

  function detil($id)
  {
    $this->db->where('Kode_Transaksi', $id);
    return $this->db->get('t_transaksipenjualan_detil')->result();
  }

  function cariTrx($id)
  {
    $this->db->where('Kode_Transaksi', $id);
    $this->db->select('*,DATE_FORMAT(Tanggal_JatuhTempo, "%Y/%m/%d") AS date_format');
    return $this->db->get('t_transaksipenjualan')->row();
  }

  function cariDetilTrx($id)
  {
    $this->db->where('Kode_Transaksi', $id);
    return $this->db->get('t_transaksipenjualan_detil')->result();
  }

  function dataLaporan()
  {
    return $this->db->query("SELECT `t_transaksipenjualan`.`Kode_Transaksi`, `t_transaksipenjualan`.`Tanggal_Transaksi`, `tbl_databarang`.`Nama_Barang`,
    tbl_databarang.`Harga_Beli`,tbl_databarang.`Harga_Jual`, `t_transaksipenjualan_detil`.`Quantity`, 
    ((tbl_databarang.`Harga_Jual`-tbl_databarang.`Harga_Beli`)*`t_transaksipenjualan_detil`.`Quantity`) AS 'Untung'
    FROM `t_transaksipenjualan_detil`
    INNER JOIN `tbl_databarang` ON `tbl_databarang`.`Kode_Barang` = `t_transaksipenjualan_detil`.`Kode_Barang`
    INNER JOIN `t_transaksipenjualan` ON `t_transaksipenjualan`.`Kode_Transaksi` = `t_transaksipenjualan_detil`.`Kode_Transaksi`
    WHERE CONCAT(YEAR(`t_transaksipenjualan`.`Tanggal_Transaksi`),'/',MONTH(`t_transaksipenjualan`.`Tanggal_Transaksi`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW()))")->result();
  }

  function dataLaporanJSON($tanggalawal, $tanggalakhir)
  {
    return $this->db->query("SELECT `t_transaksipenjualan`.`Kode_Transaksi`, `t_transaksipenjualan`.`Tanggal_Transaksi`, `tbl_databarang`.`Nama_Barang`,
    tbl_databarang.`Harga_Beli`,tbl_databarang.`Harga_Jual`, `t_transaksipenjualan_detil`.`Quantity`, 
    ((tbl_databarang.`Harga_Jual`-tbl_databarang.`Harga_Beli`)*`t_transaksipenjualan_detil`.`Quantity`) AS 'Untung'
    FROM `t_transaksipenjualan_detil`
    INNER JOIN `tbl_databarang` ON `tbl_databarang`.`Kode_Barang` = `t_transaksipenjualan_detil`.`Kode_Barang`
    INNER JOIN `t_transaksipenjualan` ON `t_transaksipenjualan`.`Kode_Transaksi` = `t_transaksipenjualan_detil`.`Kode_Transaksi`
    WHERE DATE_FORMAT(`t_transaksipenjualan`.`Tanggal_Transaksi`, '%Y-%m-%d') BETWEEN '$tanggalawal' AND '$tanggalakhir'")->result();
  }

  function getTotal()
  {
    return $this->db->query("SELECT SUM(Total) AS 'total' FROM `t_transaksipenjualan` 
    WHERE CONCAT(YEAR(`Tanggal_Transaksi`),'/',MONTH(`Tanggal_Transaksi`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW()))")->row();
  }

  function dataTrxPilihJSON($id)
  {
    $this->db->where('Kode_Transaksi', $id);
    return $this->db->get('t_transaksipenjualan')->row();
  }

  function dataDetilTrxPilihJSON($id)
  {
    $this->db->where('Kode_Transaksi', $id);
    return $this->db->get('t_transaksipenjualan_detil')->result();
  }

  function getBarangTerlaris($awal, $akhir)
  {
    $sql  = "SELECT SUM(`t_transaksipenjualan_detil`.`Quantity`) AS 'jumlah', `t_transaksipenjualan_detil`.`Nama_Barang`, `t_transaksipenjualan_detil`.`Kode_Barang`  FROM `t_transaksipenjualan`
            INNER JOIN `t_transaksipenjualan_detil` ON `t_transaksipenjualan_detil`.`Kode_Transaksi` = `t_transaksipenjualan`.`Kode_Transaksi`
            WHERE DATE_FORMAT(`t_transaksipenjualan`.`Tanggal_Transaksi`, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'
            GROUP BY `t_transaksipenjualan_detil`.`Kode_Barang`
            ORDER BY jumlah DESC";
    return $this->db->query($sql)->result();
  }

  function getBarangTerlarischart()
  {
    $sql  = "SELECT SUM(`t_transaksipenjualan_detil`.`Quantity`) AS 'jumlah', `t_transaksipenjualan_detil`.`Nama_Barang`, `t_transaksipenjualan_detil`.`Kode_Barang`  FROM `t_transaksipenjualan`
            INNER JOIN `t_transaksipenjualan_detil` ON `t_transaksipenjualan_detil`.`Kode_Transaksi` = `t_transaksipenjualan`.`Kode_Transaksi`
            WHERE CONCAT(YEAR(`t_transaksipenjualan`.`Tanggal_Transaksi`),'/',MONTH(`t_transaksipenjualan`.`Tanggal_Transaksi`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW()))
            GROUP BY `t_transaksipenjualan_detil`.`Kode_Barang`
            ORDER BY jumlah DESC
            LIMIT 5";
    return $this->db->query($sql)->result();
  }
}

/* End of file M_penjualan.php */
