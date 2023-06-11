  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?php echo base_url()?>home">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <?php if($this->session->userdata('role')==1){?>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Setting Image/Banner</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo base_url()?>admin/logo_upload">
              <i class="bi bi-circle"></i><span>Logo Upload</span>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url()?>admin/home_slider">
              <i class="bi bi-circle"></i><span>Slider Banner</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->

    <?php }?>
     
      
     
      
    

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#componentss-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Content Management System</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="componentss-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        
            <li>
            <a href="<?php echo base_url()?>admin/promo_slider">
              <i class="bi bi-circle"></i><span>Promo Slider Management</span>
            </a>
          </li>

         <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>News</span>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Media</span>
            </a>
          </li>

            <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Karir</span>
            </a>
          </li>

            <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Layanan Purnajual</span>
            </a>
          </li>


            <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Katalog Produk</span>
            </a>
          </li>
           


     
           

        </ul>
      </li>
           





    </ul> 

  </aside>