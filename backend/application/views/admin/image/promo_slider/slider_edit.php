<?php 
$this->load->view('admin/header');

$this->load->view('admin/menu_left');
?>

<main id="main" class="main">
   <div class="pagetitle">
      <h1>Promo Slider Banner</h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item">Setting Promo Image/Banner Slider</li>
            <li class="breadcrumb-item active">Promo Slider Banner</li>
         </ol>
      </nav>
   </div>
   <section class="section">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Promo Slider Banner Form</h5>
                  <form action="<?php echo base_url("admin/update_promo_slider");?>" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="id" value="<?php echo $slider->id_banner?>">
                     <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10"> <input class="form-control" type="text" id="link" name="link" value="<?php echo $slider->link?>">
                     </div>
                     </div>

                     <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                        <div class="col-sm-10"> <input class="form-control" type="file" id="foto" name="foto">*Kosongkan jika tidak mengganti gambar
                        <br>
													<?php 
													$foto = "default.jpg";
													if($slider->filename != "") {$foto = $slider->filename; }
													$urlimg = base_url("assets/upload/promo_slider/$foto");
													$image = "<img src='$urlimg' width='320' height='150'>";
													echo $image;
													?>
												</div>
                     </div>
                     <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10"> <button type="submit" class="btn btn-primary">Update</button>  <a href="<?php echo site_url('admin/promo_slider');?>" class='btn btn-danger'>
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