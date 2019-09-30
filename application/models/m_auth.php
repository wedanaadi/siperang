<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
  function dataUser()
  {
    $query  =  "SELECT * FROM tbl_user
                INNER JOIN tbl_bagian ON `tbl_bagian`.Kode_bagian = `tbl_user`.Bagian";
    return $this->db->query($query)->result();
  }

  function dataBagianAkses()
  {
    $query = "SELECT * FROM tbl_bagian";
    return $this->db->query($query)->result();
  }

  function insertBagian($data)
  {
    $this->db->insert('tbl_bagian', $data);
  }

  function cariBagian($id)
  {
    return $this->db->query("SELECT * FROM tbl_bagian WHERE Kode_bagian = '$id'")->row();
  }

  function updateBagian($data, $id)
  {
    $this->db->where('Kode_bagian', $id);
    $this->db->update('tbl_bagian', $data);
  }

  function deleteBagian($id)
  {
    $this->db->where('Kode_bagian', $id);
    $this->db->delete('tbl_bagian');
  }

  function insertUser($data)
  {
    $this->db->insert('tbl_user', $data);
  }

  function cariUser($id)
  {
    return $this->db->query("SELECT * FROM tbl_user WHERE Kode_User = '$id'")->row();
  }

  function updateUser($data, $id)
  {
    $this->db->where('Kode_User', $id);
    $this->db->update('tbl_user', $data);
  }

  function deleteUser($id)
  {
    $this->db->where('Kode_User', $id);
    $this->db->delete('tbl_user');
  }

  function cekUsername($username)
  {
    return $this->db->query("SELECT * FROM tbl_user WHERE Username='$username'")->row();
  }
}

/* End of file M_auth.php */
