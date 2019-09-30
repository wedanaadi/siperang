<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_request extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(['m_request', 'm_barang']);
    is_login();
  }

  public function index()
  {
    $template['title'] = 'siperang | REQUEST BARANG';
    $data['listRequest'] = $this->m_request->dataRequest();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('request/v_view', $data);
    $this->load->view('template/v_foot');
  }

  public function tambahRequest()
  {
    $template['title'] = 'siperang | TAMBAH REQUEST BARANG';
    $data['listBarang'] = $this->m_barang->dataBarang();
    $data['kodeReq'] = $this->m_request->kode_otomatis();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('request/v_add', $data);
    $this->load->view('template/v_foot');
  }

  public function addBarang()
  {
    $this->form_validation->set_rules('KodeBarang', 'Kode Barang', 'trim|required', [
      'required' => 'Kode Barang harus diisi!'
    ]);
    $this->form_validation->set_rules('NamaBarang', 'Nama Barang', 'trim|required', [
      'required' => 'Nama Barang harus diisi!'
    ]);
    $this->form_validation->set_rules('HargaBeli', 'Harga Beli', 'trim|required|numeric', [
      'required' => 'Harga Beli diisi!',
      'numeric' => '%s harus berupa angka'
    ]);
    $this->form_validation->set_rules('Quantity', 'Quantity', 'trim|required|numeric', [
      'required' => 'Quantity diisi!',
      'numeric' => '%s harus berupa angka'
    ]);
    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      echo json_encode(['success' => true]);
    }
  }

  public function insertRequest()
  {
    $this->form_validation->set_rules('Kode', 'Kode Transaksi', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('Detil[]', 'Detil Barang', 'required', [
      'required' => 'Tidak ada barang yang dipilih!'
    ]);
    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      foreach ($this->input->post('Detil') as $row) {
        $detil[] = [
          'id' => generate_token(5) . time(),
          'Kode_Request' => $this->input->post('Kode'),
          'Kode_Barang' => $row[0],
          'Nama_Barang' => $row[1],
          'Harga_Barang' => $row[2],
          'Quantity' => $row[3],
          'isStatus' => 0,
          'Subtotal' => $row[4],
        ];
      }

      $data = [
        'Kode_Request' => $this->input->post('Kode'),
        'Tanggal_Request' => date('Y-m-d'),
        'Total' => $this->input->post('Total'),
        'isStatus' => 0,
        'user' => $this->session->userdata('idUser')
      ];
      $this->m_request->prosesInsert($data, $detil);
      echo json_encode(['success' => true]);
    }
  }

  public function detil($id)
  {
    $data = $this->m_request->detil($id);
    echo json_encode($data);
  }

  public function editRequest($id)
  {
    $template['title'] = 'siperang | UBAH REQUEST BARANG';
    $data['listBarang'] = $this->m_barang->dataBarang();
    $data['req'] = $this->m_request->cariRequest($id);
    $data['detil'] = json_encode($this->m_request->cariDetilRequest($id));
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('request/v_edit', $data);
    $this->load->view('template/v_foot');
  }

  public function updateRequest($id)
  {
    $this->form_validation->set_rules('Kode', 'Kode Transaksi', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('Detil[]', 'Detil Barang', 'required', [
      'required' => 'Tidak ada barang yang dipilih!'
    ]);
    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      foreach ($this->input->post('Detil') as $row) {
        $detil[] = [
          'id' => generate_token(5) . time(),
          'Kode_Request' => $id,
          'Kode_Barang' => $row[0],
          'Nama_Barang' => $row[1],
          'Harga_Barang' => $row[2],
          'Quantity' => $row[3],
          'isStatus' => 0,
          'Subtotal' => $row[4],
        ];
      }

      $data = [
        'Tanggal_Request' => date('Y-m-d'),
        'Total' => $this->input->post('Total'),
        'isStatus' => 0,
        'user' => $this->session->userdata('idUser')
      ];
      $this->m_request->prosesUpdate($data, $detil, $id);
      echo json_encode(['success' => true]);
    }
  }
}

/* End of file C_request.php */
