<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_order extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(['m_order', 'm_supplier', 'm_barang', 'm_request']);
    is_login();
  }

  public function index()
  {
    $template['title'] = 'siperang | ORDER BARANG';
    $data['listSupplier'] = $this->m_supplier->dataSupplier();
    $data['listOrder'] = $this->m_order->dataOrder(date('Y-m-d'));
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('order/v_view', $data);
    $this->load->view('template/v_foot');
  }

  public function getOrderJson()
  {
    $tanggal = $this->input->post('Tanggal');
    $supplier = $this->input->post('Supplier') == 'ALL' ? null : $this->input->post('Supplier');
    $data = $this->m_order->dataOrder($tanggal, $supplier);
    echo json_encode($data);
  }

  public function tambahOrder()
  {
    $template['title'] = 'siperang | TAMBAH ORDER BARANG';
    $data['listSupplier'] = $this->m_supplier->dataSupplier();
    $data['KodeOrder'] = $this->m_order->kode_otomatis();
    $data['ListBarang'] = $this->m_barang->dataBarang();
    $data['ListReq'] = $this->m_request->getReq();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('order/v_add', $data);
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
    $this->form_validation->set_rules('HargaBarang', 'Harga Barang', 'trim|required|numeric', [
      'required' => '%s diisi!',
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

  public function insertOrder()
  {
    $this->form_validation->set_rules('Kode', 'Kode Transaksi', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('KodeSupplier', 'Kode Suplier', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('NamaSupplier', 'Nama Suplier', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('Detil[]', 'Detil Barang', 'required', [
      'required' => 'Tidak ada barang yang dipilih!'
    ]);
    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $data = [
        'Kode_Order' => $this->input->post('Kode'),
        'Tanggal_Order' => date('Y-m-d'),
        'Total' => $this->input->post('Total'),
        'isStatus' => 0,
        'Supplier' => $this->input->post('KodeSupplier')
      ];

      $request_id = [];
      $request_kode = [];
      foreach ($this->input->post('Detil') as $row) {
        $detil[] = [
          'id' => generate_token(5) . time(),
          'Kode_Order' => $this->input->post('Kode'),
          'Kode_Barang' => $row[0],
          'Nama_Barang' => $row[1],
          'Harga_Barang' => $row[2],
          'Quantity' => $row[3],
          'Subtotal' => $row[4],
          'id_detil_req' => $row[6],
          'kode_req' => $row[7],
        ];

        $split = explode(',', $row[6]);
        $split_kode = explode(',', $row[7]);
        $request_id = array_merge($request_id, $split);
        $request_kode = array_merge($request_kode, $split_kode);
      }

      foreach ($request_id as $id) {
        $detil_request_id[] = [
          'id' => trim($id),
          'isStatus' => 1
        ];
      }

      foreach ($request_kode as $kode) {
        $kode_request[] = [
          'Kode_Request' => trim($kode),
          'isStatus' => 1
        ];
      }

      $this->m_order->prosesInsert($data, $detil, $detil_request_id, $kode_request);
      echo json_encode(['success' => true]);
    }
  }

  public function getSupplierData()
  {
    $id = $this->input->post('id');
    echo json_encode($this->m_supplier->cariSupplier($id));
  }

  public function detil($id)
  {
    $data = $this->m_order->detil($id);
    echo json_encode($data);
  }

  public function editOrder($id)
  {
    $template['title'] = 'siperang | Ubah ORDER BARANG';
    $data['listSupplier'] = $this->m_supplier->dataSupplier();
    $data['ListBarang'] = $this->m_barang->dataBarang();
    $data['ListReq'] = $this->m_request->getReq();
    $data['order'] = $this->m_order->cariOrder($id);
    $data['detilSupplier'] = $this->m_supplier->cariSupplier($data['order']->Supplier);
    $data['detil'] = json_encode($this->m_order->cariDetilOrder($id));
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('order/v_edit', $data);
    $this->load->view('template/v_foot');
  }

  public function updateOrder($idOrder)
  {
    $this->form_validation->set_rules('Kode', 'Kode Transaksi', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('KodeSupplier', 'Kode Suplier', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('NamaSupplier', 'Nama Suplier', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('Detil[]', 'Detil Barang', 'required', [
      'required' => 'Tidak ada barang yang dipilih!'
    ]);
    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $data = [
        'Kode_Order' => $this->input->post('Kode'),
        'Tanggal_Order' => date('Y-m-d'),
        'Total' => $this->input->post('Total'),
        'isStatus' => 0,
        'Supplier' => $this->input->post('KodeSupplier')
      ];

      $request_id_old = [];
      $request_kode_old = [];
      foreach ($this->input->post('old') as $old) {
        $split_old = explode(',', $old['id_detil_req']);
        $split_kode_old = explode(',', $old['kode_req']);
        $request_id_old = array_merge($request_id_old, $split_old);
        $request_kode_old = array_merge($request_kode_old, $split_kode_old);
      }

      foreach ($request_id_old as $id) {
        $detil_request_id_old[] = [
          'id' => trim($id),
          'isStatus' => 0
        ];
      }

      foreach ($request_kode_old as $kode) {
        $kode_request_old[] = [
          'Kode_Request' => trim($kode),
          'isStatus' => 0
        ];
      }

      $request_id = [];
      $request_kode = [];
      foreach ($this->input->post('Detil') as $row) {
        $detil[] = [
          'id' => generate_token(5) . time(),
          'Kode_Order' => $this->input->post('Kode'),
          'Kode_Barang' => $row[0],
          'Nama_Barang' => $row[1],
          'Harga_Barang' => $row[2],
          'Quantity' => $row[3],
          'Subtotal' => $row[4],
          'id_detil_req' => $row[6],
          'kode_req' => $row[7],
        ];

        $split = explode(',', $row[6]);
        $split_kode = explode(',', $row[7]);
        $request_id = array_merge($request_id, $split);
        $request_kode = array_merge($request_kode, $split_kode);
      }

      foreach ($request_id as $id) {
        $detil_request_id[] = [
          'id' => trim($id),
          'isStatus' => 1
        ];
      }

      foreach ($request_kode as $kode) {
        $kode_request[] = [
          'Kode_Request' => trim($kode),
          'isStatus' => 1
        ];
      }

      $this->m_order->prosesUpdate($data, $detil, $detil_request_id, $kode_request, $idOrder, $detil_request_id_old, $kode_request_old);
      echo json_encode(['success' => true]);
    }
  }
}

/* End of file C_order.php */
