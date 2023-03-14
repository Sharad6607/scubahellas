<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Scuba Hellas</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="<?php echo base_url('vendor/dashboard');?>" class="nav-link <?php echo $this->uri->segment(2) == 'dashboard' ?'active': '';?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="<?php echo base_url('vendor/manage-dives');?>" class="nav-link <?php echo $this->uri->segment(2) == 'manage-dives' ?'active': '';?>">
                <i class="nav-icon fas fa-map-marker"></i>
                <p>Manage Dives</p>
              </a>
            </li>
            
            <li class="nav-item menu-open">
              <a href="<?php echo base_url('vendor/rental-products');?>" class="nav-link <?php echo $this->uri->segment(2) == 'rental-products' ?'active': '';?>">
                <i class="nav-icon fas fa-user"></i>
                <p>Rental Products</p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="<?php echo base_url('vendor/bookings');?>" class="nav-link <?php echo $this->uri->segment(2) == 'bookings' ?'active': '';?>">
                <i class="nav-icon fas fa-book"></i>
                <p>Manage Bookings</p>
              </a>
            </li>
        </ul>
      </nav>
    </div>
  </aside>