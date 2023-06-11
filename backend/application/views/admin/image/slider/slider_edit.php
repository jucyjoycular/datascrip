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
                  <h5 class="card-title">Slider Banner Form</h5>
                  <form action="<?php echo base_url("admin/update_slider");?>" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="id" value="<?php echo $slider->id_banner?>">
                    

                     <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Image Upload</label>
                        <div class="col-sm-10"> <input class="form-control" type="file" id="foto" name="foto">*Kosongkan jika tidak mengganti gambar
                        <br>
													<?php 
													$foto = "default.jpg";
													if($slider->filename != "") {$foto = $slider->filename; }
													$urlimg = base_url("assets/upload/slider/$foto");
													$image = "<img src='$urlimg' width='320' height='150'>";
													echo $image;
													?>
												</div>
                     </div>

                       <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Heading</label>
                        <div class="col-sm-10"> <input class="form-control" type="text" id="heading" name="heading" value="<?php echo $slider->heading?>">
                     </div>
                     </div>

                      <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Caption</label>
                        <div class="col-sm-10"> <input class="form-control" type="text" id="caption" name="caption" value="<?php echo $slider->caption?>">
                     </div>
                     </div>

                      <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Button Name</label>
                        <div class="col-sm-10"> <input class="form-control" type="text" id="btn_title" name="btn_title" value="<?php echo $slider->btn_title?>" placeholder="Kosongkan Jika Tidak Menggunakan Tombol">
                     </div>
                     </div>

                     <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Button Link</label>
                        <div class="col-sm-10"> <input class="form-control" type="text" id="btn_link" name="btn_link" value="<?php echo $slider->btn_link?>" placeholder="Kosongkan Jika Tidak Menggunakan Tombol">
                     </div>
                     </div>

                     <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10"> <button type="submit" class="btn btn-primary">Update</button>  <a href="<?php echo site_url('admin/home_slider');?>" class='btn btn-danger'>
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