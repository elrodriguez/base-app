@extends('layouts.kentha')

@section('content')
    <div id="page" class="page_wapper hfeed site">
            <!----header----->
            <x-header-area />
            <!----header end----->
            <!--===============PAGE CONTENT==============-->
            <!--===============PAGE CONTENT==============-->
            <div id="content" class="site-content ">

                <!--- slider-->
                <x-slider-area />
                <!---slider-end--->

                <!--about-->
                <x-about />
                <!---about end-->

                <!--client-->
                <x-clientes-area />
                <!---client end-->

                <!--servicios-->
                <x-servicios />
                <!--servicios end-->

                <!--Ventajas-->
                <x-ventajas-area />
                <!--Ventajas end-->

                <!--projectos-->
                <x-proyectos-area />
                <!---projectos end-->

                <!---testimonial-->
                <x-testimonios-area />
                <!--testimonial end-->

                <!---contact-->
                <x-contacto-area />
                <!--contact end-->

                <!---faq-->
                <section class="faq-section bg_op_1 position-relative"
                    style="background: url(themes/kentha/assets/images/footer-bg-two.jpg);">
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
                                style="background-image: url(themes/kentha/assets/images/faq-section-min.jpg);">

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
        <x-footer-area />
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
                            <input type="search" class="search" placeholder="Search..." value="" name="s"
                                title="Search" />
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
                                    <img src="{{ asset('themes/kentha/assets/images/HVAC_logo.png') }}" alt="img" class="Logo_Kentha">
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
