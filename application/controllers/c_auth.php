<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(['m_auth']);
  }


  public function index()
  {
    $this->login();
  }

  public function login()
  {
    $this->load->view('auth/v_login');
  }

  public function listBagian()
  {
    $template['title'] = 'siperang | DAFTAR BAGIAN AKSES';
    $data['listBagian'] = $this->m_auth->dataBagianAkses();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('auth/v_bagian_akses', $data);
    $this->load->view('template/v_foot');
  }

  public function tambahBagian()
  {
    $template['title'] = 'siperang | TAMBAH BAGIAN';
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('auth/v_bagianadd');
    $this->load->view('template/v_foot');
  }

  public function buatBagian()
  {
    $this->form_validation->set_rules('NamaBagian', 'Nama Bagian', 'trim|required|is_unique[tbl_bagian.Nama_bagian]', [
      'required' => 'Bagian harus diisi!',
      'is_unique' => 'Bagian Sudah ada!',
    ]);

    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $data = [
        'Kode_bagian' => 'BAG' . time(),
        'Nama_bagian' => $this->input->post('NamaBagian')
      ];

      $this->m_auth->insertBagian($data);
      echo json_encode(['success' => true]);
    }
  }

  public function editBagian($id)
  {
    $template['title'] = 'siperang | UBAH BAGIAN';
    $data['dataUbah'] = $this->m_auth->cariBagian($id);
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('auth/v_bagianedit', $data);
    $this->load->view('template/v_foot');
  }

  public function ubahBagian($id)
  {
    $this->form_validation->set_rules('NamaBagian', 'Nama Bagian', 'trim|required|is_unique[tbl_bagian.Nama_bagian]', [
      'required' => 'Bagian harus diisi!',
      'is_unique' => 'Bagian Sudah ada!',
    ]);

    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $data = [
        'Nama_bagian' => $this->input->post('NamaBagian')
      ];

      $this->m_auth->updateBagian($data, $id);
      echo json_encode(['success' => true]);
    }
  }

  public function deleteBagian($id)
  {
    $this->m_auth->deleteBagian($id);
    echo json_encode(['success' => true]);
  }

  public function listUser()
  {
    $template['title'] = 'siperang | DAFTAR USER';
    $data['listUser'] = $this->m_auth->dataUser();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('auth/v_user', $data);
    $this->load->view('template/v_foot');
  }

  public function tambahUser()
  {
    $template['title'] = 'siperang | TAMBAH USER';
    $data['listBagian'] = $this->m_auth->dataBagianAkses();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('auth/v_useradd', $data);
    $this->load->view('template/v_foot');
  }

  public function buatUser()
  {
    $this->form_validation->set_rules('NamaUser', 'Nama User', 'trim|required', [
      'required' => 'Nama User harus diisi!'
    ]);
    $this->form_validation->set_rules('Password', 'Password', 'trim|required', [
      'required' => 'Password harus diisi!'
    ]);
    $this->form_validation->set_rules('telepon', 'Telepon', 'trim|required', [
      'required' => 'Telepon harus diisi!'
    ]);
    $this->form_validation->set_rules('bagian', 'Bagian', 'trim|required', [
      'required' => 'Bagian harus diisi!'
    ]);
    $this->form_validation->set_rules('Username', 'Username', 'trim|required|is_unique[tbl_user.Username]', [
      'required' => 'Username harus diisi!',
      'is_unique' => 'Username Sudah digunakan!',
    ]);

    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $data = [
        'Kode_User' => 'USR' . time(),
        'Nama_User' => $this->input->post('NamaUser'),
        'Username' => $this->input->post('Username'),
        'Password' => password_hash($this->input->post('Password'), PASSWORD_BCRYPT),
        'Nomor_Telepon' => $this->input->post('telepon'),
        'Bagian' => $this->input->post('bagian'),
      ];

      $this->m_auth->insertUser($data);
      echo json_encode(['success' => true]);
    }
  }

  public function editUser($id)
  {
    $template['title'] = 'siperang | UBAH USER';
    $data['listBagian'] = $this->m_auth->dataBagianAkses();
    $data['dataUbah'] = $this->m_auth->cariUser($id);
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('auth/v_useredit', $data);
    $this->load->view('template/v_foot');
  }

  public function updateUser($id)
  {
    $this->form_validation->set_rules('NamaUser', 'Nama User', 'trim|required', [
      'required' => 'Nama User harus diisi!'
    ]);
    $this->form_validation->set_rules('Password', 'Password', 'trim|required', [
      'required' => 'Password harus diisi!'
    ]);
    $this->form_validation->set_rules('telepon', 'Telepon', 'trim|required', [
      'required' => 'Telepon harus diisi!'
    ]);
    $this->form_validation->set_rules('bagian', 'Bagian', 'trim|required', [
      'required' => 'Bagian harus diisi!'
    ]);
    $this->form_validation->set_rules('Username', 'Username', 'trim|required', [
      'required' => 'Username harus diisi!',
    ]);

    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $data = [
        'Nama_User' => $this->input->post('NamaUser'),
        'Username' => $this->input->post('Username'),
        'Password' => password_hash($this->input->post('Password'), PASSWORD_BCRYPT),
        'Nomor_Telepon' => $this->input->post('telepon'),
        'Bagian' => $this->input->post('bagian'),
      ];

      $this->m_auth->updateUser($data, $id);
      echo json_encode(['success' => true]);
    }
  }

  public function deleteUser($id)
  {
    $this->m_auth->deleteUser($id);
    echo json_encode(['success' => true]);
  }

  public function prosesLogin()
  {
    $this->form_validation->set_rules('username', 'Username', 'trim|required', [
      'required' => 'Username harus diisi!'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'trim|required', [
      'required' => 'Password harus diisi!'
    ]);

    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $getUser =  $this->m_auth->cekUsername($this->input->post('username'));
      if ($getUser) {
        if (password_verify($this->input->post('password'), $getUser->Password)) {
          $user_session = [
            'idSession' => 'SES' . time(),
            'namaUser' => $getUser->Nama_User,
            'idUser' => $getUser->Kode_User,
            'bagian' => $getUser->Bagian,
          ];
          if ($getUser->Bagian == '2') {
            $aksi = base_url('c_penjualan');
          } else {
            $aksi = base_url('c_dashboard');
          }
          $this->session->set_userdata($user_session);
          echo json_encode(['success' => true, 'pesan' => 1, 'url' => $aksi]);
        } else {
          echo json_encode(['success' => true, 'pesan' => 0]);
        }
      } else {
        echo json_encode(['success' => false, 'pesan' => 0]);
      }
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('c_auth/login');
  }
}

/* End of file C_auth.php */
