<?php 
$this->load->view('admin/header');

$this->load->view('admin/menu_left');
?>

<main id="main" class="main">
   <div class="pagetitle">
      <h1>Update Logo</h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item">Setting Image/Banner</li>
            <li class="breadcrumb-item active">Update Logo</li>
         </ol>
      </nav>
   </div>
   <section class="section">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Upload Logo Form</h5>
                  <form action="<?php echo base_url("admin/update_logo");?>" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="id" value="<?php echo $logo->id_logo?>">
                     <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                        <div class="col-sm-10"> <input class="form-control" type="file" id="foto" name="foto">
                        <br>
													<?php 
													$foto = "default.jpg";
													if($logo->filename != "") {$foto = $logo->filename; }
													$urlimg = base_url("assets/upload/logo/$foto");
													$image = "<img src='$urlimg' width='320' height='150'>";
													echo $image;
													?>
												</div>
                     </div>
                     <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10"> <button type="submit" class="btn btn-primary">Update</button>  <a href="<?php echo site_url('admin/logo_upload');?>" class='btn btn-danger'>
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