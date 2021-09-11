<aside class="main-sidebar">
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/theme/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Login </a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU NAVIGASI</li>
        <li <?php if($this->uri->segment(1) =="dashboard"){echo 'class="active"';}?>><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-home"></i> <span>HOME</span></a></li>
        
        <li class="treeview             	
        <?php 
          if($this->uri->segment('1') == "pengguna")
          { 
            echo 'active';
          }
          elseif($this->uri->segment('1') == "item")
          { 
            echo 'active';
          }
          elseif($this->uri->segment('1') == "suplier")
          { 
            echo 'active';
          }
          elseif($this->uri->segment('1') == "customer")
          { 
            echo 'active';
          }
          ?>">
          <a href="#">
            <i class="fa fa-database"></i> <span>MASTER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($this->uri->segment(1) =="pengguna"){ echo 'class="active"';}?>><a href="<?php echo base_url('pengguna');?>"><i class="fa fa-circle-o text-red"></i> <span>Pengguna</span></a></li>
            <li <?php if($this->uri->segment(1) =="item"){ echo 'class="active"';} ?>><a href="<?php echo base_url('item');?>"><i class="fa fa-circle-o text-red"></i> <span>Master Item</span></a></li>
            <li <?php if($this->uri->segment(1) =="suplier"){ echo 'class="active"';} ?>><a href="<?php echo base_url('suplier');?>"><i class="fa fa-circle-o text-red"></i> <span>Master Suplier</span></a></li>
            <li <?php if($this->uri->segment(1) =="customer"){ echo 'class="active"';} ?>><a href="<?php echo base_url('customer');?>"><i class="fa fa-circle-o text-red"></i> <span>Master Customer</span></a></li>
          </ul>
        </li>
        
        
        <li class="treeview             	
        <?php 
          if($this->uri->segment('1') == "po")
          { 
            echo 'active';
          }
          elseif($this->uri->segment('1') == "so")
          { 
            echo 'active';
          }
          elseif($this->uri->segment('1') == "gr")
          { 
            echo 'active';
          }
          elseif($this->uri->segment('1') == "sr")
          { 
            echo 'active';
          }
          ?>">
          <a href="#">
            <i class="fa fa-database"></i> <span>TRANSAKSI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li <?php if($this->uri->segment(1) =="po"){ echo 'class="active"';}?>><a href="<?php echo base_url('po');?>"><i class="fa fa-circle-o text-red"></i> <span>Purchase Order</span></a></li>
          <li <?php if($this->uri->segment(1) =="so"){ echo 'class="active"';}?>><a href="<?php echo base_url('so');?>"><i class="fa fa-circle-o text-red"></i> <span>Sales Order</span></a></li>
          <li <?php if($this->uri->segment(1) =="gr"){ echo 'class="active"';}?>><a href="<?php echo base_url('gr');?>"><i class="fa fa-circle-o text-red"></i> <span>Goods Received </span></a></li>
          <li <?php if($this->uri->segment(1) =="sr"){ echo 'class="active"';}?>><a href="<?php echo base_url('sr');?>"><i class="fa fa-circle-o text-red"></i> <span>Sales Retur </span></a></li>
  
        </ul>
        </li>
        
        <li class="treeview             	
        <?php 
          if($this->uri->segment('1') == "stok")
          { 
            echo 'active';
          }
          elseif($this->uri->segment('1') == "report-penjualan")
          { 
            echo 'active';
          }
          elseif($this->uri->segment('1') == "report-pemesanan")
          { 
            echo 'active';
          }
          elseif($this->uri->segment('1') == "report-stok-masuk")
          { 
            echo 'active';
          }
          ?>">
          <a href="#">
            <i class="fa fa-database"></i> <span>REPORT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li <?php if($this->uri->segment(1) =="stok"){ echo 'class="active"';}?>><a href="<?php echo base_url('stok');?>"><i class="fa fa-circle-o text-red"></i> <span>Report Stok </span></a></li>
          <li <?php if($this->uri->segment(1) =="report-penjualan"){ echo 'class="active"';}?>><a href="<?php echo base_url('report-penjualan');?>"><i class="fa fa-circle-o text-red"></i> <span>Report Penjualan </span></a></li>
          <li <?php if($this->uri->segment(1) =="report-pemesanan"){ echo 'class="active"';}?>><a href="<?php echo base_url('report-pemesanan');?>"><i class="fa fa-circle-o text-red"></i> <span>Report Pemesanan </span></a></li>
          <li <?php if($this->uri->segment(1) =="report-stok-masuk"){ echo 'class="active"';}?>><a href="<?php echo base_url('report-stok-masuk');?>"><i class="fa fa-circle-o text-red"></i> <span>Report Item Masuk </span></a></li>

          </ul>
        </li>
     
        <li><a href="<?php echo base_url('auth/logout');?>"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>