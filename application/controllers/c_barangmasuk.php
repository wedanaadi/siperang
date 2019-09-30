<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_barangmasuk extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(['m_barangmasuk', 'm_supplier', 'm_order', 'm_barang']);
    is_login();
  }


  public function index()
  {
    $template['title'] = 'siperang | BARANG MASUK';
    $data['listSupplier'] = $this->m_supplier->dataSupplier();
    $data['listOrder'] = $this->m_order->getListOrderForBarangMasuk();
    $data['listBarangMasuk'] = $this->m_barangmasuk->dataBarangMasuk(date('Y-m-d'));
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('barangmasuk/v_view', $data);
    $this->load->view('template/v_foot');
  }

  public function tambahBarangMasuk($idOrder)
  {
    $template['title'] = 'siperang | Tamabah BARANG MASUK';
    $data['kodeBarangMasuk'] = $this->m_barangmasuk->kode_otomatis();
    $data['listBarang'] = $this->m_order->listBarangOrder($idOrder);
    $data['dataSupplier'] = $this->m_order->getSupplierData($idOrder);
    $data['idOrder'] = $idOrder;
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('barangmasuk/v_add', $data);
    $this->load->view('template/v_foot');
  }

  public function getDetilBarangOrder($idBarang)
  {
    echo json_encode($this->m_order->cariDetilBarang($this->input->post('idOrder'), $idBarang));
  }

  public function addBarang()
  {
    $this->form_validation->set_rules('KodeBarang', 'Kode Barang', 'trim|required', [
      'required' => 'Kode Barang harus diisi!'
    ]);
    $this->form_validation->set_rules('NamaBarang', 'Nama Barang', 'trim|required', [
      'required' => 'Nama Barang harus diisi!'
    ]);
    $this->form_validation->set_rules('HargaBarang', 'Harga Barang', 'trim|required|numeric', [
      'required' => 'Harga Barang diisi!',
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

  public function insertBarangMasuk()
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
      $updateStok = [];
      foreach ($this->input->post('Detil') as $row) {
        $detil[] = [
          'id' => generate_token(5) . time(),
          'Kode_BarangMasuk' => $this->input->post('Kode'),
          'Kode_Barang' => $row[0],
          'Nama_Barang' => $row[1],
          'Harga_Barang' => $row[2],
          'Quantity' => $row[3],
          'Subtotal' => $row[4],
        ];

        $getBarang = $this->m_barang->cariBarang($row[0]);
        array_push($updateStok, ['Kode_Barang' => $row[0], 'Quantity' => $row[3] + $getBarang->Quantity]);
      }

      $data = [
        'Kode_BarangMasuk' => $this->input->post('Kode'),
        'Kode_Order' => $this->input->post('idOrder'),
        'Supplier' => $this->input->post('KodeSupplier'),
        'Tanggal' => date('Y-m-d'),
        'Total' => $this->input->post('Total'),
      ];
      $this->m_barangmasuk->prosesInsert($data, $detil, $this->input->post('idOrder'), $updateStok);
      echo json_encode(['success' => true]);
    }
  }

  public function editBarangMasuk($id)
  {
    $template['title'] = 'siperang | ubah BARANG MASUK';
    $data['barangmasuk'] = $this->m_barangmasuk->cariBarangMasuk($id);
    $data['detil'] = json_encode($this->m_barangmasuk->cariDetil($id));
    $data['listBarang'] = $this->m_order->listBarangOrder($data['barangmasuk']->Kode_Order);
    $data['dataSupplier'] = $this->m_order->getSupplierData($data['barangmasuk']->Kode_Order);
    $data['idOrder'] = $data['barangmasuk']->Kode_Order;
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('barangmasuk/v_edit', $data);
    $this->load->view('template/v_foot');
  }

  public function updateBarangMasuk($id)
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
      foreach ($this->input->post('old') as $rowOld) {
        $getBarang = $this->m_barang->cariBarang($rowOld['Kode_Barang']);
        $dataStok = [
          'Quantity' => $getBarang->Quantity - $rowOld['Quantity']
        ];
        $this->m_barang->updateBarang($dataStok, $rowOld['Kode_Barang']);
      }

      $updateStok = [];
      foreach ($this->input->post('Detil') as $row) {
        $detil[] = [
          'id' => generate_token(5) . time(),
          'Kode_BarangMasuk' => $this->input->post('Kode'),
          'Kode_Barang' => $row[0],
          'Nama_Barang' => $row[1],
          'Harga_Barang' => $row[2],
          'Quantity' => $row[3],
          'Subtotal' => $row[4],
        ];

        $getBarang = $this->m_barang->cariBarang($row[0]);
        array_push($updateStok, ['Kode_Barang' => $row[0], 'Quantity' => $row[3] + $getBarang->Quantity]);
      }

      $data = [
        'Kode_BarangMasuk' => $this->input->post('Kode'),
        'Kode_Order' => $this->input->post('idOrder'),
        'Supplier' => $this->input->post('KodeSupplier'),
        'Tanggal' => date('Y-m-d'),
        'Total' => $this->input->post('Total'),
      ];
      $this->m_barangmasuk->prosesUpdate($data, $detil, $id, $updateStok);
      echo json_encode(['success' => true]);
    }
  }

  public function detil($id)
  {
    echo json_encode($this->m_barangmasuk->cariDetil($id));
  }

  public function getBarangMasukJson()
  {
    $tanggal = $this->input->post('Tanggal');
    $supplier = $this->input->post('Supplier') == 'ALL' ? null : $this->input->post('Supplier');
    $data = $this->m_barangmasuk->dataBarangMasuk($tanggal, $supplier);
    echo json_encode($data);
  }
}

/* End of file C_barangmasuk.php */
