<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Scuba Hellas</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php 
            $this->roles->getModuleNameByRole();
            $data=$this->session->userdata['userModule'];
            foreach($data as $k=>$v){ 
              $urlKey =$v["urlkey"]; ?>
              <li class="nav-item menu-open">
                <a href="<?php echo base_url('admin/'.$urlKey);?>" class="nav-link <?php if($this->uri->segment(2) == $urlKey ){ ;?>  active <?php } ?>" >
                  <i class="nav-icon fas fa-<?php echo $v['icon']; ?>"></i>
                  <p><?php echo $v['module_name']; ?></p>
                </a>
              </li><?php 
            } ?>
        </ul>
      </nav>
    </div>
  </aside>