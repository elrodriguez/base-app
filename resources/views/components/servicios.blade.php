<div>

<!--service-->
<section id="service" class="service-section bg_op_1 position-relative"
   style="background: url({{ asset('themes/kentha/assets/images/home-13-service-bg.jpg')}});"> 
   <!--===============spacing==============-->
   <div class="pd_top_90"></div>



   
   <!--===============spacing==============-->
   <div class="auto-container">
      <div class="row">
         <div class="col-lg-8 m-auto">
            <div class="title_all_box style_six text-center light_color">
               <div class="title_sections">
                  <div class="before_title">
                     <span class="icon-briefcase icon"></span>
                     {{ $titles[0]->item->content }}
                  </div>
                  <div class="title"> {{ $titles[1]->item->content }}</div>
                  <p class="description_text">
                     {{ $titles[2]->item->content }}
                  </p>
               </div>
               <div class="pd_bottom_20"></div>
            </div>
         </div>
      </div>
      
      <div class="row">
        <div class="col-lg-12">
           <div class="service_all_styles carousel owl_new_one">
              <div class="owl_nav_none owl_dots_none owl_type_two theme_carousel owl-theme owl-carousel owl-loaded owl-drag" data-options="{&quot;loop&quot;: true, &quot;margin&quot;: 30, &quot;autoheight&quot;:true, &quot;lazyload&quot;:true, &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000, &quot;smartSpeed&quot;: 1800, &quot;responsive&quot;:{ &quot;0&quot; :{ &quot;items&quot;: &quot;1&quot; }, &quot;768&quot; :{ &quot;items&quot; : &quot;3&quot; } , &quot;1000&quot;:{ &quot;items&quot; : &quot;3&quot; }}}">

                 

                 

                 

                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(-1950px, 0px, 0px); transition: all 1.8s ease 0s; width: 3510px;">
                    
                        @foreach ($data as $k => $group) 
                        <div class="owl-item cloned" style="width: 360px; margin-right: 30px;">
                            <div class="service_box  type_one clearfix">
                                <div class="image_box">
                                    <img src="{{ $group->item->items[0]->content }}" class="img-fluid" alt="img">
                                    <div class="overlay"></div>
                                </div>
                                <div class="content_box">
                                <div class="icon_box clearfix">

                                <div class="icon_box_inner">
                                    <i class="icon icon-thumbs-up icon"></i>
                                </div>

                                </div>
                                <h2 class="entry-title">
                                <a href="">{{ $group->item->items[1]->content }}</a>
                                </h2>
                                <p>{{ $group->item->items[2]->content }}</p>

                                    {{-- <a rel="nofollow" class="theme-btn one service-toggler"> Leer Más </a>  OCULTO --}}
                                    {{-- Modal de boostrap para cargar la descripciópn del servicio {{ $group->item->items[3]->content }} --}}
                                
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                 <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"><button role="button" class="owl-dot active"><span></span></button></div></div>
           </div>
        </div>
     </div>
   </div>
   <!--===============spacing==============-->
   <div class="pd_bottom_90"></div>
   <!--===============spacing==============-->
   <div class="position_absolute curve_shape_bottom_1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="none">
                     <path class="shape_bg_white"
                        d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7	s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7	c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3	c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6	c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7	C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5	c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1	c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7	c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6	C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8	c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2	C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3	C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1	z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1	c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z">
                     </path>
                     <path class="shape_bg_white"
                        d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C267.7,18.8,269.7,18,269.6,18z">
                     </path>
                     <path class="shape_bg_white"
                        d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2	S227.6,9.9,227.4,9.8z">
                     </path>
                     <path class="shape_bg_white"
                        d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4	C206.4,12.9,204.6,13.5,204.5,13.4z">
                     </path>
                     <path class="shape_bg_white"
                        d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6	S201,10.7,201,10.6z">
                     </path>
                     <path class="shape_bg_white"
                        d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C152.6,27.5,154.6,26.8,154.5,26.7z">
                     </path>
                     <path class="shape_bg_white"
                        d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6	c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z">
                     </path>
                     <path class="shape_bg_white"
                        d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0	C76.9,11.5,75.3,12.5,75.5,12.6z">
                     </path>
                     <path class="shape_bg_white"
                        d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4	C19.9,13.7,15.7,13.3,15.6,13.2z">
                     </path>
                  </svg>
   </div>
</section>
   <!-- MODAL -->

   <div class="modal_popup one modal_popup_service">
      <div class="modal-popup-inner">
          <div class="close-modal close-modal-service"><i class="fa fa-times"></i></div>
          <div class="modal_box">
              <div class="row">
                  <div class="col-lg-5 col-md-12 form_inner">
                      <div class="form_content">
                          

                      </div>
                  </div>
                  <div class="col-lg-7 col-md-12 about_company_inner">
                      <div class="abt_content">
                          <div class="logo">
                              <img src="{{ asset('themes/kentha/assets/images/HVAC_logo.png') }}" alt="img"
                                  class="Logo_Kentha">
                          </div>
                          <div class="text">
                              <p> AQUI!!!!!!
                              </p>
                              <a href="nosotros">Sobre Nosotros</a>
                          </div>


                          <div class="social_media_v_one style_two">
                              <ul>
                                  <li>
                                      <a href="asdasdasd">
                                          <span class="fa fa-facebook"></span>
                                          <small>facebook</small>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="asd">
                                          <span class="fa fa-instagram"></span>
                                          <small>instagram</small>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="asd">
                                          <span class="fa fa-twitter"></span>
                                          <small>twitter</small>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="asd">
                                          <span class="fa fa-linkedin"></span>
                                          <small>Linkedin</small>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="asd">
                                          <span class="fa fa-youtube-play"></span>
                                          <small>Youtube</small>
                                      </a>
                                  </li>
                              </ul>
                          </div>

                          <div class="pd_bottom_40"></div>
                          <div class="copright">
                              © 2023 Aracode Perú. Todos los derechos reservados.
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

   <!-- END MODAL -->>
<!--service end-->
</div>