<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_order extends CI_Model
{
  function dataOrder($tanggal, $supplier = null)
  {
    $this->db->from('t_order');
    $this->db->join('tbl_supplier', 'tbl_supplier.Kode_Supplier = t_order.Supplier');
    $this->db->where('DATE_FORMAT(`Tanggal_Order`,"%Y-%m-%d") = DATE_FORMAT("' . $tanggal . '","%Y-%m-%d")', null, false);
    if ($supplier != null) {
      $this->db->where('`t_order`.Supplier', $supplier);
    }
    $this->db->select('t_order.*, tbl_supplier.Nama_Supplier');
    return $this->db->get()->result();
  }

  function kode_otomatis()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(Kode_Order,5)) AS kd_max FROM t_order");
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
    $kodejadi  = "OR" . time() . $kodemax;
    return $kodejadi;
  }

  function prosesInsert($data, $detil, $req_id, $kode_req)
  {
    $this->db->trans_start();
    $this->db->insert('t_order', $data);
    $this->db->insert_batch('t_order_detil', $detil);
    $this->db->update_batch('t_requestbarang_detil', $req_id, 'id');
    $this->db->update_batch('t_requestbarang', $kode_req, 'Kode_Request');
    $this->db->trans_complete();
  }

  function detil($id)
  {
    $this->db->where('Kode_Order', $id);
    return $this->db->get('t_order_detil')->result();
  }

  function cariOrder($id)
  {
    $this->db->where('Kode_Order', $id);
    $this->db->select('*');
    return $this->db->get('t_order')->row();
  }

  function cariDetilOrder($id)
  {
    $this->db->where('Kode_Order', $id);
    return $this->db->get('t_order_detil')->result();
  }

  function prosesUpdate($data, $detil, $req_id, $kode_req, $id, $id_old, $kode_old)
  {
    $this->db->trans_start();

    $this->db->where('Kode_Order', $id);
    $this->db->update('t_order', $data);

    $this->db->where('Kode_Order', $id);
    $this->db->delete('t_order_detil');

    $this->db->update_batch('t_requestbarang_detil', $id_old, 'id');
    $this->db->update_batch('t_requestbarang', $kode_old, 'Kode_Request');

    $this->db->insert_batch('t_order_detil', $detil);
    $this->db->update_batch('t_requestbarang_detil', $req_id, 'id');
    $this->db->update_batch('t_requestbarang', $kode_req, 'Kode_Request');
    $this->db->trans_complete();
  }

  function getListOrderForBarangMasuk()
  {
    $this->db->where('isStatus', 0);
    $this->db->join('tbl_supplier', 'tbl_supplier.Kode_Supplier = t_order.Supplier');
    $this->db->select('t_order.*, tbl_supplier.Nama_Supplier');
    return $this->db->get('t_order')->result();
  }

  function listBarangOrder($id)
  {
    $this->db->where('Kode_Order', $id);
    return $this->db->get('t_order_detil')->result();
  }

  function cariDetilBarang($idOrder, $idBarang)
  {
    $this->db->where(['Kode_Order' => $idOrder, 'Kode_Barang' => $idBarang]);
    return $this->db->get('t_order_detil')->row();
  }

  function getSupplierData($id)
  {
    $this->db->where('Kode_Order', $id);
    $this->db->from('t_order');
    $this->db->join('tbl_supplier', 'tbl_supplier.Kode_Supplier = t_order.Supplier');
    $this->db->select('tbl_supplier.*');
    return $this->db->get()->row();
  }

  public function getTotal()
  {
    return $this->db->query("SELECT COUNT('Kode_Order') as 'total' FROM t_order WHERE CONCAT(YEAR(`Tanggal_Order`),'/',MONTH(`Tanggal_Order`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW())) ")->row();
  }

  public function getTotalChart()
  {
    return $this->db->query("SELECT `Tanggal_Order`, COUNT('Kode_Order') AS 'total', DAY(`Tanggal_Order`) AS 'date' FROM t_order 
    WHERE CONCAT(YEAR(`Tanggal_Order`),'/',MONTH(`Tanggal_Order`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW()))
    GROUP BY `Tanggal_Order`")->result();
  }
}

/* End of file M_order.php */
