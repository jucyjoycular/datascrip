<?php 
$this->load->view('admin/header');
?>

<?php 
$this->load->view('admin/menu_left');
?>


<main id="main" class="main">
   <div class="pagetitle">
      <h1>Promo Slider Banner</h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item">Promo Slider Image/Banner</li>
            <li class="breadcrumb-item active">Promo Slider Banner</li>
         </ol>
      </nav>
   </div>
   <section class="section">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Promo Slider Banner</h5>
                  <div style="margin-bottom: 10px;">
<a href="<?php echo site_url('admin/insert_promo_slider');?>" class='btn btn-primary'>
   Insert Data
</a>
</div><br>
                  
                        <table  id="example" class="display nowrap table-striped table-bordered table" style="width:100%">
                           <thead>
                              <tr>
                                 <th scope="col" data-sortable="" style="width: 5.67652%;"><a href="#" class="dataTable-sorter">No</a></th>
                                 <th scope="col" data-sortable="" style="width: 27.9938%;"><a href="#" class="dataTable-sorter">Image Name</a></th>
                                 <th scope="col" data-sortable="" style="width: 27.9938%;"><a href="#" class="dataTable-sorter">Links</a></th>
                                 <th scope="col" data-sortable="" style="width: 37.7916%;"><a href="#" class="dataTable-sorter">Action</a></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
														$no = 1;
														foreach($slider as $data)
														{
															
															$foto = $data->filename;
															$datarlimg = base_url("assets/upload/promo_slider/$foto");
															$image = "<img src='$datarlimg' width='320' height='150'>";
														?>
														<tr bgcolor="#fff">
															<td><?php echo $no;?></td>
															<td><?php echo $image;?></td>
                                             <td><?php echo $data->link;?></td>
															<td>
																<a href="<?php echo base_url();?>admin/promo_slider_edit/<?php echo $data->id_banner?>" class="btn btn-warning">Edit</a> <a href="<?php echo base_url();?>admin/delete_promo_slider/<?php echo $data->id_banner?>" onclick="return confirm('Do you want delete this data?')" class='btn btn-danger'>
                                                  Delete
                                                </a>
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


