<?php 
$this->load->view('admin/header');

$this->load->view('admin/menu_left');
?>

<main id="main" class="main">
   <div class="pagetitle">
      <h1>Slider Banner</h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item">Setting Image/Banner</li>
            <li class="breadcrumb-item active">Slider Banner</li>
         </ol>
      </nav>
   </div>
   <section class="section">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Slider Banner Insert Form</h5>
                  <form action="<?php echo base_url("admin/insert_slider_banner");?>" method="post" enctype="multipart/form-data">
                    
                     <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Image Upload</label>
                        <div class="col-sm-10"> <input class="form-control" type="file" id="foto" name="foto" required>
                     </div>
                     </div>


                      <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Heading</label>
                        <div class="col-sm-10"> <input class="form-control" type="text" id="heading" name="heading">
                     </div>
                     </div>

                      <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Caption</label>
                        <div class="col-sm-10"> <input class="form-control" type="text" id="caption" name="caption">
                     </div>
                     </div>

                      <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Button Name</label>
                        <div class="col-sm-10"> <input class="form-control" type="text" id="btn_title" name="btn_title" placeholder="Kosongkan Jika Tidak Menggunakan Tombol">
                     </div>
                     </div>

                     <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Button Link</label>
                        <div class="col-sm-10"> <input class="form-control" type="text" id="btn_link" name="btn_link" placeholder="Kosongkan Jika Tidak Menggunakan Tombol">
                     </div>
                     </div>

                     <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10"> <button type="submit" class="btn btn-primary">Submit</button>  <a href="<?php echo site_url('admin/home_slider');?>" class='btn btn-danger'>
			Back
		</a>  
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>
<?php 
$this->load->view('admin/footer');
?>