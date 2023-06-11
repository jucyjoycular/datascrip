<?php $this->load->view('admin/header')?>


<?php $this->load->view('admin/menu_left')?>


<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <?php if($this->session->userdata('role')==1){?>
    <section class="section dashboard">
      <div class="row">

        <!-- Right side columns -->
        <div class="col-lg-4">

         

          
         
        </div><!-- End Right side columns -->

      </div>
    </section>

  <?php }?>

  </main>

  <?php $this->load->view('admin/footer')?>