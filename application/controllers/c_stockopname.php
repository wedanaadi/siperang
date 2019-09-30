<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_stockopname extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(['m_barang', 'm_stockopname']);
    $this->load->library(['create_pdf']);
    is_login();
  }

  public function index()
  {
    $template['title'] = 'siperang | STOCK OPNAME';
    $data['listBarang'] = $this->m_barang->dataBarang();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('stockopname/v_so', $data);
    $this->load->view('template/v_foot');
  }

  public function insertSO()
  {
    $hitung = 0;
    for ($i = 0; $i < count($this->input->post('inputStok')); $i++) {
      $selisih = $this->input->post('stok')[$i] - $this->input->post('inputStok')[$i];
      if ($selisih > 0) {
        $status = 1; // SO OUT, 
      } else {
        $status = 0;
      }

      $dataBarang[] = [
        'Kode_Barang' => $this->input->post('kodeBarang')[$i],
        'Quantity' => $this->input->post('inputStok')[$i],
      ];

      $dataSO[] = [
        'id' => generate_token(5) . time(),
        'Kode_Barang' => $this->input->post('kodeBarang')[$i],
        'Nama_Barang' => $this->input->post('namaBarang')[$i],
        'Quantity' => $this->input->post('stok')[$i],
        'Harga' => $this->input->post('hargaBeli')[$i],
        'Selisih' => abs($selisih),
        'Input_Stok' => $this->input->post('inputStok')[$i],
        'Tanggal' => date('Y-m-d'),
        'status' => $status
      ];
      $hitung++;
    }

    if ($hitung == 0) {
      echo json_encode(['is_error' => true]);
    } else {
      $this->m_stockopname->prosesInsert($dataSO, $dataBarang);
      echo json_encode(['success' => true]);
    }
  }

  public function laporan()
  {
    $template['title'] = 'siperang | LAPORAN STOCK OPNAME';
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('stockopname/v_laporan_so');
    $this->load->view('template/v_foot');
  }

  public function cetakHeader()
  {
    $data = $this->load->view('template/v_template_report', null, true);
    return $data;
  }

  public function cetakLaporan($start)
  {
    $data['header'] = $this->cetakHeader();
    $data['konten'] = $this->m_stockopname->dataStockOpname($start);
    $data['start'] = $start;
    $html = $this->load->view('stockopname/v_cetak', $data, TRUE);
    $this->create_pdf->load($html, 'Stock Opname', 'A4-L');
  }
}

/* End of file C_stockopname.php */
