<?php $this->load->view('front-header');?>

<?php
   require("includes/config.php");
   $productItem = mysqli_fetch_object(mysqli_query($connection,"select * from product where id =".$product->id));

   $cast_name = getField('id','group_id',$product->category_id,'category');



   $cast_names = getField('id','name',$cast_name,'category');


   $id_casts = getField('id','name',$cast_name,'category');


   

   $queryprice = mysqli_query($connection,"select * from product_price where id_product = ".$product->id." order by id asc") or die(mysqli_error());
    $totalPrice = mysqli_num_rows($queryprice);
    
    $ppnQuery = mysqli_query($connection,"SELECT * FROM ppn WHERE status = 1 LIMIT 1");
    $ppn = mysqli_fetch_object($ppnQuery);

   ?>
<div class="breadcrumb">
   <div class="container">
      <div class="breadcrumb-inner">
        <br>
        <a href="<?php echo base_url()?>">Home</a> /  <a href="<?php echo base_url("products/category/$id_casts")?>"><?php echo $cast_names?></a> / <?php echo $productItem->name;?>
        <!--  <ul class="list-inline list-unstyled">
            <li>
            <a href="<?php echo base_url()?>">Home</a></li>
            <li><a href="<?php echo base_url("products/category/$id_casts")?>"><?php echo $cast_names?></a></li>
            <li class='active'><?php echo strtolower($productItem->name);?></li>
         </ul> -->
      </div>
      <!-- /.breadcrumb-inner -->
   </div>
   <!-- /.container -->
</div>
<!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
   <div class='container'>
      <div class='row single-product'>
         <div class='col-md-3 sidebar'>

          <div class="sidebar-module-container">
               <div class="sidebar-filter">
                  <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                  <div class="sidebar-widget wow fadeInUp">
                     <h3 class="section-title">shop by</h3>
                     <div class="widget-header">
                        <h4 class="widget-title">Category</h4>
                     </div>
                     <?php $list =  $this->db->where('is_top','1')->order_by('order','ASC')->from('category')->get()->result();?>
                     <div class="sidebar-widget-body">
                        <div class="accordion">
                           <?php $no=1;
                              foreach($list as $row){?>
                           <div class="accordion-group">
                              <div class="accordion-heading"> <a href="#collapse<?php echo $no?>" data-toggle="collapse" class="accordion-toggle collapsed"> <?php echo $row->name?> </a>
                              </div>
                              <!-- /.accordion-heading -->
                              <div class="accordion-body collapse" id="collapse<?php echo $no?>" style="height: 0px;">
                                 <div class="accordion-inner">
                                    <ul>
                                       <?php $list2 =  $this->db->where('group_id',$row->id)->where('is_top','0')->order_by('order','ASC')->from('category')->get()->result();
                                          foreach($list2 as $rows){
                                          ?>
                                       <li><a href="<?php echo base_url()?>products/category/<?php echo $rows->id?>"><?php echo $rows->name?></a></li>
                                       <?php }?>
                                    </ul>
                                 </div>
                                 <!-- /.accordion-inner --> 
                              </div>
                              <!-- /.accordion-body --> 
                           </div>
                           <?php $no++;}?>
                           <!-- /.accordion-group -->
                           <!-- /.accordion-group -->
                        </div>
                        <!-- /.accordion --> 
                     </div>
                     <!-- /.sidebar-widget-body --> 
                  </div>
                  <!-- /.sidebar-widget --> 
                  <!-- ============================================== SIDEBAR CATEGORY : END ============================================== --> 
                  <!-- /.sidebar-widget --> 
                  <!-- ============================================== COMPARE: END ============================================== --> 
                  <!-- ============================================== PRODUCT TAGS ============================================== -->
                  <!----------- Testimonials------------->
                
                  <!-- ============================================== Testimonials: END ============================================== -->
               </div>
               <!-- /.sidebar-filter --> 
            </div>
            <br><br>
            <div class="sidebar-module-container">
              <div class="home-banner outer-top-n">
                <?php $img1= $this->db->where('id',6)->from('ckeditor_content')->get()->row();?>
                <?php echo $img1->des;?>
                </div>    
               <!-- ============================================== HOT DEALS ============================================== -->
               <div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
                  <h3 class="section-title">hot deals</h3>
                  <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
                    <?php $q5 = $this->db->from('product')->where('sale',1)->order_by('add_date','DESC')->limit(5)->get()->result();

                  foreach($q5 as $valsx){

                    $que = $this->db->where('id_product',$valsx->id)->from('product_price')->get()->row();
                  ?>

                     <div class="item">
                        <div class="products">
                           <div class="hot-deal-wrapper">
                              <div class="image">
                                <a href="<?php echo site_url("products/detail/$valsx->id");?>"> <img src="<?php echo base_url("images/product/$valsx->picture_1"); ?>" alt=""></a>
                              </div>
                                 <?php if($que->discount_rate!=0.00){?>
                              <div class="sale-offer-tag"><span><?php echo $que->discount_rate?>%<br>off</span></div>
                           <?php }?>
                           </div>
                           <!-- /.hot-deal-wrapper -->
                           <div class="product-info text-left m-t-20">
                              <h3 class="name"><a href="<?php echo site_url("products/detail/$valsx->id");?>"><?php echo $valsx->name?></a></h3>

                               <h3 class="name"><?= getField('id','name',$valsx->brand_id,'brand')?></h3>
                              
                               <div class="product-price"> <span class="price"><?php  if($que->price_after_discount!=0.00){?>
                              <span class="price">Rp. <?php echo number_format($que->price_after_discount,0,'.',',')?></span><br> <span class="price-before-discount">Rp. <?php echo number_format($que->price,0,'.',',')?></span>
                              <?php } else {?>
                              <span class="price">Rp. <?php echo number_format($que->price,0,'.',',')?></span>
                              <?php }?></span> </div>
                              <!-- /.product-price -->
                           </div>
                           <!-- /.product-info -->
                           <div class="cart clearfix animate-effect">
                              <div class="action">
                                 <div class="add-cart-button btn-group">
                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                    <i class="fa fa-shopping-cart"></i>                                                 
                                    </button>
                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                 </div>
                              </div>
                              <!-- /.action -->
                           </div>
                           <!-- /.cart -->
                        </div>
                     </div>
                   
                   <?php }?>
                  </div>
                  <!-- /.sidebar-widget -->
               </div>
               <!-- ============================================== HOT DEALS: END ============================================== -->                   
               <!-- ============================================== NEWSLETTER ============================================== -->
               <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
                  <h3 class="section-title">Newsletters</h3>
                  <div class="sidebar-widget-body outer-top-xs">
                     <p>Sign Up for Our Newsletter!</p>
                     <form>
                        <div class="form-group">
                           <label class="sr-only" for="exampleInputEmail1">Email address</label>
                           <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
                        </div>
                        <button class="btn btn-primary">Subscribe</button>
                     </form>
                  </div>
                  <!-- /.sidebar-widget-body -->
               </div>
               <!-- /.sidebar-widget -->
               <!-- ============================================== NEWSLETTER: END ============================================== -->
               <!-- ============================================== Testimonials============================================== -->
               
               <!-- ============================================== Testimonials: END ============================================== -->
            </div>
         </div>
         <!-- /.sidebar -->
         <div class='col-md-9'>
            <div class="detail-block">
               <div class="row  wow fadeInUp">
                  <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                     <div class="product-item-holder size-big single-product-gallery small-gallery">
                        <div id="owl-single-product">

                             <div class="single-product-gallery-item" id="slide1">
                                <a target="_blank" href="<?php echo base_url("images/product/$product->picture_1"); ?>">
                                    <img class="img-responsive" alt="" src="<?php echo base_url("images/product/$product->picture_1"); ?>" data-echo="<?php echo base_url("images/product/$product->picture_1"); ?>" />
                                </a>
                            </div>

                             <?php

                            $query = "select * from product_images where id_product = " . $product->id;
                            $rs    = mysqli_query($connection,$query);
                            $no=2;
                            while ($productImg = mysqli_fetch_object($rs)) {
                            ?>
                           <div class="single-product-gallery-item" id="slide<?php echo $no?>">
                              <a data-lightbox="image-1" data-title="Gallery" href="<?php echo base_url("images/product/$productImg->picture"); ?>g">
                              <img class="img-responsive" alt="" src="<?php echo base_url("images/product/$productImg->picture"); ?>" data-echo="<?php echo base_url("images/product/$productImg->picture"); ?>" />
                              </a>
                           </div>
                            <?php $no++;
                            }?>
                          
                           <!-- /.single-product-gallery-item -->
                        </div>
                        <!-- /.single-product-slider -->
                        <div class="single-product-gallery-thumbs gallery-thumbs">
                           <div id="owl-single-product-thumbnails">

                               <?php

                            $querys = "select * from product_images where id_product = " . $product->id;
                            $rss    = mysqli_query($connection,$querys);
                            $nox=2;
                            while ($productImgx = mysqli_fetch_object($rss)) {
                            ?>
                              <div class="item">
                                 <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="<?php echo $nox?>" href="#slide<?php echo $nox?>">
                                 <img class="img-responsive" width="85" alt="" src="<?php echo base_url("images/product/$productImgx->picture"); ?>" data-echo="<?php echo base_url("images/product/$productImgx->picture"); ?>" />
                                 </a>
                              </div>
                             <?php $nox++;
                            }?>
                           </div>
                           <!-- /#owl-single-product-thumbnails -->
                        </div>
                        <!-- /.gallery-thumbs -->
                     </div>
                     <!-- /.single-product-gallery -->
                  </div>
                  <!-- /.gallery-holder -->                
                  <?php $count = $this->db->where('id_product',$product->id)->count_all_results('diskusi');?>
                  <div class='col-sm-6 col-md-7 product-info-block'>
                     <div class="product-info">
                        <h4 class="name"><?php echo $product->name?></h4>

                        <h3 class="name">Brand : <?= getField('id','name',$product->brand_id,'brand')?></h3>

                        <?php if($product->new_arrival==1){?>
                          <button class="btn-primary">New</button>
                        <?php }?>
                        <?php if($product->sale==1){?>
                          <button class="btn-primary">Sale</button>
                        <?php }?>
                        <?php if($product->bundling==1){?>
                          <button class="btn-primary">Bundling</button>
                        <?php }?>
                        
                        <div class="rating-reviews m-t-20">
                           <div class="row">
                              <!-- <div class="col-sm-3">
                                 
                              </div> -->
                              <div class="col-sm-8">
                                 <div class="reviews">
                                    <a href="#" class="lnk">(<?php echo $count?> Reviews)</a>
                                 </div>
                              </div>
                           </div>
                           <!-- /.row -->        
                        </div>
                        <!-- /.rating-reviews -->
                        <div class="stock-container info-container m-t-10">
                           <div class="row">
                              <div class="col-sm-2">
                                 <div class="stock-box">
                                    <?php if($product->stock<=0){?>
                                            <span class="label">Stock empty</span>
                                    <?php } else {?>
                                            <span class="label">Availability : <font style="color:red"><?php echo $product->stock ?> Pcs remaining</font></span>
                                            
                                    <?php }?>
                                          <span style="font-size:12px;color:#CCCCCC;">
                                          <span class="label">View: <?= $view;?></span><br>
                                          <?php if($product->product_status != "1"){?>
                                          <span name="inactive_product" class="label" style="margin-bottom:10px;cursor:none" > Tidak Aktif</span>
                                          <?php } ?>

                                          <?php if($product->update_by!=0){?>
                                           <!--
										   <span class="label">Disediakan oleh: <?= getField('id','nama',$product->update_by,'user');?></span>
										   -->
                                           <?php } else {?>
                                              <span class="label">Disediakan oleh: </span>
                                          <?php }?>
                                          <br>   
                                         <span class="label"> Added :
                                          <?php echo date("d-m-Y H:i:s", strtotime($product->add_date));?>
                                            </span> 

                                    
                                 </div>
                              </div>
                             <!--  <div class="col-sm-9">
                                 <div class="stock-box">
                                    <span class="value">In Stock</span>
                                 </div>
                              </div> -->
                           </div>
                           <!-- /.row -->    
                        </div>
                        <!-- /.stock-container -->
                        <div class="description-container m-t-20">
                           <?php echo $product->sinopsis;?>
                        </div>
                        <!-- /.description-container -->
                        <!-- <div class="price-container info-container m-t-20">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="price-box">
                                    <?php  $que = $this->db->where('id_product',$product->id)->from('product_price')->get()->row();
                                    ?>
                                    

                                    <span class="price">Rp. <?php echo number_format($que->price,0,'.',',')?></span><br>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="favorite-button m-t-10">
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                    <i class="fa fa-heart"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                    <i class="fa fa-signal"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                    <i class="fa fa-envelope"></i>
                                    </a>
                                 </div>
                              </div>
                           </div>

                        </div> -->
                        <!-- /.price-container -->
                        <form action="<?php echo base_url()?>setting/proses_cart" method="post" enctype="multipart/form-data">
                         <input name="id" type="hidden" id="id" value="<?php echo $product->id?>" />
                         <input name="summ" type="hidden" id="summ"/>
                         <input name="weight" type="hidden" id="weight" value="<?php echo $product->weight/1000?>" />
                       
					   
					    <div class="quantity-container info-container">
                           <div class="row">
                             <div class="col-sm-12">
                                <h4>Choose Varian :</h4>
<table width="100%"  style="border:#FF0000 1px dotted;
  border-radius: 10em;
   ">
    <tr>
        <td valign="top" colspan="2">
            <input name="field_price" type="hidden" id="field_price" value="<?php echo 0 ?>" />
            <?php if ($totalPrice > 5) { ?>
            <div style="">
            <?php } ?>
            <table 
                id="list_product_price" 
                cellpadding="0" 
                cellspacing="0" 
                border="0" 
                style="font-size:12px;    border-collapse:collapse" 
                width="100%"
            >
                <?php
                $counter = 1;
                while($rowprice = mysqli_fetch_object($queryprice)) {
                    $is_use_discount = 0;
                    $variantName = '';
                    
                    if ($rowprice->product_year != '') {
                        $variantName .= "Tahun: {$rowprice->product_year}<br>";
                    }
                    
                    if ($rowprice->product_type != '') {
                        $variantName .= "Tipe: {$rowprice->product_type}<br>";
                    }
                    
                    if ($rowprice->color_name != '') {
                        $variantName .= "{$rowprice->color_name}<br>";  
                    } 
                ?>
                    <tr class="product_price_row <?php if ($counter == 1) echo 'selected_price' ?>">
                        <td width="30" align="center" valign="top" style="padding:3px 2px 2px 2px; border:#CCCCCC 1px solid; border-radius: 10px;  border-collapse:collapse; ">
                              <?php
                              $final=0;
                               if ($rowprice->discount_rate  != "" && $rowprice->discount_value=="" ) {

                                 $var1 = $rowprice->price * $rowprice->discount_rate;

                                 $var2 = $var1 / 100;
                                 $final = $rowprice->price - $var2;
                                
                              } else if ($rowprice->discount_rate  == "" && $rowprice->discount_value!="" ) {
                                 $final = $rowprice->price - $rowprice->discount_value;
                              } else {
                                 $final = $rowprice->price;
                              }?>

                                <input 
                                    data-minqty="<?php echo $rowprice->minimum_qty;?>" 
                                    data-stoktersedia="<?php echo $rowprice->stok_tersedia;?>" 
                                    variant-name="<?php echo $variantName ?>" 
                                    variant-price="<?php echo $final ?>" 
                                    type="radio" 
                                    name="id_product_price" 
                                    value="<?php echo $rowprice->id?>" 
                                    <?php if ($counter == 1) echo 'checked' ?> 
                                    onClick="removeContactMessage();setSelectedPrice(this);" 
                                    style="margin-top:0px; "/>
                           
                        </td>
                        <td width="150" align="left" valign="top" style="padding:1px 1px 1px 1px; border:#CCCCCC 1px solid; border-radius: 10px;  border-collapse:collapse; ">
                            <?php
                            if ($rowprice->product_year != '') echo 'Tahun : '.$rowprice->product_year.'<br>';
                            if ($rowprice->product_type != '') echo 'Tipe : '.$rowprice->product_type.'<br>';
                            echo 'Min Order : ' . $rowprice->minimum_qty . '<br>';
                            if ($rowprice->color_name != '') echo $rowprice->color_name.' <span style="background-color:#'.$rowprice->color_hex.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br>';
                            ?>
                        </td>
                        <td width="140" align="left" valign="top" style="padding:3px 2px 2px 2px; border:#CCCCCC 1px solid; border-radius: 10px; border-collapse:collapse; color:#FF9999; font-size:16px;font-weight:bold; "><?php

                              if ($rowprice->is_active == 1) {
                                if ($rowprice->discount_period_to == '0000-00-00' && $rowprice->discount_period_from != '0000-00-00') {
                                    $is_use_discount = 1;
                                } else if ($rowprice->discount_period_to != '0000-00-00' && $rowprice->discount_period_from == '0000-00-00') {
                                    if ($rowprice->discount_period_to >= ('Y-m-d')) $is_use_discount = 1;
                                } else if ($rowprice->discount_period_to != '0000-00-00' && $rowprice->discount_period_from != '0000-00-00') {
                                    if ($rowprice->discount_period_from <= ('Y-m-d') && $rowprice->discount_period_to >= ('Y-m-d')) $is_use_discount = 1;
                                }
                              }
                              if ($rowprice->discount_rate  != "" && $rowprice->discount_value=="" ) {

                                 $var1 = $rowprice->price * $rowprice->discount_rate;

                                 $var2 = $var1 / 100;
                                 $final = $rowprice->price - $var2;

                                echo 'Rp. <span style="text-decoration:line-through; font-size:14px;">'.number_format($rowprice->price, 0).'</span> <span style="color:#FF0000; font-weight:bold; font-size:14px;">'.number_format($final, 0).'</span><br>';
                                echo '<span style=" font-size:14px;color:#000;font-weight:normal; "> Disc : '.($rowprice->discount_rate != '' ? $rowprice->discount_rate.'%' : 'Rp. '.number_format($rowprice->discount_value, 0));
                              } else if ($rowprice->discount_rate  == "" && $rowprice->discount_value!="" ) {

                                 $final = $rowprice->price - $rowprice->discount_value;


                                echo 'Rp. <span style="text-decoration:line-through; font-size:14px;">'.number_format($rowprice->price, 0).'</span> <span style="color:#FF0000; font-weight:bold; font-size:14px;">'.number_format($final, 0).'</span><br>';
                                echo '<span style=" font-size:14px;color:#000;font-weight:normal; "> Disc : '.($rowprice->discount_rate != '' ? $rowprice->discount_rate.'%' : 'Rp. '.number_format($rowprice->discount_value, 0));
                              }else {
                                echo 'Rp. '.number_format($rowprice->price, 0);
                              }
                              ?>
                                <?php if($rowprice->price == 0){
                                    $callPrice = true;
                                echo '</br><span style=" font-size:12px; color:red;"> Please Call:  
                                
                                
                     <br>
+62 819-3499-9930


                                <br>(021) 2257 1892 </span><br> ';
                                 }?>
                                      </td>
                                    </tr>
                                    <?php
                                        $counter++;
                                    }
                                    ?>
                                  </table>
                                  <?php if ($totalPrice > 5) { ?>
                                </div>
                                <?php } ?>
                                <br>
                              </td>
                            </tr>
                            <tr>
                              <td width="170"><span class="style18">Quantity</span> :</td>
                              <td>
							  
							  <input name="field_quantity" type="number" id="field_quantity" min="1" value="1" size="3" maxlength="2" style="border:#CCCCCC 1px solid; border-radius: 10px; "  />
                              <span class="style22">pcs</span> 
							  
							  </td>
                            </tr>
                            <tr>
                              <td class="style18">Weight /pcs :</td>
                              <td><?php echo $product->weight/1000 ?> <span class="style22">kg</span> </td>
                            </tr>
                        </table>
                             </div>
							 
						
							 
                             <div class="col-sm-12">
                                 <?php
                                        $addonsQuery = mysqli_query($connection,"SELECT * FROM product_addons where product_id = {$product->id}");
                                        $addons = [];
                                        
                                        while ($addon = mysqli_fetch_object($addonsQuery)) {
                                            $addons[] = $addon;
                                        }
                                    ?>
                                    <div id="addon-container" style="margin-top: 2rem;">
                                        <h5>Addon: </h5>
                                        
                                        <div style="border: 5px solid #c3d7e2; padding: 2rem">
                                            
                                            
                                            <?php
                                            if (count($addons)): ?>
                                                <span id="addon-status" style="color: red; font-weight: bold">No Need Addon: Rp. 0</span>
                                                <?php
                                                foreach ($addons as $key => $addon): ?>
                                                <div>
                                                    <input 
                                                        type="checkbox" 
                                                        name="addons[]" 
                                                        value="<?php echo $addon->id ?>" 
                                                        price="<?php echo $addon->price ?>"
                                                        addon-name="<?php echo $addon->name ?>"
                                                    >
                                                    <?php echo $addon->name ?>:
                                                    <strong style="color: #FF9900">RP. <?php echo number_format($addon->price) ?></strong>
                                                </div>
                                                <div>
                                                    <p style="display: none"><?php echo $addon->description ?></p>
                                                    <a href="javascript:void(0)" class="btn-lihat-detil">Lihat Detil</a>
                                                </div>
                                                <?php
                                                endforeach;
                                            else: ?>
                                            No addon
                                            <?php
                                            endif ?>
                                        </div>
                                    </div>
                              </div>

                              <div class="col-sm-12">
                                <div id="summary-container" style="margin-top: 2rem;">
                                    <h5>Summary:</h5>
                                    
                                    <div style="border: 5px solid #c3d7e2; padding: 2rem">
                                        <ol>
                                            <li>
                                                <div>
                                                    Nama Produk:
                                                    <ul id="summary-product">
                                                        <li>Loading</li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    Addon:
                                                    <ul id="summary-addon-list">
                                                        <li>Tidak ada</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ol>
                                        <div id="summary-ppn">
                                            PPN: Loading..
                                        </div>
                                        <div id="summary-total">
                                            Total: Loading..
                                        </div>
                                    </div>
                                </div>
                              </div>
							  
							  
							 
                             
                              <div class="col-md-10" align="right">
                                  <br>
								  
								  <div class="add-cart-button btn-group">
									
									
									<button type="submit" class="btn btn-primary" style="padding-right:10px;"><i class="fa fa-shopping-cart"></i>	Buy Now</button>
									
									<button type="submit" class="btn btn-secondary"><a href="#"  s onclick="addWishList(<?=$product->id?>);"><i class="fa fa-heart"></i>  WISHLIST</a></button>
<!--									
<button type="button" class="btn btn-success"> <a href="#"  onclick="addWishList(<?=$product->id?>);"> Beli Di Tokopedia</a></button>
-->

<?php if($productItem->linktokopedia != "") { ?>
                              
                               <button type="button" class="btn btn-success">
                                 <a href="<?php echo $productItem->linktokopedia;?>" target="_blank" > BELI DI TOKOPEDIA</a>
                             
                            <?php }?>
									<!--
									<button class="btn btn-primary cart-btn" type="submit" value="BUY NOW" >BUY NOW</button>
								   
								   <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Wishlis</button>
								   
									<button class="btn btn-primary cart-btn" type="submit" value="ADD TO WISHLIST" > <a href="#" class="btn btn-danger" style="width:250px;margin-left:30%;" onclick="addWishList(<?=$product->id?>);"><i class="fa fa-heart"></i> Beli Di Tokopedia</a></button>-->
																
								</div>
								
								
								
								
								<!--
									<button class="btn btn-primary cart-btn" type="submit" value="ADD TO WISHLIST" > <a href="#" class="btn btn-danger" style="width:250px;margin-left:30%;" onclick="addWishList(<?=$product->id?>);"><i class="fa fa-heart"></i> ADD TO WISHLIST</a></button>
									
                                   <button  type="submit" value="BUY NOW" name="submit" class="btn btn-success" style="width:250px;margin-left:30%;"><i class="fa fa-shopping-cart inner-right-vs"></i>BUY NOW</button>
								   -->
                              </div>


                             <!--  <div class="col-sm-2">
                                 <span class="label">Qty :</span>
                              </div>
                              <div class="col-sm-2">
                                 <div class="cart-quantity">
                                    <div class="quant-input">
                                       <div class="arrows">
                                          <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                          <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                       </div>
                                       <input type="text" value="1">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-7">
                                 <a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
                              </div> -->
                           </div>
                           <!-- /.row -->
                        </div>
                        </form>
                        <!-- /.quantity-container -->
                     </div>
                     <!-- /.product-info -->
                  </div>
                  <!-- /.col-sm-7 -->
               </div>
               <!-- /.row -->
            </div>
            <div class="product-tabs inner-bottom-xs  wow fadeInUp">
               <div class="row">
                  <div class="col-sm-3">
                     <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                     
                        <li class="active"><a data-toggle="tab" href="#description">SPESIFICATION</a></li>
                        <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                        <li><a data-toggle="tab" href="#tags">DISKUSI (<?= $count?>)</a></li>
                     </ul>
                     <!-- /.nav-tabs #product-tabs -->
                  </div>
                  <div class="col-sm-9">
                     <div class="tab-content">
                        <div id="description" class="tab-pane in active">
                           <div class="product-tab">
                              <p class="text"><?php echo $product->description?></p>
                           </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div id="review" class="tab-pane">
                           <div class="product-tab">
                             
                              <!-- /.product-reviews -->
                              <div class="product-add-review">
                                 <h4 class="title">Costumer review</h4>
                                 <div class="review-table" >
                               
                                    <?php

if (empty($_REQUEST['currPage'])) {

    $_REQUEST['currPage'] = 1;

}

if (empty($_REQUEST['currSection'])) {

    $_REQUEST['currSection'] = 1;

}

$currPage       = $_REQUEST['currPage'];

$currSection    = $_REQUEST['currSection'];

$dataPerPage    = 10;

$dataPerSection = 4;

$startRow       = ($currPage - 1) * $dataPerPage;

$startRow       = ($currPage - 1) * $dataPerPage;

$rev            = mysqli_query($connection,"SELECT * FROM review WHERE product_id = '" . $product->id . "' AND status = '1'");

if (mysqli_num_rows($rev) == 0) {

    echo '

                                            <div class="col-xs-12">

                                           No Review Yet

                                            </div>

                                        ';

} else {

    $no = $startRow + 1;

    while ($star = mysqli_fetch_object($rev)) {

        //$trx  = mysqli_fetch_object(mysqli_query($connection,"SELECT * FROM `transaction` WHERE `id` = '{$star->order_id}'"));

        $user = mysqli_fetch_object(mysqli_query($connection,"SELECT * FROM `member` WHERE `id` = '{$star->user_id}'"));

        ?>
        							<br><br>
                                    <div class="col-xs-12">
                                        <br>
                                        Name: <strong><?=$user->first_name;?> <?=$user->last_name;?></strong><br>

                                        <!-- Order Date: <strong><?=$trx->confirm_cart_date;?></strong><br> -->

                                        Star:

                                        <span class="star-rating">

                                            <?php for ($x = 1; $x <= $star->star; $x++) {?>

                                                <i class="fa fa-star" aria-hidden="true"></i>

                                            <?php }?>

                                        </span>

                                        <br>

                                        Comment:<br>

                                        <div class="review"><?=$star->comment;?></div>

                                    </div>

                                    <?php }}?>

                                    <!-- /.table-responsive -->
                                 </div>
                                 <!-- /.review-table -->
                                 
                                 <!-- /.review-form -->
                              </div>
                              <!-- /.product-add-review -->                                     
                           </div>
                           <!-- /.product-tab -->
                        </div>
                        <!-- /.tab-pane -->
                        <div id="tags" class="tab-pane">
                           <div class="product-tag">
                              <table border="0" style="margin-left:2%;table-layout:fixed;" width="75%" >
                                  
                                  <tbody>
                                    <?php foreach($diskusi as $row1){?>
                                    <tr>
                                      <th style="text-align: left;"  colspan="2"><?php echo getField('id','first_name',$row1->user_id,'member').' '.getField('id','last_name',$row1->user_id,'member')  ?></th>
                                    
                                    </tr>
                                    <tr>
                                            <td colspan="2" style="width:30%"><?php echo $row1->wording?><br><br>
                                            </td>
                                            <?php if($this->session->userdata('id')==$row1->user_id){?>
                                                <td>&nbsp;</td>
                                           <!--  <td><form action="<?php echo base_url()?>setting/delete_diskusi2" method="post" enctype="multipart/form-data">
                                                         <input type="hidden" name="id_product" value="<?php echo $product->id?>">
                                                         <input type="hidden" name="id" value="<?php echo $row1->id?>">
                                                     
                                                        <button type="submit" name="button_submit" class="btn-danger" style="margin-left:-250px" >
                                                        Delete</button>
                                                    </form><br><br></td> -->
                                            <?php } else if($this->session->userdata('email')!=""){?>
                                            <td><form action="<?php echo base_url()?>setting/report_diskusi2" method="post" enctype="multipart/form-data">
                                                         <input type="hidden" name="id_product" value="<?php echo $product->id?>">
                                                         <input type="hidden" name="id_detail" value="<?php echo $row1->id?>">
                                                         <input type="hidden" name="user_id" value="<?php echo $row1->user_id?>">
                                                     
                                                        <button type="submit" name="button_submit" class="btn-warning">
                                                        Report</button>
                                                    </form><br><br></td>
                                            <?php }  else {?>
                                                    <td>&nbsp;</td>
                                                <?php }?>
                                      
                                      <?php
                                        $this->db->where('id_product',$row1->id_product);
                                        $this->db->where('id_diskusi',$row1->id);
                                                $this->db->where('deleted',0);
                        $this->db->order_by('tgl_diskusi', 'ASC');
                        $diskusi_detail = $this->db->get('diskusi_detail')->result();
                                       foreach($diskusi_detail as $row2){?>
                                       <tr>
                                        <th style="text-align: center;" colspan="2"><?php echo getField('id','first_name',$row2->user_id,'member').' '.getField('id','last_name',$row2->user_id,'member')  ?></th>
                                        
                                      </tr>
                                      <tr >
                                        <td>&nbsp;</td>
                                        <td width="100"><?php echo $row2->wording?>
                                                <br><br>
                                        </td>
                                                <?php if($this->session->userdata('id')==$row2->user_id){?>
                                                    <td>&nbsp;</td>
                                              <!--   <td><form action="<?php echo base_url()?>setting/delete_diskusi" method="post" enctype="multipart/form-data">
                                                         <input type="hidden" name="id_product" value="<?php echo $product->id?>">
                                                         <input type="hidden" name="id_detail" value="<?php echo $row2->id_detail?>">
                                                     
                                                        <button type="submit" name="button_submit" class="btn-danger" >
                                                        Delete</button>
                                                    </form><br><br></td> -->
                                                <?php } else if($this->session->userdata('email')!="") {?>
                                                   <td><form action="<?php echo base_url()?>setting/report_diskusi" method="post" enctype="multipart/form-data">
                                                         <input type="hidden" name="id_product" value="<?php echo $product->id?>">
                                                         <input type="hidden" name="id_detail" value="<?php echo $row2->id_detail?>">
                                                         <input type="hidden" name="id" value="<?php echo $row1->id?>">
                                                         <input type="hidden" name="user_id" value="<?php echo $row2->user_id?>">
                                                     
                                                        <button type="submit" name="button_submit" class="btn-warning">
                                                        Report</button>
                                                    </form><br><br></td>
                                                <?php } else {?>
                                                    <td>&nbsp;</td>
                                                <?php }?>
                                                
                                                
                                      </tr>
                                      <?php }?>
                                      <tr >
                                        <td>&nbsp;</td>
                                        <td width="100">
                                          <br>
                                           <form action="<?php echo base_url()?>setting/diskusi_detail" method="post" enctype="multipart/form-data">
                                             <input type="hidden" name="id_product" value="<?php echo $product->id?>">
                                             <input type="hidden" name="id_detail" value="<?php echo $row1->id?>">
                                                         <input type="hidden" name="user_id" value="<?php echo $row1->user_id?>">
                                            <p>



                                              <textarea placeholder="Isi komentar disini" cols="40" rows="2" name="wordings"></textarea>



                                            </p>
                                            <br>
                                            <input type="submit" value="Kirim" name="button_submit" class="btn btn-success" style="margin-left:60%;margin-top:-20%;">
                                            <br><br>
                                        </form>
                                        </td>
                                      </tr>
                                      <!-- <tr>
                                        <th style="text-align: center;" colspan="2">Rudy Wicaksono</th>
                                        
                                      </tr>
                                      <tr >
                                        <td>&nbsp;</td>
                                        <td width="100">apakah barang ini bisa menggunakan bla bla bla ya itu dia masalahnya apa kah bisa saudaraku? apakah barang ini bisa menggunakan bla bla bla ya itu dia masalahnya apa kah bisa saudaraku?<br><br>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th style="text-align: center;" colspan="2">Rudy Wicaksono</th>
                                        
                                      </tr>
                                      <tr >
                                        <td>&nbsp;</td>
                                        <td width="100">apakah barang ini bisa menggunakan bla bla bla ya itu dia masalahnya apa kah bisa saudaraku? apakah barang ini bisa menggunakan bla bla bla ya itu dia masalahnya apa kah bisa saudaraku?
                                        </td>
                                      </tr>
                                      <tr >
                                        <td>&nbsp;</td>
                                        <td width="100">
                                          <br>
                                           <form action="<?php echo base_url()?>setting/delivery_type" method="post" enctype="multipart/form-data">

                                            <p>



                                              <textarea placeholder="Isi komentar disini" cols="40" rows="2"></textarea>



                                            </p>

                                            <input type="submit" value="Kirim" name="button_submit" class="btn btn-success" style="margin-left:60%;margin-top:-20%;">
                                            <br><br>
                                        </form>
                                        </td>
                                      </tr> -->
                                      
                                      
                                      
                                    </tr>
                                    
                                    <?php }?>

                                  </tbody>
                                </table>

                                <br>
                                 <form action="<?php echo base_url()?>setting/diskusi_add" method="post" enctype="multipart/form-data">
                                 <input type="hidden" name="id_product" value="<?php echo $product->id?>">
                                <p>



                                  <br><br>
                                  <textarea placeholder="Apa yang ingin anda tanyakan tentang produk ini?" cols="70" rows="8" style="margin-left: -5%" name="wording"></textarea>



                                </p>

                                <input type="submit" value="Kirim" name="button_submit" class="btn btn-success" style="margin-left:60%;">
                                <br><br>
                            </form>
                              <!-- /.form-cnt -->
                            
                              <!-- /.form-cnt -->
                           </div>
                           <!-- /.product-tab -->
                        </div>
                        <!-- /.tab-pane -->
                     </div>
                     <!-- /.tab-content -->
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.product-tabs -->
            <!-- ============================================== UPSELL PRODUCTS ============================================== -->
            <section class="section featured-product wow fadeInUp">
               <h3 class="section-title">Related Product</h3>
               
               <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                 <?php $q1 = $this->db->from('product')->where('category_id',$product->category_id)->order_by('add_date','DESC')->limit(15)->get()->result();

                  foreach($q1 as $val){

                    $que = $this->db->where('id_product',$val->id)->from('product_price')->get()->row();

                    ?>
                  <div class="item item-carousel">
                     <div class="products">
                        <div class="product">
                           <div class="product-image">
                              <div class="image">
                                 <a href="<?php echo site_url("products/detail/$val->id");?>"><img  src="<?php echo base_url("images/product/$val->picture_1"); ?>" alt=""></a>
                              </div>
                              <!-- /.image -->          
                           </div>
                           <!-- /.product-image -->
                           <div class="product-info text-left">
                              <h3 class="name"><a href="<?php echo site_url("products/detail/$val->id");?>"><?php echo $val->name?></a></h3>
                              
                              <div class="description"></div>
                               <div class="product-price"> <span class="price"><?php  if($que->price_after_discount!='0.00'){?>
                              <span class="price">Rp. <?php echo number_format($que->price_after_discount,0,'.',',')?></span><br> <span class="price-before-discount">Rp. <?php echo number_format($que->price,0,'.',',')?></span>
                              <?php } else {?>
                              <span class="price">Rp. <?php echo number_format($que->price,0,'.',',')?></span>
                              <?php }?></span> </div>
                              <!-- /.product-price -->
                           </div>
                           <!-- /.product-info -->
                          
                           <!-- /.cart -->
                        </div>
                        <!-- /.product -->
                     </div>
                     <!-- /.products -->
                  </div>
                <?php }?>
                  <!-- /.item -->
                  
                  <!-- /.item -->
               </div>
               <!-- /.home-owl-carousel -->
            </section>
            <!-- /.section -->
            <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
         </div>
         <!-- /.col -->
         <div class="clearfix"></div>
      </div>
      <!-- /.row -->
      <!-- ============================================== BRANDS CAROUSEL ============================================== -->
      <div id="brands-carousel" class="logo-slider wow fadeInUp">
         <div class="logo-slider-inner">
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
               <div class="item m-t-15">
                  <a href="#" class="image">
                  <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                  </a>    
               </div>
               <!--/.item-->
               <div class="item m-t-10">
                  <a href="#" class="image">
                  <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                  </a>    
               </div>
               <!--/.item-->
               <div class="item">
                  <a href="#" class="image">
                  <img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
                  </a>    
               </div>
               <!--/.item-->
               <div class="item">
                  <a href="#" class="image">
                  <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                  </a>    
               </div>
               <!--/.item-->
               <div class="item">
                  <a href="#" class="image">
                  <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                  </a>    
               </div>
               <!--/.item-->
               <div class="item">
                  <a href="#" class="image">
                  <img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
                  </a>    
               </div>
               <!--/.item-->
               <div class="item">
                  <a href="#" class="image">
                  <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                  </a>    
               </div>
               <!--/.item-->
               <div class="item">
                  <a href="#" class="image">
                  <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                  </a>    
               </div>
               <!--/.item-->
               <div class="item">
                  <a href="#" class="image">
                  <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                  </a>    
               </div>
               <!--/.item-->
               <div class="item">
                  <a href="#" class="image">
                  <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                  </a>    
               </div>
               <!--/.item-->
            </div>
            <!-- /.owl-carousel #logo-slider -->
         </div>
         <!-- /.logo-slider-inner -->
      </div>
      <!-- /.logo-slider -->
      <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->    
   </div>
   <!-- /.container -->
</div>
<!-- /.body-content -->
<?php $this->load->view('front-footer');?>

<script>
    function popitup(url,w,h)
    {
      LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
      TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
      newwindow=window.open(url,'name','height='+h+',width='+w+',left=' + LeftPosition + ',top=' + TopPosition +'');
      if (window.focus) {
          newwindow.focus()
      }
      
      return false;
    }

    // Contact To Buy Action //

    function contactToBuy(){
        $("#contact-number").focus();
        $("#contact-message").collapse('show');
        $("#addtocart_button").addClass("disabled");
        $("#field_quantity").attr("disabled","disabled");
    }

    function removeContactMessage(){
        $("#addtocart_button").removeClass("disabled");
        $("#field_quantity").removeAttr("disabled","disabled");
        $("#contact-message").collapse('hide');
    }

    function setSelectedPrice(){
        var minqty = $('input[name=id_product_price]:checked').data("minqty");
        $("#field_quantity").val(minqty);
    }
    
    setSelectedPrice();



    // add Widh List
    function addWishList(id){
        <?php if($this->session->userdata('email')!="") {?>
        $.post("<?php echo base_url()?>setting/add_wishlist",{product_id:id,varian:$('input[name=id_product_price]:checked').val()},function(data){
            alert("Added to wishlist");
        });
        <?php }else{?>
            alert("Please Login First");
            window.location.href="<?php echo base_url()?>beranda/login";
        <?php }?>
    }

</script>

<script>
    // script untuk price variant
    let priceRadios = document.querySelectorAll('[name=id_product_price]')
    // lanjutannya ada di script untuk summary
</script>
                        
<script>
    // script untuk addon
    let btnLihatDetils = document.querySelectorAll('.btn-lihat-detil')
    let addonCheckboxes = document.querySelectorAll('#addon-container input[type=checkbox]')
    let selectedAddons = []
    const spanAddonStatus = document.querySelector('#addon-status')
    
    btnLihatDetils.forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (btn.innerText === 'Lihat Detil') {
                btn.parentNode.querySelector('p').style.display = 'block'
                btn.innerText = 'Sembunyikan'
            } else {
                btn.parentNode.querySelector('p').style.display = 'none'
                btn.innerText = 'Lihat Detil'
            }
        })
    })
    
    addonCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', (e) => {
            // cek apakah sudah terselect atau tidak
            let addonIndex = selectedAddons.findIndex(_addon => _addon.id == checkbox.value)
            
            if (addonIndex > -1) {
                // kalau sudah maka dihapus
                selectedAddons.splice(addonIndex, 1)
            } else {
                // tambahkan
                selectedAddons.push({
                    id: checkbox.value,
                    price: parseInt(checkbox.getAttribute('price')),
                    name: checkbox.getAttribute('addon-name')
                })
            }
            
            // hitung harga dan ganti teks
            let harga = 0
            selectedAddons.forEach(addon => {
                harga += addon.price
            })
            
            if (selectedAddons.length) {
                spanAddonStatus.innerText = `${selectedAddons.length} addons: Rp. ${harga.toLocaleString()}`
            } else {
                spanAddonStatus.innerText = `No need addons: Rp. 0`
            }
        })
    })
</script>

<script>
    // script untuk summary
    const summaryContainer = document.querySelector('#summary-container')
    const summaryAddonList = summaryContainer.querySelector('#summary-addon-list')
    const summaryProduct = summaryContainer.querySelector('#summary-product li')
    const summaryPPN = summaryContainer.querySelector('#summary-ppn')
    const summaryTotal = summaryContainer.querySelector('#summary-total')
    let selectedVariant = document.querySelector('input[name=id_product_price]:checked');
    const fieldQty = document.querySelector('#field_quantity')
    const ppn = <?php echo @$ppn->percent ?: false ?>
    
    summaryProduct.innerHTML = selectedVariant.getAttribute('variant-name') + 
                                '<strong style="color: #FF9900">Rp. ' + 
                                parseInt(selectedVariant.getAttribute('variant-price')).toLocaleString() +
                                '</strong>' + 
                                '<div id="summary-qty">Qty: ' + fieldQty.value + '</div>'
                                
    function summaryTampilkanHarga () {
        let total = 0
        let tax = 0
        let qty = fieldQty.value
      
        selectedVariant = document.querySelector('input[name=id_product_price]:checked');

        let price = parseInt(selectedVariant.getAttribute('variant-price'))
        
        // re-query for selected variant
       

        
        total += price * qty
        
        // tambahkan dari addon
        selectedAddons.forEach(addon => {
            total += addon.price
        })
        
        if (!ppn || ppn <= 0) {
            summaryPPN.innerText = 'PPN: Tidak ada ppn'
        } else {
            tax = total * ppn / 100
            summaryPPN.innerText = `PPN (${ppn}%): `
            let strong = document.createElement('strong')
            strong.style.color = '#FF9900'
            strong.innerText = `Rp. ${tax.toLocaleString()}`
            
            summaryPPN.appendChild(strong)
        }
        
        total += tax
        
        let strong = document.createElement('strong')
        strong.style.color = '#FF9900'
        strong.innerText = `Rp. ${total.toLocaleString()}`
        summaryTotal.innerText = 'Total: '
        summaryTotal.appendChild(strong)
        document.getElementById('summ').value=total
    }
    
    summaryTampilkanHarga() 

    fieldQty.addEventListener('change', (e) => {
        document.querySelector('#summary-qty').innerText = `Qty: ${fieldQty.value}`
        summaryTampilkanHarga()
    })
    
    addonCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', (e) => {
            console.log(selectedAddons)
            
            // clear summary addon list
            while (summaryAddonList.lastChild) {
                summaryAddonList.removeChild(summaryAddonList.lastChild)
            }
            
            // terus isi lagi dengan selectedAddons
            selectedAddons.forEach(addon => {
                let li = document.createElement('li')
                li.innerText = `${addon.name}: `
                
                let strong = document.createElement('strong')
                strong.innerText = `Rp. ${addon.price.toLocaleString()}`
                strong.style.color = '#FF9900'
                
                li.appendChild(strong)
                summaryAddonList.appendChild(li)
            })
            
            // kalau addon tidak ada yg dipilih
            if (selectedAddons.length < 1) {
                let li = document.createElement('li')
                li.innerText = 'Tidak ada'
                
                summaryAddonList.appendChild(li)
            }
            
            summaryTampilkanHarga()
        })
    })
    
    
    priceRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            let strong = document.createElement('strong')
            let divQty = document.createElement('div')
            let variantPrice = parseInt(radio.getAttribute('variant-price'))
            
            strong.innerText = `Rp. ${variantPrice.toLocaleString()}`
            strong.style.color = '#FF9900'
            divQty.setAttribute('id', 'summary-qty')
            divQty.innerText = `Qty: ${fieldQty.value}`
            
            summaryProduct.innerHTML = radio.getAttribute('variant-name')
            summaryProduct.appendChild(strong)
            summaryProduct.appendChild(divQty)
            summaryTampilkanHarga()
        })
    })
</script>