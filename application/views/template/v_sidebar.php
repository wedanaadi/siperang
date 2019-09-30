<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?php echo base_url() . 'assets/dist/img/AdminLTELogo.png' ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SIPERANG</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url() . 'assets/dist/img/user2-160x160.jpg' ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $this->session->userdata('namaUser') ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <?php if ($this->session->userdata('bagian') == '1') : ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() . 'c_auth/listUser' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                                        <a href="<?php echo base_url() . 'c_auth/listBagian' ?>" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Bagian</p>
                                        </a>
                                      </li> -->
              <li class="nav-item">
                <a href="<?php echo base_url() . 'c_supplier/index' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() . 'c_barang/index' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() . 'c_order/index' ?>" class="nav-link">
              <i class="nav-icon fas fa-angle-double-up"></i>
              <p>
                Order Barang
              </p>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($this->session->userdata('bagian') == '2') : ?>
          <li class="nav-item">
            <a href="<?php echo base_url() . 'c_penjualan/index' ?>" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Transaksi Penjualan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() . 'c_barang/index' ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Barang</p>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($this->session->userdata('bagian') != '2') : ?>
          <li class="nav-item">
            <a href="<?php echo base_url() . 'c_dashboard/index' ?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($this->session->userdata('bagian') == '3') : ?>
          <li class="nav-item">
            <a href="<?php echo base_url() . 'c_request/index' ?>" class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Request Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() . 'c_barangmasuk/index' ?>" class="nav-link">
              <i class="nav-icon fas fa-angle-double-down"></i>
              <p>
                Barang Masuk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() . 'c_returnbarang/index' ?>" class="nav-link">
              <i class="nav-icon fas fa-share-square"></i>
              <p>
                Return Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() . 'c_stockopname/index' ?>" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Stock Opname
              </p>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($this->session->userdata('bagian') == '4' or $this->session->userdata('bagian') == '1') : ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-swatchbook"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() . 'c_penjualan/laporan' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() . 'c_stockopname/laporan' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Opname</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
  </div>