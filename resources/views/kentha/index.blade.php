@extends('layouts.kentha')

@section('content')
    <div id="page" class="page_wapper hfeed site">
        <div class="style-switcher">
            <a href="#" id="switcher-toggler"><i class="fa fa-cog"></i></a>
            <h3>Color Skins</h3>
            <ul id="colorschemeOptions" title="Switch Color"
                data-css-path="{{ asset('themes/kentha/assets/css/scss/elements/color-switcher/') }}">
                <li>
                    <a href="#" data-theme="color" style="background-color: #078586;"> </a>
                </li>
                <li>
                    <a href="#" data-theme="color1" style="background-color: #e5102a;"> </a>
                </li>
                <li>
                    <a href="#" data-theme="color2" style="background-color: #3ead3c;"> </a>
                </li>
                <li>
                    <a href="#" data-theme="color3" style="background-color: #fed000;"> </a>
                </li>
                <li>
                    <a href="#" data-theme="color4" style="background-color: #ff5538;"> </a>
                </li>
                <li>
                    <a href="#" data-theme="color5" style="background-color: #246af4;"> </a>
                </li>
            </ul>
        </div>
        <div id="wrapper_full" class="content_all_warpper">
            <!----page-header----->
            <div class="mini_cart_togglers fixed_cart">
                <div class="mini-cart-count">
                    0
                </div>
                <i class="icon-shopping-cart"></i>
            </div>
            <!----preloader----->
            <div class="preloader-wrap">
                <div class="preloader"
                    style="background-image:url({{ asset('themes/kentha/assets/images/preloader.gif') }})">
                </div>
                <div class="overlay"></div>
            </div>
            <!----preloader end----->
            <!----header----->
            <x-header-area />
            <!----header end----->
            <!--===============PAGE CONTENT==============-->
            <!--===============PAGE CONTENT==============-->
            <div id="content" class="site-content ">

                <!--- slider-->
                <section class="slider style_page_thirteen nav_position_one position-relative">
                    <div class="banner_carousel owl-carousel owl_nav_block owl_dots_none theme_carousel owl-theme"
                        data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 7000, "smartSpeed": 1800, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "1" } , "1000":{ "items" : "1" }}}'>

                        <div class="slide-item-content">
                            <div class="slide-item content_center">
                                <div class="image-layer"
                                    style="background-image:url(assets/images/sliders/slider-home-13-1.jpg)">
                                </div>
                                <div class="medium-container">
                                    <div class="row align-items-center">
                                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 m-auto">
                                            <div class="slider_content">
                                                <h6 class="animate_left">
                                                    Strategy & Planning
                                                </h6>
                                                <h1 class="animate_up">
                                                    The Fastest
                                                    Way to Achieve Success
                                                </h1>
                                                <p class="animate_right pd_bottom_40">
                                                    Who are so beguiled and demoralized the charms Long established fact
                                                    <br> that a
                                                    reader will be distracted
                                                </p>
                                                <ul class="animate_down">
                                                    <li class="theme_btn_all color_two">
                                                        <a href="#" class="theme-btn one">Our Service</a>
                                                    </li>
                                                    <li class="theme_btn_all ">
                                                        <a href="#" class="theme-btn one color_white">Projects</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide-item-content">
                            <div class="slide-item content_left">
                                <div class="image-layer"
                                    style="background-image:url(assets/images/sliders/slider-home-13-2.jpg)">
                                </div>
                                <div class="medium-container">
                                    <div class="row align-items-center">
                                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                            <div class="slider_content">
                                                <h6 class="animate_left">
                                                    Solutions for your business
                                                </h6>
                                                <h1 class="animate_up">
                                                    Performance and Productivity

                                                </h1>
                                                <p class="animate_right pd_bottom_40">
                                                    Who are so beguiled and demoralized the charms Long established fact
                                                    <br> that a
                                                    reader will be distracted

                                                </p>
                                                <ul class="animate_down">
                                                    <li class="theme_btn_all">
                                                        <a href="#" class="theme-btn one">Our Service</a>
                                                    </li>
                                                    <li class="theme_btn_all">
                                                        <a href="#" class="theme-btn one color_white">Projects</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide-item-content">
                            <div class="slide-item content_center">
                                <div class="image-layer"
                                    style="background-image:url(assets/images/sliders/slider-home-13-2.jpg)">
                                </div>
                                <div class="medium-container">
                                    <div class="row align-items-center">
                                        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 m-auto">
                                            <div class="slider_content">
                                                <h6 class="animate_left">
                                                    Solutions for your business
                                                </h6>
                                                <h1 class="animate_up">
                                                    Searching HR software for your business?
                                                </h1>
                                                <p class="animate_right pd_bottom_40">
                                                    Who are so beguiled and demoralized the charms Long established fact
                                                    <br> that a
                                                    reader will be distracted
                                                </p>
                                                <ul class="animate_down">
                                                    <li class="theme_btn_all color_two">
                                                        <a href="#" class="theme-btn one">Our Service</a>
                                                    </li>
                                                    <li class="theme_btn_all">
                                                        <a href="#" class="theme-btn one color_white">Projects</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position_absolute curve_shape_bottom_1 z_99">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="none">
                            <path class="elementor-shape-fill"
                                d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7	s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7	c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3	c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6	c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7	C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5	c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1	c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7	c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6	C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8	c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2	C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3	C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1	z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1	c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C267.7,18.8,269.7,18,269.6,18z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2	S227.6,9.9,227.4,9.8z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4	C206.4,12.9,204.6,13.5,204.5,13.4z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6	S201,10.7,201,10.6z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C152.6,27.5,154.6,26.8,154.5,26.7z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6	c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0	C76.9,11.5,75.3,12.5,75.5,12.6z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4	C19.9,13.7,15.7,13.3,15.6,13.2z">
                            </path>
                        </svg>
                    </div>
                </section>
                <!---slider-end--->
                <!--about-->
                <section class="about-section">
                    <!--===============spacing==============-->
                    <div class="pd_top_70"></div>
                    <!--===============spacing==============-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="image_box_new type_one clearfix">
                                    <div class="image_one">
                                        <img src="{{ asset('themes/kentha/assets/images/about/about-11.jpg') }}"
                                            class="img-fluid height_570px object-fit-cover" alt="img">

                                        <div class="year_experience">
                                            <h2>10+ Years Of experience</h2>
                                        </div>

                                    </div>
                                    <div class="video_box video-inner text-center">
                                        <a href="https://youtu.be/RN81h85V6D4" class="lightbox-image">
                                            <i class="icon-play"></i>
                                        </a>
                                    </div>
                                    <div class="image_two">
                                        <img src="assets/images/about/about-9.jpg" class="img-fluid" alt="img">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="title_all_box style_six  dark_color">
                                    <div class="title_sections">
                                        <div class="before_title">
                                            <span class="icon-briefcase icon"></span>
                                            ABOUT US
                                        </div>
                                        <div class="title"> Take Your Business To The Next Level</div>
                                        <p class="description_text">
                                            Over 20 years of experience we’ll ensure you always get the best
                                            . We serve a clients at every level of their organization we can be most useful,
                                            whether
                                            as a trusted advisor to top trusted our management.
                                        </p>
                                    </div>
                                </div>

                                <!--===============spacing==============-->
                                <div class="pd_bottom_25"></div>
                                <!--===============spacing==============-->
                                <div class="row gutter_25px">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="icon_box_new_box type_one">
                                            <div class="icon_bx">
                                                <img src="assets/images/idea.png" class="img-fluid svg_image"
                                                    alt="icon png">
                                                <span class="icon_bg"></span>
                                            </div>

                                            <div class="text_box">

                                                <h2><a target="_blank" rel="nofollow" href="#">Creative
                                                        Work</a>
                                                </h2>
                                                <p>A creative work is a manifestation of creative effort including fine
                                                    artwork</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="icon_box_new_box type_one">
                                            <div class="icon_bx">
                                                <img src="assets/images/solution.png" class="img-fluid svg_image"
                                                    alt="icon png">
                                                <span class="icon_bg"></span>
                                            </div>

                                            <div class="text_box">

                                                <h2><a target="_blank" rel="nofollow" href="#">Best
                                                        Solution</a>
                                                </h2>
                                                <p>Consult Solution is a dynamic, multipurpose, elegant and modern corporate
                                                    and
                                                    business.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--===============spacing==============-->
                                <div class="pd_bottom_30"></div>
                                <!--===============spacing==============-->

                                <div class="row gutter_25px">
                                    <div class="col-lg-4 col-md-4 col-ms-12">
                                        <div class="theme_btn_all color_one">
                                            <a href="#" target="_blank" rel="nofollow" class="theme-btn one">
                                                Learn More </a>
                                        </div>
                                        <!--===============spacing==============-->
                                        <div class="pd_bottom_25"></div>
                                        <!--===============spacing==============-->
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <div class="image">
                                            <img src="assets/images/sign.png" class="img-fluid" alt="img" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--===============spacing==============-->
                    <div class="pd_bottom_80"></div>
                    <!--===============spacing==============-->
                </section>
                <!---about end-->
                <!--client-->
                <section class="client-section text-center bg_op_1"
                    style="background: url(assets/images/home-13-client-bg.jpg);">
                    <!--===============spacing==============-->
                    <div class="pd_top_60"></div>
                    <!--===============spacing==============-->
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                <div class="swiper-container"
                                    data-swiper='{
                         "autoplay": {
                           "delay": 6000
                         },
                         "freeMode": true,
                         "loop": true,
                         "speed": 1000,
                         "centeredSlides": false,
                         "slidesPerView": 5,
                         "spaceBetween": 30,
                         "pagination": {
                           "el": ".swiper-pagination",
                           "clickable": true
                         },
                          
                         "breakpoints": {
                            "1200": {
                               "slidesPerView": 5
                            },
                            "1024": {
                             "slidesPerView": 4
                            },
                           "768": {
                             "slidesPerView": 3
                           },
                           "576": {
                             "slidesPerView": 2 
                           },
                           "250": {
                             "slidesPerView": 2 
                           },
                           "0": {
                             "slidesPerView": 1 
                           }
                         }
                       }'>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="image">
                                                <img src="assets/images/cecode-brand-1.png" alt="clients-logo"
                                                    class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="image">
                                                <img src="assets/images/cecode-brand-2.png" alt="clients-logo"
                                                    class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="image">
                                                <img src="assets/images/cecode-brand-3.png" alt="clients-logo"
                                                    class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="image">
                                                <img src="assets/images/cecode-brand-4.png" alt="clients-logo"
                                                    class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="image">
                                                <img src="assets/images/cecode-brand-5.png" alt="clients-logo"
                                                    class="img-fluid" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--===============spacing==============-->
                    <div class="pd_bottom_60"></div>
                    <!--===============spacing==============-->
                </section>
                <!---client end-->
                <!--service-->
                <section class="service-section bg_op_1 position-relative"
                    style="background: url(assets/images/home-13-service-bg.jpg);">
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
                                            OUR SERVICES
                                        </div>
                                        <div class="title"> We Offer Different Services</div>
                                        <p class="description_text">
                                            There are many variations of passages of Lorem Ipsum available,
                                            but the majority have suffered alteration in some form believable.
                                        </p>
                                    </div>
                                    <!--===============spacing==============-->
                                    <div class="pd_bottom_20"></div>
                                    <!--===============spacing==============-->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="service_all_styles carousel owl_new_one">
                                    <div class="owl_nav_none owl_dots_none owl_type_two theme_carousel owl-theme owl-carousel"
                                        data-options='{"loop": true, "margin": 30, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 7000, "smartSpeed": 1800, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "3" } , "1000":{ "items" : "3" }}}'>

                                        <div class="service_box  type_one clearfix">
                                            <div class="image_box">
                                                <img src="assets/images/service/service-image-6.jpg" class="img-fluid"
                                                    alt="img" />
                                                <div class="overlay"></div>
                                            </div>
                                            <div class="content_box">
                                                <div class="icon_box clearfix">

                                                    <div class="icon_box_inner">
                                                        <i class="icon icon-thumbs-up icon"></i>
                                                    </div>

                                                </div>
                                                <h2 class="entry-title">
                                                    <a href="service-details.html">Talent Management</a>
                                                </h2>
                                                <p>Once your company has hired the best employees, the next step.</p>
                                                <a href="service-details.html" class="read_more type_one">
                                                    <span class="icon-arrow-right"></span>
                                                    Read More
                                                </a>
                                            </div>
                                        </div>

                                        <div class="service_box  type_one clearfix">
                                            <div class="image_box">
                                                <img src="assets/images/service/service-image-5.jpg" class="img-fluid"
                                                    alt="img" />
                                                <div class="overlay"></div>
                                            </div>
                                            <div class="content_box">
                                                <div class="icon_box clearfix">

                                                    <div class="icon_box_inner">
                                                        <i class="icon icon-thumbs-up icon"></i>
                                                    </div>

                                                </div>
                                                <h2 class="entry-title">
                                                    <a href="service-details.html">Health Care Benefits
                                                    </a>
                                                </h2>
                                                <p>Workplace conflict can become a costly and time-consuming process .</p>
                                                <a href="service-details.html" class="read_more type_one">
                                                    <span class="icon-arrow-right"></span>
                                                    Read More
                                                </a>
                                            </div>
                                        </div>

                                        <div class="service_box  type_one clearfix">
                                            <div class="image_box">
                                                <img src="assets/images/service/service-image-4.jpg" class="img-fluid"
                                                    alt="img" />
                                                <div class="overlay"></div>
                                            </div>
                                            <div class="content_box">
                                                <div class="icon_box clearfix">
                                                    <div class="icon_box_inner">
                                                        <i class="icon icon-thumbs-up icon"></i>
                                                    </div>
                                                </div>
                                                <h2 class="entry-title"><a href="service-details.html">Risk
                                                        Management</a></h2>
                                                <p>Mitigate workplace issues before they escalate ,Shared Time Human.</p>
                                                <a href="service-details.html" class="read_more type_one">
                                                    <span class="icon-arrow-right"></span>
                                                    Read More
                                                </a>
                                            </div>
                                        </div>

                                    </div>
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
                <!--service end-->

                <!--content-->
                <section class="content-section">
                    <!--===============spacing==============-->
                    <div class="pd_top_50"></div>
                    <!--===============spacing==============-->
                    <div class="auto-container">
                        <div class="row">
                            <div class="col-lg-8 m-auto">
                                <div class="title_all_box style_six text-center">
                                    <div class="title_sections">
                                        <div class="before_title">
                                            <span class="icon-briefcase icon"></span>
                                            CHOICES & OCCURS
                                        </div>
                                        <div class="title">Why People Choose us</div>
                                        <p class="description_text">
                                            Explain to you how all this mistaken idea of denouncing pleasure and praising
                                            pain was
                                            born and I will give you a complete account of the system.
                                        </p>
                                    </div>
                                    <!--===============spacing==============-->
                                    <div class="pd_bottom_20"></div>
                                    <!--===============spacing==============-->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="choose_box  type_one">
                                    <div class="image_box">
                                        <img src="assets/images/24-hours-support.png" class="img-fluid svg_image"
                                            alt="icon png">
                                    </div>
                                    <div class="content_box">
                                        <span class="step_no">01</span>
                                        <div class="text_box">
                                            <h2>
                                                <a href="#" target="_blank">
                                                    24/7 support </a>
                                            </h2>
                                            <p>Alienssa pentalim ex arcu, ac ultricies tortor ultricies pellentesque.</p>

                                            <a href="#" class="read_more type_one" target="_blank">
                                                Read More <span class="icon-arrow-right"></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="choose_box  type_one">
                                    <div class="image_box">
                                        <img src="assets/images/email-marketing.png" class="img-fluid svg_image"
                                            alt="icon png">
                                    </div>
                                    <div class="content_box">
                                        <span class="step_no">02</span>
                                        <div class="text_box">
                                            <h2>
                                                <a href="#" target="_blank">
                                                    Quick Response </a>
                                            </h2>
                                            <p>Alienssa pentalim ex arcu, ac ultricies tortor ultricies pellentesque.</p>

                                            <a href="#" class="read_more type_one" target="_blank">
                                                Read More <span class="icon-arrow-right"></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="choose_box  type_one">
                                    <div class="image_box">
                                        <img src="assets/images/team-management.png" class="img-fluid svg_image"
                                            alt="icon png">
                                    </div>
                                    <div class="content_box">
                                        <span class="step_no">03</span>
                                        <div class="text_box">
                                            <h2>
                                                <a href="#" target="_blank">
                                                    Experience Team </a>
                                            </h2>
                                            <p>Alienssa pentalim ex arcu, ac ultricies tortor ultricies pellentesque.</p>

                                            <a href="#" class="read_more type_one" target="_blank">
                                                Read More <span class="icon-arrow-right"></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="choose_box  type_one">
                                    <div class="image_box">
                                        <img src="assets/images/solution-1.png" class="img-fluid svg_image"
                                            alt="icon png">
                                    </div>
                                    <div class="content_box">
                                        <span class="step_no">04</span>
                                        <div class="text_box">
                                            <h2>
                                                <a href="#" target="_blank">
                                                    Smart solutions </a>
                                            </h2>
                                            <p>Alienssa pentalim ex arcu, ac ultricies tortor ultricies pellentesque.</p>

                                            <a href="#" class="read_more type_one" target="_blank">
                                                Read More <span class="icon-arrow-right"></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--===============spacing==============-->
                    <div class="pd_bottom_65"></div>
                    <!--===============spacing==============-->
                </section>

                <!--project-->
                <section class="project-section bg_light_1 position-relative">
                    <!--===============shape==============-->
                    <div class="position_absolute top curve_shape_top_1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="none">
                            <path class="elementor-shape-fill"
                                d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7	s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7	c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3	c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6	c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7	C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5	c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1	c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7	c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6	C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8	c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2	C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3	C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1	z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1	c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C267.7,18.8,269.7,18,269.6,18z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2	S227.6,9.9,227.4,9.8z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4	C206.4,12.9,204.6,13.5,204.5,13.4z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6	S201,10.7,201,10.6z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C152.6,27.5,154.6,26.8,154.5,26.7z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6	c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0	C76.9,11.5,75.3,12.5,75.5,12.6z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4	C19.9,13.7,15.7,13.3,15.6,13.2z">
                            </path>
                        </svg>
                    </div>
                    <!--===============shape==============-->
                    <!--===============spacing==============-->
                    <div class="pd_top_110"></div>
                    <!--===============spacing==============-->
                    <div class="container">
                        <div class="row align-items-end">
                            <div class="col-lg-6">
                                <div class="title_all_box style_one dark_color">
                                    <div class="title_sections">
                                        <div class="before_title">
                                            <span class="icon-briefcase icon"></span>
                                            OUR PROJECTS
                                        </div>
                                        <div class="title">A Glance of Our Work</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-md-end">
                                    <div class="theme_btn_all color_one">
                                        <a href="#" class="theme-btn one">
                                            More Projects
                                        </a>
                                    </div>
                                </div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_20"></div>
                                <!--===============spacing==============-->
                            </div>
                            <!--===============spacing==============-->
                            <div class="pd_bottom_20"></div>
                            <!--===============spacing==============-->
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">

                                <div class="project_box type_one">
                                    <div class="image_box ">
                                        <img src="assets/images/projects/project-6-img.jpg" class="img-fluid"
                                            alt="img" />
                                        <div class="overlay">
                                            <a data-fancybox="gallery" class="zm_btn"
                                                href="assets/images/projects/project-6-img.jpg">
                                                <span class="icon-plus zoom_icon"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="content_box">
                                        <div class="content_box_inner">

                                            <h2 class="entry-title">
                                                <a href="project-details.html">
                                                    Shared Time Human Resources Management
                                                </a>
                                            </h2>
                                            <p>
                                                <a href="project-details.html" class="cat"> Human Resources</a>,
                                                <a href="project-details.html" class="cat">Recruiting</a>
                                            </p>
                                            <a href="project-details.html" class="read_more_link">
                                                <span class="icon-arrow-right"></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">

                                <div class="project_box type_one">
                                    <div class="image_box ">
                                        <img src="assets/images/projects/project-5-img.jpg" class="img-fluid"
                                            alt="img" />
                                        <div class="overlay">
                                            <a data-fancybox="gallery" class="zm_btn"
                                                href="assets/images/projects/project-5-img.jpg">
                                                <span class="icon-plus zoom_icon"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="content_box">
                                        <div class="content_box_inner">

                                            <h2 class="entry-title"><a href="#">Six Essential Steps To Writing
                                                    Successful
                                                    Job</a></h2>
                                            <p> <a href="project-details.html" class="cat">Coaching</a>, <a
                                                    href="project-details.html" class="cat">Values</a></p>
                                            <a href="" class="read_more_link"><span
                                                    class="icon-arrow-right"></span></a>

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">

                                <div class="project_box type_one">
                                    <div class="image_box ">
                                        <img src="assets/images/projects/project-4-img.jpg" class="img-fluid"
                                            alt="mg">
                                        <div class="overlay">
                                            <a data-fancybox="gallery" class="zm_btn"
                                                href="assets/images/projects/project-4-img.jpg">
                                                <span class="icon-plus zoom_icon"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="content_box">
                                        <div class="content_box_inner">

                                            <h2 class="entry-title">
                                                <a href="project-details.html">
                                                    Time HR Prepares Plastic ContractManufacturer
                                                </a>
                                            </h2>
                                            <p>
                                                <a href="project-details.html" class="cat">Leadership</a>, <a
                                                    href="project-details.html" class="cat">Pre sale</a>
                                            </p>
                                            <a href="project-details.html" class="read_more_link">
                                                <span class="icon-arrow-right"></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">

                                <div class="project_box type_one">
                                    <div class="image_box ">
                                        <img src="assets/images/projects/project-3-img.jpg" class="img-fluid"
                                            alt="img">
                                        <div class="overlay">
                                            <a data-fancybox="gallery" class="zm_btn"
                                                href="assets/images/projects/project-3-img.jpg">
                                                <span class="icon-plus zoom_icon"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="content_box">
                                        <div class="content_box_inner">

                                            <h2 class="entry-title"><a href="project-details.html">Essential Steps to
                                                    Writing Job
                                                    Description</a></h2>
                                            <p> <a href="project-details.html" class="cat">Human Resources</a>, <a
                                                    href="project-details.html" class="cat">Recruiting</a></p>
                                            <a href="project-details.html" class="read_more_link"><span
                                                    class="icon-arrow-right"></span></a>

                                        </div>
                                    </div>
                                </div>




                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">

                                <div class="project_box type_one">
                                    <div class="image_box ">
                                        <img src="assets/images/projects/project-2-img.jpg" class="img-fluid"
                                            alt="img" />
                                        <div class="overlay">
                                            <a data-fancybox="gallery" class="zm_btn"
                                                href="assets/images/projects/project-2-img.jpg">
                                                <span class="icon-plus zoom_icon"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="content_box">
                                        <div class="content_box_inner">

                                            <h2 class="entry-title">
                                                <a href="project-details.html">
                                                    Complex Dismissal for a Small Company
                                                </a>
                                            </h2>
                                            <p>
                                                <a href="project-details.html" class="cat">Coaching</a>, <a
                                                    href="project-details.html" class="cat">Pre sale</a>
                                            </p>
                                            <a href="project-details.html" class="read_more_link">
                                                <span class="icon-arrow-right"></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">

                                <div class="project_box type_one">
                                    <div class="image_box ">
                                        <img src="assets/images/projects/project-1-img.jpg" class="img-fluid"
                                            alt="img">
                                        <div class="overlay">
                                            <a data-fancybox="gallery" class="zm_btn"
                                                href="assets/images/projects/project-1-img.jpg">
                                                <span class="icon-plus zoom_icon"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="content_box">
                                        <div class="content_box_inner">

                                            <h2 class="entry-title">
                                                <a href="project-details.html">
                                                    Company Values & The Relationship
                                                </a>
                                            </h2>
                                            <p>
                                                <a href="project-details.html" class="cat">Leadership</a>, <a
                                                    href="project-details.html" class="cat">Values</a>
                                            </p>
                                            <a href="" class="read_more_link"><span
                                                    class="icon-arrow-right"></span></a>

                                        </div>
                                    </div>
                                </div>



                            </div>

                        </div>


                    </div>
                    <!--===============spacing==============-->
                    <div class="pd_bottom_110"></div>
                    <!--===============spacing==============-->
                    <!--===============shape==============-->
                    <div class="position_absolute curve_shape_bottom_1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="none">
                            <path class="elementor-shape-fill"
                                d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7	s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7	c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3	c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6	c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7	C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5	c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1	c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7	c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6	C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8	c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2	C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3	C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1	z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1	c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C267.7,18.8,269.7,18,269.6,18z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2	S227.6,9.9,227.4,9.8z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4	C206.4,12.9,204.6,13.5,204.5,13.4z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6	S201,10.7,201,10.6z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C152.6,27.5,154.6,26.8,154.5,26.7z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6	c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0	C76.9,11.5,75.3,12.5,75.5,12.6z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4	C19.9,13.7,15.7,13.3,15.6,13.2z">
                            </path>
                        </svg>
                    </div>
                    <!--===============shape==============-->
                </section>
                <!---project end-->
                <!---testimonial-->
                <section class="testimonial-section">
                    <!--===============spacing==============-->
                    <div class="pd_top_50"></div>
                    <!--===============spacing==============-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 m-auto">
                                <div class="title_all_box style_six text-center dark_color">
                                    <div class="title_sections">
                                        <div class="before_title">
                                            <span class="icon-briefcase icon"></span>
                                            TESTIMONIAL
                                        </div>
                                        <div class="title">Words From Our Customers</div>
                                        <p>Which is the same as saying through shrinking from toil and pain. These cases are
                                            perfectly simple and easy to distinguish.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="testimonial_all owl_new_one ">
                                    <div class="owl-carousel owl_nav_block owl_dots_none owl_type_two theme_carousel owl-theme"
                                        data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 7000, "smartSpeed": 1800, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "3" } , "1000":{ "items" : "2" }}}'>

                                        <div class="testimonial_box type_one">
                                            <span class="icon-quote"></span>
                                            <div class="testimonial_inner">
                                                <div class="description">
                                                    <p>I love creote everyone has been great to work
                                                        with and you’re all great partner for company,
                                                        we thank you ... </p>
                                                </div>
                                                <div class="lower_content clearfix">
                                                    <div class="image_box">
                                                        <img decoding="async" src="assets/images/testi-2.png"
                                                            alt="image">
                                                    </div>
                                                    <div class="authour_name">
                                                        <h2>Boris Elbert </h2>
                                                        <h6>Green Tech</h6>
                                                        <p>
                                                            <i class="fa fa-star fill"></i>
                                                            <i class="fa fa-star fill"></i>
                                                            <i class="fa fa-star fill"></i>
                                                            <i class="fa fa-star empty"></i>
                                                            <i class="fa fa-star empty"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="testimonial_box type_one">
                                            <span class="icon-quote"></span>
                                            <div class="testimonial_inner">
                                                <div class="description">
                                                    <p>We hired creote to assist us with refining
                                                        marketing plans, you truly understands &
                                                        gave us very good ideas. </p>
                                                </div>
                                                <div class="lower_content clearfix">
                                                    <div class="image_box">
                                                        <img decoding="async" src="assets/images/testi-3.png"
                                                            alt="image">
                                                    </div>
                                                    <div class="authour_name">
                                                        <h2>Ivor Herbert</h2>
                                                        <h6>Manager, Airlines</h6>
                                                        <p>
                                                            <i class="fa fa-star fill"></i>
                                                            <i class="fa fa-star fill"></i>
                                                            <i class="fa fa-star fill"></i>
                                                            <i class="fa fa-star empty"></i>
                                                            <i class="fa fa-star empty"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="testimonial_box type_one">
                                            <span class="icon-quote"></span>
                                            <div class="testimonial_inner">
                                                <div class="description">
                                                    <p>You bring tremendous value to company. We have
                                                        generated more leads in the last 45 days. </p>
                                                </div>
                                                <div class="lower_content clearfix">
                                                    <div class="image_box">
                                                        <img decoding="async" src="assets/images/testi-1.png"
                                                            alt="image">
                                                    </div>
                                                    <div class="authour_name">
                                                        <h2>Fleix Everard </h2>
                                                        <h6>HR, Blue Soft Sol</h6>
                                                        <p>
                                                            <i class="fa fa-star fill"></i>
                                                            <i class="fa fa-star fill"></i>
                                                            <i class="fa fa-star fill"></i>
                                                            <i class="fa fa-star empty"></i>
                                                            <i class="fa fa-star empty"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--===============spacing==============-->
                    <div class="pd_bottom_90"></div>
                    <!--===============spacing==============-->
                </section>
                <!--testimonial end-->
                <!---contact-->
                <section class="contact-section bg_op_1 box_shadow_2"
                    style="background: url(assets/images/consult-bg.jpg);">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-md-12">
                                <div class="image_box mr_top_minus_50">
                                    <img src="assets/images/cosnsult-image.png" class="img-fluid" alt="consult" />
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12">
                                <!--===============spacing==============-->
                                <div class="pd_top_80"></div>
                                <!--===============spacing==============-->
                                <div class="title_all_box style_six  dark_color">
                                    <div class="title_sections">
                                        <div class="before_title">
                                            <span class="icon-briefcase icon"></span>
                                            ANY TIME, ANY WHERE CONSULTING
                                        </div>
                                        <div class="title">Get A Free Consultancy Right Now Here</div>
                                        <p>We help you to see world differently , discover oppurtunities you may never have
                                            imagined.</p>
                                    </div>
                                </div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_0"></div>
                                <!--===============spacing==============-->
                                <div class="divider_2"></div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_35"></div>
                                <!--===============spacing==============-->
                                <div class="row gutter_25px">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="theme_btn_all color_one">
                                            <a href="#" class="theme-btn one">
                                                Contact us
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <div class="footer_contact_list dark_color type_one">
                                            <div class="same_contact phone">
                                                <span class="icon-telephone"></span>
                                                <div class="content">
                                                    <h6 class="titles"> Phone</h6>
                                                    <a href="tel:+(1 800) – 5554400">+(1 800) – 5554400</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_70"></div>
                                <!--===============spacing==============-->
                            </div>
                        </div>
                    </div>
                </section>
                <!--contact end-->
                <!---pricing-->
                <section class="pricing-section bg_light_1">
                    <!--===============spacing==============-->
                    <div class="pd_top_80"></div>
                    <!--===============spacing==============-->
                    <div class="container">
                        <div class="row align-items-end">
                            <div class="col-lg-6 col-md-12">
                                <div class="title_all_box style_six dark_color">
                                    <div class="title_sections">
                                        <div class="before_title">
                                            <span class="icon-briefcase icon"></span>
                                            CHOOSE YOUR PLAN
                                        </div>
                                        <div class="title">Adaptable Pricing</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <p>
                                    Which is the same as saying through shrinking from toil and pain. These cases are
                                    perfectly
                                    simple and easy to distinguish.
                                </p>
                            </div>
                        </div>
                        <!--===============spacing==============-->
                        <div class="pd_bottom_20"></div>
                        <!--===============spacing==============-->
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="pricing_plan_box type_one">
                                    <div class="tags">Recommended</div>
                                    <div class="pricing_plan_box_inner">
                                        <div class="upper_content">
                                            <div class="title_s">
                                                <h2>Basic Pack</h2>
                                            </div>
                                            <div class="price_rs">
                                                <h6><small>22$</small> / <span>Year</span></h6>
                                            </div>
                                            <p>Power of choice is untrammelled and do what we like best.</p>
                                        </div>

                                        <div class="lower_content">
                                            <ul>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    4-5 Weeks from to finish
                                                </li>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    Organisational Strategy
                                                </li>
                                                <li>
                                                    <span class="no_ico fa fa-times-circle-o"></span>
                                                    20 Days of support
                                                </li>
                                                <li>
                                                    <span class="no_ico fa fa-times-circle-o"></span>
                                                    Data sprint
                                                    Results revision
                                                </li>
                                                <li>
                                                    <span class="no_ico fa fa-times-circle-o"></span>
                                                    Data sprint
                                                    Results revision
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="get_start_button theme_btn_all">
                                            <a href="#" target="_blank" rel="nofollow" class="theme-btn one">Get
                                                Started<span class="icon-arrow-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="pricing_plan_box type_one">
                                    <div class="tags">Most Recommended</div>
                                    <div class="pricing_plan_box_inner">
                                        <div class="upper_content">
                                            <div class="title_s">
                                                <h2>Standard Pack</h2>
                                            </div>
                                            <div class="price_rs">
                                                <h6><small>59$</small> / <span>Year</span></h6>
                                            </div>
                                            <p>Matters to principle of selection our pleasures to secure.</p>
                                        </div>

                                        <div class="lower_content">
                                            <ul>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    4-5 Weeks from to finish
                                                </li>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    Organisational Strategy
                                                </li>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    20 Days of support
                                                </li>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    Data sprint
                                                    Results revision
                                                </li>
                                                <li>
                                                    <span class="no_ico fa fa-times-circle-o"></span>
                                                    Data sprint
                                                    Results revision
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="get_start_button theme_btn_all">
                                            <a href="#" target="_blank" rel="nofollow" class="theme-btn one">Get
                                                Started<span class="icon-arrow-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                <div class="pricing_plan_box type_one">
                                    <div class="tags">Popular Pack</div>
                                    <div class="pricing_plan_box_inner">
                                        <div class="upper_content">
                                            <div class="title_s">
                                                <h2>Advanced Pack</h2>
                                            </div>
                                            <div class="price_rs">
                                                <h6><small>99$</small> / <span>Year</span></h6>
                                            </div>
                                            <p>These cases are perfectly simple & easy to distinguish.</p>
                                        </div>

                                        <div class="lower_content">
                                            <ul>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    4-5 Weeks from to finish
                                                </li>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    Organisational Strategy
                                                </li>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    20 Days of support
                                                </li>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    Data sprint
                                                    Results revision
                                                </li>
                                                <li>
                                                    <span class="yes_ico fa fa-check-circle-o"></span>
                                                    Data sprint
                                                    Results revision
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="get_start_button theme_btn_all">
                                            <a href="#" target="_blank" rel="nofollow" class="theme-btn one">Get
                                                Started<span class="icon-arrow-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--===============spacing==============-->
                    <div class="pd_bottom_70"></div>
                    <!--===============spacing==============-->
                </section>
                <!--pricing end-->

                <!---faq-->
                <section class="faq-section bg_op_1 position-relative"
                    style="background: url(assets/images/footer-bg-two.jpg);">
                    <div class="position_absolute top curve_shape_top_2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                            <path class="elementor-shape-fill" opacity="0.33"
                                d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z">
                            </path>
                            <path class="elementor-shape-fill" opacity="0.66"
                                d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z">
                            </path>
                        </svg>
                    </div>
                    <div class="container-fluid pd_zero">
                        <div class="row">
                            <div
                                class="col-lg-6 col-sm-12 col-xs-12  pd_left_100 pd_right_100 md_pd_left_15 md_pd_right_15">
                                <!--===============spacing==============-->
                                <div class="pd_top_110"></div>
                                <!--===============spacing==============-->
                                <div class="title_all_box style_six light_color">
                                    <div class="title_sections">
                                        <div class="before_title">
                                            <span class="icon-briefcase icon"></span>
                                            CHOOSE YOUR PLAN
                                        </div>
                                        <div class="title">Adaptable Pricing</div>
                                    </div>
                                </div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_20"></div>
                                <!--===============spacing==============-->
                                <div class="faq_box_all  border_enable">
                                    <dl class="accordion faqs_accordion type_one light_color">
                                        <dt class="article-title active">
                                            <div class="title_box">
                                                <span class="faq_no">1 </span> How can use content marketing to increase
                                                efficient
                                                way?
                                            </div>
                                        </dt>
                                        <dd class="accordion-content" style="display: block;">
                                            Same as saying through shrinking from toil and pain these cases are perfectly
                                            simple
                                            and easy to distinguish.
                                        </dd>
                                        <dt class="article-title ">
                                            <div class="title_box">
                                                <span class="faq_no">2 </span> How can content marketing help purchase
                                                journey?
                                            </div>
                                        </dt>
                                        <dd class="accordion-content">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </dd>
                                        <dt class="article-title ">
                                            <div class="title_box">
                                                <span class="faq_no">3 </span> How do we measure content’s on sales and
                                                revenue?
                                            </div>
                                        </dt>
                                        <dd class="accordion-content">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </dd>
                                        <dt class="article-title ">
                                            <div class="title_box">
                                                <span class="faq_no">4 </span> Pain these cases are perfectly simple and
                                                easy to
                                                distinguish.
                                            </div>
                                        </dt>
                                        <dd class="accordion-content">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </dd>
                                    </dl>
                                </div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_110"></div>
                                <!--===============spacing==============-->
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12 position-relative z_99"
                                style="background-image: url(assets/images/faq-section-min.jpg);">

                            </div>

                        </div>
                    </div>
                    <div class="position_absolute curve_shape_bottom_2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                            <path class="elementor-shape-fill" opacity="0.33"
                                d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z">
                            </path>
                            <path class="elementor-shape-fill" opacity="0.66"
                                d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z">
                            </path>
                            <path class="elementor-shape-fill"
                                d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z">
                            </path>
                        </svg>
                    </div>
                </section>
                <!--fag end-->

                <!---blog--->
                <section class="blog-post" id="blog">
                    <!--===============spacing==============-->
                    <div class="pd_top_80"></div>
                    <!--===============spacing==============-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 m-auto">
                                <div class="title_all_box style_six text-center  dark_color">
                                    <div class="title_sections">
                                        <div class="before_title"> <span class="icon-briefcase icon"></span> NEWS &
                                            UPDATES</div>
                                        <h2>Featured News and Updates</h2>
                                        <p>We work with your company to identify position requirements, implement
                                            recruitment
                                            programs, and initiate employee assessments that maximize recruitment efforts
                                        </p>
                                    </div>
                                </div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_10"></div>
                                <!--===============spacing==============-->
                            </div>
                        </div>
                        <div class="blog_all_styles grid ">


                            <div class="row">

                                <div class="col-xl-4 col-md-6 col-sm-6  col-xs-12">

                                    <div class="news_box type_one clearfix">
                                        <div class="news_inner">
                                            <div class="image_box">
                                                <img src="assets/images/blog/blog-image-9.jpg" class="img-fluid"
                                                    alt="img">
                                                <div class="overlay"></div>
                                                <div class="post-category">
                                                    <a href="blog-single.html" class="categories">
                                                        <i class="icon-folder"></i>
                                                        Compliance Audits
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="content_box">
                                                <ul class="post-info clearfix">
                                                    <li class="authour_name">
                                                        <i class="far fa-user"></i>
                                                        <a href="#"> Evan Thomas </a>
                                                    </li>
                                                    <li class="date">
                                                        <a href="blog-single.html">
                                                            <i class="far  fa-calendar"></i>
                                                            8 Oct , 2023
                                                        </a>
                                                    </li>
                                                </ul>
                                                <h2 class="entry-title"><a href="blog-single.html">Why
                                                        Should Business Payroll Outsourcing?</a></h2>
                                                <p class="short_desc">How well this mistaken ideas off denouncing
                                                    pleasure & praisings will give you complete.</p>
                                                <div class="bottom_content clearfix">
                                                    <div class="continure_reading">
                                                        <a href="blog-single.html" class="read_more type_one">
                                                            Read More <span class="icon-arrow-right"></span></a>
                                                    </div>
                                                    <div class="comments">
                                                        <i class="icon-text"></i>
                                                        <a href="blog-single.html#respond"
                                                            class="Comments are Closed">Post
                                                            Comment</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.col-lg-3 -->

                                <div class="col-xl-4 col-md-6 col-sm-6  col-xs-12">

                                    <div class="news_box type_one clearfix">
                                        <div class="news_inner">
                                            <div class="image_box">
                                                <img src="assets/images/blog/blog-image-7.jpg" class="img-fluid"
                                                    alt="img">
                                                <div class="overlay"></div>
                                                <div class="post-category">
                                                    <a href="blog-single.html" class="categories">
                                                        <i class="icon-folder"></i>
                                                        HR Consulting
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="content_box">
                                                <ul class="post-info clearfix">
                                                    <li class="authour_name">
                                                        <i class="far fa-user"></i>
                                                        <a href="blog-single.html">
                                                            Evan Thomas
                                                        </a>
                                                    </li>
                                                    <li class="date">
                                                        <a href="blog-single.html"><i class="far  fa-calendar"></i>
                                                            8 Oct , 2023
                                                        </a>
                                                    </li>
                                                </ul>
                                                <h2 class="entry-title">
                                                    <a href="blog-single.html">
                                                        How to Handle Employee With Works
                                                    </a>
                                                </h2>
                                                <p class="short_desc">How well this mistaken ideas off denouncing
                                                    pleasure & praisings will give you complete.</p>
                                                <div class="bottom_content clearfix">
                                                    <div class="continure_reading">
                                                        <a href="blog-single.html" class="read_more type_one">
                                                            Read More <span class="icon-arrow-right"></span></a>
                                                    </div>
                                                    <div class="comments">
                                                        <i class="icon-text"></i>
                                                        <span class="Comments are Closed">Comments Off<span
                                                                class="screen-reader-text"> on How to Handle Employee
                                                                With Works</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div><!-- /.col-lg-3 -->

                                <div class="col-xl-4 col-md-6 col-sm-6  col-xs-12">

                                    <div class="news_box type_one clearfix">
                                        <div class="news_inner">
                                            <div class="image_box">
                                                <img width="750" height="420"
                                                    src="assets/images/blog/blog-image-6.jpg" class="img-fluid"
                                                    alt="" decoding="async" loading="lazy"
                                                    srcset="assets/images/blog/blog-image-6.jpg 750w, assets/images/blog/blog-image-6-600x336.jpg 600w, assets/images/blog/blog-image-6-300x168.jpg 300w"
                                                    sizes="(max-width: 750px) 100vw, 750px">
                                                <div class="overlay"></div>
                                                <div class="post-category">
                                                    <a href="https://themepanthers.com/wp/creote/v2-new/category/recruiting/"
                                                        class="categories"><i class="icon-folder"></i>Recruiting</a>
                                                </div>
                                            </div>
                                            <div class="content_box">
                                                <ul class="post-info clearfix">
                                                    <li class="authour_name"><i class="far fa-user"></i><a
                                                            href="">
                                                            Evan Thomas </a> </li>
                                                    <li class="date"> <a
                                                            href="https://themepanthers.com/wp/creote/v2-new/2023/10/08/retaining-good-employees-motivated/"><i
                                                                class="far  fa-calendar"></i>8 Oct ,
                                                            2023 </a> </li>
                                                </ul>
                                                <h2 class="entry-title"><a
                                                        href="https://themepanthers.com/wp/creote/v2-new/2023/10/08/retaining-good-employees-motivated/">Retaining
                                                        Good Employees & Motivated</a></h2>
                                                <p class="short_desc">How well this mistaken ideas off denouncing
                                                    pleasure & praisings will give you complete.</p>
                                                <div class="bottom_content clearfix">
                                                    <div class="continure_reading">
                                                        <a href="https://themepanthers.com/wp/creote/v2-new/2023/10/08/retaining-good-employees-motivated/"
                                                            class="read_more type_one">
                                                            Read More <span class="icon-arrow-right"></span></a>
                                                    </div>
                                                    <div class="comments">
                                                        <i class="icon-text"></i>
                                                        <span class="Comments are Closed">Comments Off<span
                                                                class="screen-reader-text"> on Retaining Good
                                                                Employees & Motivated</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.col-lg-3 -->
                            </div>




                        </div><!-- /.blog-one -->
                    </div>
                    <!--===============spacing==============-->
                    <div class="pd_bottom_70"></div>
                    <!--===============spacing==============-->
                </section>
                <!---blog-end--->

            </div>
            <!--===============PAGE CONTENT==============-->
            <!--===============PAGE CONTENT==============-->
        </div>
        <!---==============footer start =================-->
        <div class="footer_area thirteen" id="footer_contents">
            <div class="footer_widgets_wrap bg_op_1" style="background: url(assets/images/footer-bg.jpg);">
                <!--===============spacing==============-->
                <div class="pd_top_80"></div>
                <!--===============spacing==============-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="footer_widgets about_company light_color">
                                <div class="about_company_inner">
                                    <div class="footer_logo">
                                        <a href="#" target="_blank" rel="nofollow">
                                            <img src="assets/images/logo-white.png" class="img-fluid" alt="logo" />
                                        </a>
                                        <!--===============spacing==============-->
                                        <div class="pd_bottom_30"></div>
                                        <!--===============spacing==============-->
                                    </div>
                                    <div class="content_box">
                                        <p class="color_white">
                                            Over 20 years of experience we’ll ensure you always get the best guidance. We
                                            serve a
                                            clients at every level of their organization...
                                        </p>

                                    </div>
                                </div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_10"></div>
                                <!--===============spacing==============-->
                                <div class="theme_btn_all color_one">
                                    <a href="#" class="theme-btn two color_white">
                                        Read More
                                    </a>
                                </div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_40"></div>
                                <!--===============spacing==============-->
                                <div class="social_media_v_one style_three">
                                    <ul>
                                        <li>
                                            <a href="#"> <span class="fa fa-facebook"></span>
                                                <small>facebook</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"> <span class="fa fa-twitter"></span>
                                                <small>twitter</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"> <span class="fa fa-skype"></span>
                                                <small>skype</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"> <span class="fa fa-instagram"></span>
                                                <small>instagram</small>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-12">
                            <div class="footer_widgets wid_tit style_one">
                                <div class="fo_wid_title">
                                    <h2>Essentials</h2>
                                </div>
                            </div>
                            <!--===============spacing==============-->
                            <div class="pd_bottom_25"></div>
                            <!--===============spacing==============-->
                            <div class="footer_widgets clearfix">
                                <ul class="list_items_new_box type_one ">
                                    <li>
                                        <a href="#" class="color_white">
                                            <span class=" icon-right-arrow icon"></span>
                                            Infrastructure
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color_white">
                                            <span class=" icon-right-arrow icon"></span>
                                            Client Support
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color_white">
                                            <span class=" icon-right-arrow icon"></span>
                                            Privacy Policy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color_white">
                                            <span class=" icon-right-arrow icon"></span>
                                            Terms of Use
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color_white">
                                            <span class=" icon-right-arrow icon"></span>
                                            Professionals
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color_white">
                                            <span class=" icon-right-arrow icon"></span>
                                            Careers
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color_white">
                                            <span class=" icon-right-arrow icon"></span>
                                            Sitemap
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="footer_widgets wid_tit style_one">
                                <div class="fo_wid_title">
                                    <h2>Recent News</h2>
                                </div>
                            </div>
                            <!--===============spacing==============-->
                            <div class="pd_bottom_25"></div>
                            <!--===============spacing==============-->
                            <div class="footer_widgets recent_news_em_wp style_one  clearfix">
                                <div class="news_boxed light_color">

                                    <div class="news_recent clearfix image_s">
                                        <div class="image ">
                                            <img width="750" height="420" src="assets/images/blog/blog-image-9.jpg"
                                                class="img-fluid" alt="img" loading="lazy">
                                        </div>
                                        <div class="content ">
                                            <h2 class="title"><a href="blog-single.html" rel="bookmark">Why Should
                                                    Business Payroll
                                                    Outsourcing?</a></h2>
                                            <a class="date"><span class="fa fa-clock-o"></span>October 8, 2023</a>
                                        </div>
                                    </div>
                                    <div class="news_recent clearfix image_s">
                                        <div class="image ">
                                            <img width="750" height="420" src="assets/images/blog/blog-image-8.jpg"
                                                class="img-fluid" alt="img" loading="lazy">
                                        </div>
                                        <div class="content ">
                                            <h2 class="title"><a href="blog-single.html" rel="bookmark">Most
                                                    Employees Support
                                                    Measures</a></h2>
                                            <a class="date"><span class="fa fa-clock-o"></span>October 8, 2023</a>
                                        </div>
                                    </div>
                                    <div class="news_recent clearfix image_s">
                                        <div class="image ">
                                            <img width="750" height="420"
                                                src="assets/images/blog/blog-image-7.jpg" class="img-fluid"
                                                alt="img" loading="lazy">
                                        </div>
                                        <div class="content ">
                                            <h2 class="title"><a href="blog-single.html" rel="bookmark">How to Handle
                                                    Employee</a>
                                            </h2>
                                            <a class="date"><span class="fa fa-clock-o"></span>October 8, 2023</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="footer_widgets wid_tit style_one">
                                <div class="fo_wid_title">
                                    <h2>Contact Us</h2>
                                </div>
                            </div>
                            <!--===============spacing==============-->
                            <div class="pd_bottom_25"></div>
                            <!--===============spacing==============-->
                            <div class="footer_contact_widget">
                                <div class="contact_info_nbox type_one">
                                    <div class="single">
                                        <h6 class="color_white"> <span class="icon-location2 color_white"></span>
                                            Address </h6>
                                        <p class="color_white">United States 866 Wilshire, 2nd Street Los Angeles 90024.
                                        </p>
                                    </div>
                                </div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_20"></div>
                                <!--===============spacing==============-->
                                <div class="contact_info_nbox type_one">
                                    <div class="single">
                                        <h6 class="color_white"> <span class="icon-telephone color_white"></span>
                                            Address </h6>
                                        <p><a href="tel:+555 5678 12340" class="color_white">+555 5678 12340</a></p>
                                    </div>
                                </div>
                                <!--===============spacing==============-->
                                <div class="pd_bottom_20"></div>
                                <!--===============spacing==============-->
                                <div class="contact_info_nbox type_one">
                                    <div class="single">
                                        <h6 class="color_white"> <span class="icon-mail color_white"></span> Address
                                        </h6>
                                        <p><a href="mailto:support@creote.com"
                                                class="color_white">support@creote.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--===============spacing==============-->
                <div class="pd_bottom_50"></div>
                <!--===============spacing==============-->
            </div>
            <div class="creote-footer-copyright bg_dark_1">
                <!--===============spacing==============-->
                <div class="pd_top_20"></div>
                <!--===============spacing==============-->
                <div class="container">
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <div class="footer_copy_content color_white">
                                © 2023 <a href="https://themeforest.net/user/steelthemes"
                                    class="color_white">Steelthemes.</a>
                                All Rights
                                Reserved.
                            </div>
                        </div>

                    </div>
                </div>
                <!--===============spacing==============-->
                <div class="pd_bottom_20"></div>
                <!--===============spacing==============-->
            </div>
        </div>
        <!---==============mobile menu =================-->
        <div class="crt_mobile_menu">
            <div class="menu-backdrop"></div>
            <nav class="menu-box">
                <div class="close-btn"><i class="icon-close"></i></div>
                <form role="search" method="get" action="#">
                    <input type="search" class="search" placeholder="Search..." value="" name="s"
                        title="Search" />
                    <button type="submit" class="sch_btn"> <i class="icon-search"></i></button>
                </form>
                <div class="menu-outer">
                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                </div>
            </nav>
        </div>
        <!---==============mobile menu end =================-->
        <!---==============search popup =================-->
        <div id="search-popup" class="search-popup">
            <div class="close-search"><i class="fa fa-times"></i></div>
            <div class="popup-inner">
                <div class="overlay-layer"></div>
                <div class="search-form">
                    <fieldset>
                        <form role="search" method="get" action="#">
                            <input type="search" class="search" placeholder="Search..." value=""
                                name="s" title="Search" />
                            <button type="submit" class="sch_btn"> <i class="icon-search"></i></button>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
        <!---==============search popup end =================-->
        <!---==============modal popup =================-->
        <div class="modal_popup one">
            <div class="modal-popup-inner">
                <div class="close-modal"><i class="fa fa-times"></i></div>
                <div class="modal_box">
                    <div class="row">
                        <div class="col-lg-5 col-md-12 form_inner">
                            <div class="form_content">


                                <form class="contact-form" method="post" action="sendemail.php">
                                    <p>
                                        <label> Your name<br />
                                            <input type="text" name="name" value="" size="40"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Your Name" />
                                            <br />
                                            <i class="fa fa-user"></i><br />
                                        </label>
                                    </p>
                                    <p><label> Your email<br />
                                            <input type="email" name="email" value="" size="40"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Your Email" />
                                            <br />
                                            <i class="fa fa-envelope"></i><br />
                                        </label>
                                    </p>
                                    <p>
                                        <label> Subject<br />
                                            <input type="text" name="subject" value="" size="40"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Your Subject" />
                                            <br />
                                            <i class="fa fa-folder"></i><br />
                                        </label>
                                    </p>
                                    <p>
                                        <label> Your message (optional)<br />
                                            <textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea"
                                                aria-invalid="false" placeholder="Enter Your Message"></textarea>
                                            <br />
                                            <i class="fa fa-comments"></i><br />
                                        </label>
                                    </p>
                                    <p><input type="submit" value="Submit" /></p>

                                </form>

                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12 about_company_inner">
                            <div class="abt_content">
                                <div class="logo">
                                    <img src="assets/images/logo-default.png" alt="img"
                                        class="company_logo_modal">
                                </div>
                                <div class="text">
                                    <p> The great explorer of the truth, the master-builder of human happiness no one
                                        rejects
                                        dislikes avoids pleasure itself because it is pleasure but because know who do not
                                        those
                                        how to pursue pleasures rationally encounter consequences that are extremely painful
                                        desires to obtain.</p>
                                    <a href="#">Read More</a>
                                </div>
                                <div class="post_contet_modal">
                                    <h2> Latest News</h2>
                                    <div class="post_enable">
                                        <div class="modal_post_grid">
                                            <a href="blog-single.html">
                                                <img width="852" height="812"
                                                    src="assets/images/blog/blog-image-9.jpg"
                                                    class="main_img wp-post-image" alt="img" />
                                            </a>
                                        </div>
                                        <div class="modal_post_grid">
                                            <a href="blog-single.html">
                                                <img width="852" height="812"
                                                    src="assets/images/blog/blog-image-8.jpg"
                                                    class="main_img wp-post-image" alt="img" />
                                            </a>
                                        </div>
                                        <div class="modal_post_grid">
                                            <a href="blog-single.html">
                                                <img width="852" height="812"
                                                    src="assets/images/blog/blog-image-7.jpg"
                                                    class="main_img wp-post-image" alt="img" />
                                            </a>
                                        </div>
                                        <div class="modal_post_grid">
                                            <a href="blog-single.html">
                                                <img width="852" height="812"
                                                    src="assets/images/blog/blog-image-6.jpg"
                                                    class="main_img wp-post-image" alt="img" />
                                            </a>
                                        </div>
                                        <div class="modal_post_grid">
                                            <a href="blog-single.html">
                                                <img width="852" height="812"
                                                    src="assets/images/blog/blog-image-5.jpg"
                                                    class="main_img wp-post-image" alt="img" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="copright">
                                    © 2023 Creote. All Rights Reserved.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---==============modal popup end=================-->
        <!---==============cart=================-->
        <div class="side_bar_cart" id="mini_cart">
            <div class="cart_overlay"></div>
            <div class="cart_right_conten">
                <div class="close">
                    <div class="close_btn_mini"><i class="icon-close"></i></div>
                </div>
                <div class="cart_content_box">
                    <div class="contnet_cart_box">
                        <div class="widget_shopping_cart_content">
                            <p class="woocommerce-mini-cart__empty-message">No products in the cart.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---==============cart=================-->

    </div>
    <!-- Back to top with progress indicator-->
    <div class="prgoress_indicator">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
@endsection
