<?php $this->load->view('pages/header');?>


<div data-elementor-type="wp-page" data-elementor-id="47" class="elementor elementor-47">
         <section class="elementor-section elementor-top-section elementor-element elementor-element-9a8cf00 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="9a8cf00" data-element_type="section">
            <div class="elementor-container elementor-column-gap-no">
               <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-27158c4" data-id="27158c4" data-element_type="column">
                  <div class="elementor-widget-wrap elementor-element-populated">
                     <div class="elementor-element elementor-element-4d728de elementor--h-position-left elementor--v-position-middle elementor-widget elementor-widget-slides" data-id="4d728de" data-element_type="widget" data-settings="{&quot;navigation&quot;:&quot;none&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;transition&quot;:&quot;slide&quot;,&quot;transition_speed&quot;:500}" data-widget_type="slides.default">
                        <div class="elementor-widget-container">
                           <style>/*! elementor-pro - v3.6.4 - 15-03-2022 */ .elementor-slides .swiper-slide-bg{background-size:cover;background-position:50%;background-repeat:no-repeat;min-width:100%;min-height:100%}.elementor-slides .swiper-slide-inner{background-repeat:no-repeat;background-position:50%;position:absolute;top:0;left:0;bottom:0;right:0;padding:50px;margin:auto}.elementor-slides .swiper-slide-inner,.elementor-slides .swiper-slide-inner:hover{color:#fff;display:-webkit-box;display:-ms-flexbox;display:flex}.elementor-slides .swiper-slide-inner .elementor-background-overlay{position:absolute;z-index:0;top:0;bottom:0;left:0;right:0}.elementor-slides .swiper-slide-inner .elementor-slide-content{position:relative;z-index:1;width:100%}.elementor-slides .swiper-slide-inner .elementor-slide-heading{font-size:35px;font-weight:700;line-height:1}.elementor-slides .swiper-slide-inner .elementor-slide-description{font-size:17px;line-height:1.4}.elementor-slides .swiper-slide-inner .elementor-slide-description:not(:last-child),.elementor-slides .swiper-slide-inner .elementor-slide-heading:not(:last-child){margin-bottom:30px}.elementor-slides .swiper-slide-inner .elementor-slide-button{border:2px solid #fff;color:#fff;background:transparent;display:inline-block}.elementor-slides .swiper-slide-inner .elementor-slide-button,.elementor-slides .swiper-slide-inner .elementor-slide-button:hover{background:transparent;color:inherit;text-decoration:none}.elementor--v-position-top .swiper-slide-inner{-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start}.elementor--v-position-bottom .swiper-slide-inner{-webkit-box-align:end;-ms-flex-align:end;align-items:flex-end}.elementor--v-position-middle .swiper-slide-inner{-webkit-box-align:center;-ms-flex-align:center;align-items:center}.elementor--h-position-left .swiper-slide-inner{-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start}.elementor--h-position-right .swiper-slide-inner{-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end}.elementor--h-position-center .swiper-slide-inner{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}body.rtl .elementor-widget-slides .elementor-swiper-button-next{left:10px;right:auto}body.rtl .elementor-widget-slides .elementor-swiper-button-prev{right:10px;left:auto}.elementor-slides-wrapper div:not(.swiper-slide)>.swiper-slide-inner{display:none}@media (max-width:767px){.elementor-slides .swiper-slide-inner{padding:30px}.elementor-slides .swiper-slide-inner .elementor-slide-heading{font-size:23px;line-height:1;margin-bottom:15px}.elementor-slides .swiper-slide-inner .elementor-slide-description{font-size:13px;line-height:1.4;margin-bottom:15px}}</style>
                           <div class="elementor-swiper">
                              <div class="elementor-slides-wrapper elementor-main-swiper swiper-container" dir="ltr" data-animation="fadeInUp">
                                 <div class="swiper-wrapper elementor-slides">

                                    <?php foreach($list as $row){?>

                                        <div class="elementor-repeater-item swiper-slide" style="background-image: url(<?php echo base_url()?>backend/assets/upload/slider/<?php echo $row->filename?>);
    background-size: cover;">
                                       <div class="swiper-slide-bg"></div>
                                       <div class="swiper-slide-inner" >
                                          <div class="swiper-slide-contents">

                                             <div class="elementor-slide-heading"><?=$row->heading?></div>
                                             <div class="elementor-slide-description"><?=$row->caption?></div>
                                             <?php if($row->btn_title!=""){?>
                                                   <div onclick="window.open('<?php echo $row->btn_link?>', '_blank');" class="elementor-button elementor-slide-button elementor-size-md"><?=$row->btn_title?></div>
                                             <?php }?>
                                             
                                          </div>
                                       </div>
                                    </div>

                                    <?php }?>
                                   
                                  
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section class="elementor-section elementor-top-section elementor-element elementor-element-9872f4d elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="9872f4d" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
               <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-92267e1" data-id="92267e1" data-element_type="column">
                  <div class="elementor-widget-wrap elementor-element-populated">
                     <div class="elementor-element elementor-element-cc8d400 elementor-arrows-position-inside elementor-pagination-position-outside elementor-widget elementor-widget-image-carousel" data-id="cc8d400" data-element_type="widget" data-settings="{&quot;navigation&quot;:&quot;both&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;infinite&quot;:&quot;yes&quot;,&quot;speed&quot;:500}" data-widget_type="image-carousel.default">
                        <div class="elementor-widget-container">
                           <style>.elementor-widget-image-carousel .swiper,.elementor-widget-image-carousel .swiper-container{position:static}.elementor-widget-image-carousel .swiper-container .swiper-slide figure,.elementor-widget-image-carousel .swiper .swiper-slide figure{line-height:inherit}.elementor-widget-image-carousel .swiper-slide{text-align:center}.elementor-image-carousel-wrapper:not(.swiper-container-initialized):not(.swiper-initialized) </style>
                           <div class="elementor-image-carousel-wrapper swiper" dir="ltr">
                              <div class="elementor-image-carousel swiper-wrapper">

                                  <?php foreach($promo as $row){?>

                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <div class="swiper-slide">
                                    <figure class="swiper-slide-inner">
                                       <img decoding="async" class="swiper-slide-image" src="<?php echo base_url()?>backend/assets/upload/promo_slider/<?php echo $row->filename?>" alt="<?php echo $row->filename?>" /></figure>
                                 </div>
                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <?php }?>
                                
                               
                              </div>
                              <div class="elementor-swiper-button elementor-swiper-button-prev" role="button" tabindex="0">                         <i aria-hidden="true" class="eicon-chevron-left"></i>                       <span class="elementor-screen-only">Previous image</span>                   </div>
                              <div class="elementor-swiper-button elementor-swiper-button-next" role="button" tabindex="0">                         <i aria-hidden="true" class="eicon-chevron-right"></i>                      <span class="elementor-screen-only">Next image</span>                   </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section class="elementor-section elementor-top-section elementor-element elementor-element-3180ffa elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="3180ffa" data-element_type="section" id="tentang" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="elementor-container elementor-column-gap-default">
               <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-168b88f" data-id="168b88f" data-element_type="column">
                  <div class="elementor-widget-wrap elementor-element-populated">
                     <div class="elementor-element elementor-element-4c08658 elementor-widget elementor-widget-heading" data-id="4c08658" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                           <style>.elementor-heading-title{padding:0;margin:0;line-height:1}.elementor-widget-heading .elementor-heading-title[class*=elementor-size-]>a{color:inherit;font-size:inherit;line-height:inherit}.elementor-widget-heading .elementor-heading-title.elementor-size-small{font-size:15px}.elementor-widget-heading .elementor-heading-title.elementor-size-medium{font-size:19px}.elementor-widget-heading .elementor-heading-title.elementor-size-large{font-size:29px}.elementor-widget-heading .elementor-heading-title.elementor-size-xl{font-size:39px}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl{font-size:59px}</style>
                           <h2 class="elementor-heading-title elementor-size-default">Tentang Kami</h2>
                        </div>
                     </div>
                     <div class="elementor-element elementor-element-a59e2b2 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="a59e2b2" data-element_type="widget" data-widget_type="divider.default">
                        <div class="elementor-widget-container">
                           <style>/*! elementor - v3.13.3 - 28-05-2023 */ .elementor-widget-divider{--divider-border-style:none;--divider-border-width:1px;--divider-color:#0c0d0e;--divider-icon-size:20px;--divider-element-spacing:10px;--divider-pattern-height:24px;--divider-pattern-size:20px;--divider-pattern-url:none;--divider-pattern-repeat:repeat-x}.elementor-widget-divider .elementor-divider{display:flex}.elementor-widget-divider .elementor-divider__text{font-size:15px;line-height:1;max-width:95%}.elementor-widget-divider .elementor-divider__element{margin:0 var(--divider-element-spacing);flex-shrink:0}.elementor-widget-divider .elementor-icon{font-size:var(--divider-icon-size)}.elementor-widget-divider .elementor-divider-separator{display:flex;margin:0;direction:ltr}.elementor-widget-divider--view-line_icon .elementor-divider-separator,.elementor-widget-divider--view-line_text .elementor-divider-separator{align-items:center}.elementor-widget-divider--view-line_icon .elementor-divider-separator:after,.elementor-widget-divider--view-line_icon .elementor-divider-separator:before,.elementor-widget-divider--view-line_text .elementor-divider-separator:after,.elementor-widget-divider--view-line_text .elementor-divider-separator:before{display:block;content:"";border-bottom:0;flex-grow:1;border-top:var(--divider-border-width) var(--divider-border-style) var(--divider-color)}.elementor-widget-divider--element-align-left .elementor-divider .elementor-divider-separator>.elementor-divider__svg:first-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-left .elementor-divider-separator:before{content:none}.elementor-widget-divider--element-align-left .elementor-divider__element{margin-left:0}.elementor-widget-divider--element-align-right .elementor-divider .elementor-divider-separator>.elementor-divider__svg:last-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-right .elementor-divider-separator:after{content:none}.elementor-widget-divider--element-align-right .elementor-divider__element{margin-right:0}.elementor-widget-divider:not(.elementor-widget-divider--view-line_text):not(.elementor-widget-divider--view-line_icon) .elementor-divider-separator{border-top:var(--divider-border-width) var(--divider-border-style) var(--divider-color)}.elementor-widget-divider--separator-type-pattern{--divider-border-style:none}.elementor-widget-divider--separator-type-pattern.elementor-widget-divider--view-line .elementor-divider-separator,.elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:after,.elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:before,.elementor-widget-divider--separator-type-pattern:not([class*=elementor-widget-divider--view]) .elementor-divider-separator{width:100%;min-height:var(--divider-pattern-height);-webkit-mask-size:var(--divider-pattern-size) 100%;mask-size:var(--divider-pattern-size) 100%;-webkit-mask-repeat:var(--divider-pattern-repeat);mask-repeat:var(--divider-pattern-repeat);background-color:var(--divider-color);-webkit-mask-image:var(--divider-pattern-url);mask-image:var(--divider-pattern-url)}.elementor-widget-divider--no-spacing{--divider-pattern-size:auto}.elementor-widget-divider--bg-round{--divider-pattern-repeat:round}.rtl .elementor-widget-divider .elementor-divider__text{direction:rtl}.e-con-inner>.elementor-widget-divider,.e-con>.elementor-widget-divider{width:var(--container-widget-width,100%);--flex-grow:var(--container-widget-flex-grow)}</style>
                           <div class="elementor-divider">          <span class="elementor-divider-separator">                      </span>         </div>
                        </div>
                     </div>
                     <section class="elementor-section elementor-inner-section elementor-element elementor-element-867b35b elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="867b35b" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-default">
                           <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-6f195a6" data-id="6f195a6" data-element_type="column">
                              <div class="elementor-widget-wrap elementor-element-populated">
                                 <div class="elementor-element elementor-element-d9b745d elementor-align-center elementor-widget elementor-widget-button" data-id="d9b745d" data-element_type="widget" data-widget_type="button.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-button-wrapper">           
                                          <a href="./tonggak-sejarah/" class="elementor-button-link elementor-button elementor-size-sm" role="button"> 
                                             <span class="elementor-button-content-wrapper">
                                             <span class="elementor-button-text">Tonggak Sejarah</span>      
                                             </span>                    
                                           </a>        
                                        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-71fa397" data-id="71fa397" data-element_type="column">
                              <div class="elementor-widget-wrap elementor-element-populated">
                                 <div class="elementor-element elementor-element-313b0de elementor-align-center elementor-widget elementor-widget-button" data-id="313b0de" data-element_type="widget" data-widget_type="button.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-button-wrapper">           <a href="./visi-misi/" class="elementor-button-link elementor-button elementor-size-sm" role="button">                      <span class="elementor-button-content-wrapper">                         <span class="elementor-button-text">Visi Misi</span>        </span>                     </a>        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-52f6748" data-id="52f6748" data-element_type="column">
                              <div class="elementor-widget-wrap elementor-element-populated">
                                 <div class="elementor-element elementor-element-6a9a137 elementor-align-center elementor-widget elementor-widget-button" data-id="6a9a137" data-element_type="widget" data-widget_type="button.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-button-wrapper">           <a href="./budaya-perusahaan/" class="elementor-button-link elementor-button elementor-size-sm" role="button">                      <span class="elementor-button-content-wrapper">                         <span class="elementor-button-text">Budaya Perusahaan</span>        </span>                     </a>        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-62dc869" data-id="62dc869" data-element_type="column">
                              <div class="elementor-widget-wrap elementor-element-populated">
                                 <div class="elementor-element elementor-element-33b3253 elementor-align-center elementor-widget elementor-widget-button" data-id="33b3253" data-element_type="widget" data-widget_type="button.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-button-wrapper">           <a href="./sertifikasi/" class="elementor-button-link elementor-button elementor-size-sm" role="button">                        <span class="elementor-button-content-wrapper">                         <span class="elementor-button-text">Sertifikasi</span>      </span>                     </a>        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </section>
                  </div>
               </div>
            </div>
         </section>
         <section class="elementor-section elementor-top-section elementor-element elementor-element-8c83c72 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="8c83c72" data-element_type="section" id="bisnis" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="elementor-container elementor-column-gap-default">
               <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-47853d7" data-id="47853d7" data-element_type="column">
                  <div class="elementor-widget-wrap elementor-element-populated">
                     <div class="elementor-element elementor-element-a5a367c elementor-widget elementor-widget-heading" data-id="a5a367c" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                           <h2 class="elementor-heading-title elementor-size-default">Bisnis Kami</h2>
                        </div>
                     </div>
                     <div class="elementor-element elementor-element-d096411 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="d096411" data-element_type="widget" data-widget_type="divider.default">
                        <div class="elementor-widget-container">
                           <div class="elementor-divider">          <span class="elementor-divider-separator">                      </span>         </div>
                        </div>
                     </div>
                     <section class="elementor-section elementor-inner-section elementor-element elementor-element-72365fa elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="72365fa" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-default">
                           <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-f64ec34" data-id="f64ec34" data-element_type="column">
                              <div class="elementor-widget-wrap elementor-element-populated">
                                 <div class="elementor-element elementor-element-07faa30 elementor--v-position-bottom elementor--h-position-center elementor-arrows-position-inside elementor-pagination-position-inside elementor-widget elementor-widget-slides" data-id="07faa30" data-element_type="widget" data-settings="{&quot;navigation&quot;:&quot;both&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;infinite&quot;:&quot;yes&quot;,&quot;transition&quot;:&quot;slide&quot;,&quot;transition_speed&quot;:500}" data-widget_type="slides.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-swiper">
                                          <div class="elementor-slides-wrapper elementor-main-swiper swiper-container" dir="ltr" data-animation="fadeInUp">
                                             <div class="swiper-wrapper elementor-slides">
                                                <div class="elementor-repeater-item-ea90279 swiper-slide">
                                                   <div class="swiper-slide-bg"></div>
                                                   <div class="swiper-slide-inner" >
                                                      <div class="swiper-slide-contents">
                                                         <div  class="elementor-button elementor-slide-button elementor-size-md">Katalog Produk</div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-0030c72" data-id="0030c72" data-element_type="column">
                              <div class="elementor-widget-wrap elementor-element-populated">
                                 <div class="elementor-element elementor-element-498be07 elementor--v-position-bottom elementor--h-position-center elementor-arrows-position-inside elementor-pagination-position-inside elementor-widget elementor-widget-slides" data-id="498be07" data-element_type="widget" data-settings="{&quot;navigation&quot;:&quot;both&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;infinite&quot;:&quot;yes&quot;,&quot;transition&quot;:&quot;slide&quot;,&quot;transition_speed&quot;:500}" data-widget_type="slides.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-swiper">
                                          <div class="elementor-slides-wrapper elementor-main-swiper swiper-container" dir="ltr" data-animation="fadeInUp">
                                             <div class="swiper-wrapper elementor-slides">
                                                <div class="elementor-repeater-item-ea90279 swiper-slide">
                                                   <div class="swiper-slide-bg"></div>
                                                   <a class="swiper-slide-inner" href="./penjualan-retail/">
                                                      <div class="swiper-slide-contents">
                                                         <div  class="elementor-button elementor-slide-button elementor-size-md">Penjualan Retail</div>
                                                      </div>
                                                   </a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </section>
                  </div>
               </div>
            </div>
         </section>
         <section class="elementor-section elementor-top-section elementor-element elementor-element-14bc04c elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="14bc04c" data-element_type="section" id="purna" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="elementor-container elementor-column-gap-default">
               <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-9777493" data-id="9777493" data-element_type="column">
                  <div class="elementor-widget-wrap elementor-element-populated">
                     <div class="elementor-element elementor-element-0a91d11 elementor-widget elementor-widget-heading" data-id="0a91d11" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                           <h2 class="elementor-heading-title elementor-size-default">Layanan Purna Jual</h2>
                        </div>
                     </div>
                     <div class="elementor-element elementor-element-15b0971 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="15b0971" data-element_type="widget" data-widget_type="divider.default">
                        <div class="elementor-widget-container">
                           <div class="elementor-divider">          <span class="elementor-divider-separator">                      </span>         </div>
                        </div>
                     </div>
                     <div class="elementor-element elementor-element-f776805 elementor-align-center elementor-widget elementor-widget-button" data-id="f776805" data-element_type="widget" data-widget_type="button.default">
                        <div class="elementor-widget-container">
                           <div class="elementor-button-wrapper">           <a href="#" class="elementor-button-link elementor-button elementor-size-sm" role="button">                         <span class="elementor-button-content-wrapper">                         <span class="elementor-button-text">Datascrip Service Center</span>         </span>                     </a>        </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>


         
         <style>
            * {
              box-sizing: border-box;
            }

            /* Create two equal columns that floats next to each other */
            .columns {
              float: left;
              width: 50%;
              padding: 40px;
            }

            /* Clear floats after the columns */
            .rows:after {
              content: "";
              display: table;
              clear: both;
            }

            /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 600px) {
              .columns {
                width: 100%;
              }
            }


            .grid {
              display: grid;
              grid-template-columns: repeat(3, 1fr);
              grid-gap: 10px;
            }

            .grid img {
              width: 100%;
            }


          
            </style>


            <div class="rows">
                 <div class="columns" style="background-color:#0066CC;">
                  <div class="elementor-element elementor-element-0a91d11 elementor-widget elementor-widget-heading" data-id="0a91d11" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                           <h2 class="elementor-heading-title elementor-size-default">Kabar Datascrip</h2>
                            <div class="elementor-element elementor-element-d096411 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="d096411" data-element_type="widget" data-widget_type="divider.default">
                        <div class="elementor-widget-container">
                           <div class="elementor-divider" >          <span class="elementor-divider-separator" style="color:white;">                      </span>         </div>
                        </div>
                     </div>
                        </div>
                     </div>
                  
                   <div class="containers" style="display: flex; height: auto;">
                       <div style="width: 50%; background: white; border-radius: 25px;">
                          
                              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample87.jpg" alt="sample87" />
                             
                              <figcaption>
                              <h4 style="color:black;font-style: normal;padding:10px;font-weight:bold; ">Siap siap Atur Strategi Bisnis, Transisi Pandemi Menuju Endemi</h4>
                              <p style="padding:10px;font-style: normal;">Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface Lorem ipsum is a placeholder text commonly used to demonstrate the visual ....<a href="#" style="color:red">read more</a> </p>
                              </figcaption>
                            
                       </div>
                       &nbsp;&nbsp;
                       <div style="width:50%; background: white; border-radius: 25px;">
                       
                          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample87.jpg" alt="sample87" />
                             
                              <figcaption>
                              <h4 style="color:black;font-style: normal;padding:10px;font-weight:bold; ">Siap siap Atur Strategi Bisnis, Transisi Pandemi Menuju Endemi</h4>
                              <p style="padding:10px;font-style: normal;">Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface Lorem ipsum is a placeholder text commonly used to demonstrate the visual ....<a href="#" style="color:red">read more</a> </p>
                              </figcaption>
                       </div>
                   </div>
                 </div>
                 <div class="columns" style="background-color:#ffffff;">
                   <div class="elementor-element elementor-element-0a91d11 elementor-widget elementor-widget-heading" data-id="0a91d11" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                           <h2 class="elementor-heading-title elementor-size-default" style="color:#0066CC">Media Sosisal</h2>
                            <div class="elementor-element elementor-element-d096411 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="d096411" data-element_type="widget" data-widget_type="divider.default">
                        <div class="elementor-widget-container">
                           <div class="elementor-divider">          <span class="elementor-divider-separator">                      </span>         </div>
                        </div>
                     </div>
                        </div>
                     </div>

                     <div class="grid">
                          <img src="https://via.placeholder.com/600x400.jpg">
                          <img src="https://via.placeholder.com/600x400.jpg">
                          <img src="https://via.placeholder.com/600x400.jpg">
                          <img src="https://via.placeholder.com/600x400.jpg">
                          <img src="https://via.placeholder.com/600x400.jpg">
                          <img src="https://via.placeholder.com/600x400.jpg">
                        </div>

                 </div>
               </div>

               <br>
               <style type="text/css"> 
                #mybtns {
                  text-align: center;
                   display: inline-block;
                }
                
                button {
                 
                }

                #btns{
                   border-radius: 30px 30px 30px 30px;background-color: var(--e-global-color-713731b );border-style: solid;
                   border-width: 2px 2px 2px 2px;font-size: 23px;
                   font-weight: 500;
                }
               </style>

             
                  <section class="elementor-section elementor-inner-section elementor-element elementor-element-867b35b elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="867b35b" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-default">
                           <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-6f195a6" data-id="6f195a6" data-element_type="column">
                             &nbsp;
                           </div>
                           <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-71fa397" data-id="71fa397" data-element_type="column">
                              <div class="elementor-widget-wrap elementor-element-populated">
                                 <div class="elementor-element elementor-element-313b0de elementor-align-center elementor-widget elementor-widget-button" data-id="313b0de" data-element_type="widget" data-widget_type="button.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-button-wrapper">           <a href="./visi-misi/" class="elementor-button-link elementor-button elementor-size-sm" role="button">                      <span class="elementor-button-content-wrapper">                         <span class="elementor-button-text">OLS Portal System</span>        </span>                     </a>        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-52f6748" data-id="52f6748" data-element_type="column">
                              <div class="elementor-widget-wrap elementor-element-populated">
                                 <div class="elementor-element elementor-element-6a9a137 elementor-align-center elementor-widget elementor-widget-button" data-id="6a9a137" data-element_type="widget" data-widget_type="button.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-button-wrapper">           <a href="./budaya-perusahaan/" class="elementor-button-link elementor-button elementor-size-sm" role="button">                      <span class="elementor-button-content-wrapper">                         <span class="elementor-button-text">e-Surduk</span>        </span>                     </a>        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-62dc869" data-id="62dc869" data-element_type="column">
                              &nbsp;
                           </div>
                        </div>
                     </section>

      </div>

      <br><br>

 <?php $this->load->view('pages/footer');?>


