<?php 
$this->load->view('admin/header');
?>

<?php 
$this->load->view('admin/menu_left');
?>


<main id="main" class="main">
   <div class="pagetitle">
      <h1>Upload Logo</h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item">Setting Image/Banner</li>
            <li class="breadcrumb-item active">Upload Logo</li>
         </ol>
      </nav>
   </div>
   <section class="section">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Upload Logo</h5>
                  
                        <table  id="example" class="display nowrap table-striped table-bordered table" style="width:100%">
                           <thead>
                              <tr>
                                 <th scope="col" data-sortable="" style="width: 5.67652%;"><a href="#" class="dataTable-sorter">No</a></th>
                                 <th scope="col" data-sortable="" style="width: 27.9938%;"><a href="#" class="dataTable-sorter">Image Name</a></th>
                                 <th scope="col" data-sortable="" style="width: 37.7916%;"><a href="#" class="dataTable-sorter">Action</a></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
														$no = 1;
														foreach($logo as $data)
														{
															
															$foto = $data->filename;
															$datarlimg = base_url("assets/upload/logo/$foto");
															$image = "<img src='$datarlimg' width='320' height='150'>";
														?>
														<tr bgcolor="#fff">
															<td><?php echo $no;?></td>
															<td><?php echo $image;?></td>
															<td>
																<a href="<?php echo base_url();?>admin/logo_edit/<?php echo $data->id_logo?>" class="btn btn-warning">Edit</a>
															</td>
														</tr>
														<?php 
														$no++;
														}
														?>
                           </tbody>
                        </table>
                     
                  
               </div>
            </div>
         </div>
      </div>
   </section>
</main>

<?php 
$this->load->view('admin/footer');
?>


