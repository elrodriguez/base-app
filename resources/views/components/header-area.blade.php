@if (count($data) > 0)
    <div class="header_area" id="header_contents">
        <header class="main-header header header_v13">
            <section class="header_top">
                <div class="medium-container">
                    <div class="header_top_inner">
                        <div class="top_left">
                            <ul class="top-links clearfix">
                                <li>
                                    <a href="#" class="get_a_quote">Get a quote </a>
                                <li>
                                <li>Welcome to our consulting company.</li>
                            </ul>
                        </div>
                        <div class="top_right text-right">
                            <ul class="contact_info_two">
                                <li class="single">
                                    <p>
                                        <span class="icon-telephone"></span>
                                        <a href="tel:+98 060 712 34">
                                            {{ $data[0]->item->content }}
                                        </a>
                                    </p>
                                </li>
                                <li class="single">
                                    <p>
                                        <span class="icon-mail"></span>
                                        <a href="mailto:{{ $data[1]->item->content }}">{{ $data[1]->item->content }}</a>
                                    </p>
                                </li>
                                <li class="single">
                                    <p>
                                        <span class="icon-location2"></span>
                                        {{ $data[2]->item->content }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="navbar_outer get_sticky_header">
                <div class="medium-container">
                    <nav class="inner_box">
                        <div class="header_logo_box">
                            <a href="index.html" class="logo navbar-brand">
                                <img src="{{ asset('themes/kentha/assets/images/logo-default.png') }}" alt="Creote"
                                    class="logo_default">
                                <img src="{{ asset('themes/kentha/assets/images/logo-default.png') }}" alt="Creote"
                                    class="logo__sticky">
                            </a>
                        </div>
                        <div class="navbar_togglers hamburger_menu">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                        <div class="header_content header_content_collapse">

                            <div class="header_menu_box">
                                <div class="navigation_menu">
                                    <ul id="myNavbar" class="navbar_nav">
                                        <li
                                            class="menu-item  menu-item-has-children dropdown active dropdown_full position-static mega_menu nav-item">
                                            <a href="index.html" class="dropdown-toggle nav-link">
                                                <span>Home</span>
                                            </a>
                                            <ul class="dropdown-menu width_65_percentage">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                            <div class="list_item_box style_one">
                                                                <ul>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="index.html">Home
                                                                                Page
                                                                                - 01</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-2.html">Home
                                                                                Page
                                                                                - 02</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-3.html">Home
                                                                                Page
                                                                                - 03</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-4.html">Home
                                                                                Page
                                                                                - 04</a>
                                                                        </small>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                            <div class="list_item_box style_one">
                                                                <ul>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-5.html">Home
                                                                                Page
                                                                                - 05</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-6.html">Home
                                                                                Page
                                                                                - 06</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-7.html">Home
                                                                                Page
                                                                                - 07</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-8.html">Home
                                                                                Page
                                                                                - 08</a>
                                                                        </small>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                            <div class="list_item_box style_one">
                                                                <ul>

                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-9.html">Home
                                                                                Page
                                                                                - 09</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-10.html">Home
                                                                                Page -
                                                                                10</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-11.html">Home
                                                                                Page -
                                                                                11</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link" href="home-12.html">Home
                                                                                Page -
                                                                                12</a>
                                                                        </small>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                            <div class="list_item_box style_one">
                                                                <ul>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link"
                                                                                href="home-13.html">Home
                                                                                Page -
                                                                                13</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link"
                                                                                href="home-14.html">Home
                                                                                Page -
                                                                                14</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link"
                                                                                href="home-15.html">Home
                                                                                Page -
                                                                                15</a>
                                                                        </small>
                                                                    </li>
                                                                    <li>
                                                                        <small class="d-flex align-items-center">
                                                                            <i class="icon-home only_icon"></i>
                                                                            <a class="nav_link"
                                                                                href="home-16.html">Home
                                                                                Page -
                                                                                16</a>
                                                                        </small>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item menu-item-has-children dropdown nav-item">
                                            <a href="#" class="dropdown-toggle nav-link">
                                                <span>Pages</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="menu-item  nav-item">
                                                    <a href="about-us.html" class="dropdown-item nav-link">
                                                        <span>About Us</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item menu-item-has-children dropdown nav-item">
                                                    <a href="service-default.html"
                                                        class="dropdown-item nav-link"><span>Service</span></a>
                                                    <ul class="dropdown-menu">
                                                        <li class="menu-item  nav-item">
                                                            <a href="service-classic.html"
                                                                class="dropdown-item nav-link">
                                                                <span>Service Classic</span>
                                                            </a>
                                                        </li>
                                                        <li class="menu-item  nav-item">
                                                            <a href="service-default.html"
                                                                class="dropdown-item nav-link">
                                                                <span>Service Default</span>
                                                            </a>
                                                        </li>
                                                        <li class="menu-item nav-item">
                                                            <a href="service-details.html"
                                                                class="dropdown-item nav-link">
                                                                <span>Service Details</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="pricing-packages.html" class="dropdown-item nav-link">
                                                        <span>Pricing Packages</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="our-team.html" class="dropdown-item nav-link">
                                                        <span>Our Team</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="faqs.html" class="dropdown-item nav-link">
                                                        <span>Faq’s</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="contact.html" class="dropdown-item nav-link">
                                                        <span>Contact</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="coming-soon.html" class="dropdown-item nav-link">
                                                        <span>Coming Soon</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li
                                            class="menu-item menu-item-has-children dropdown dropdown_full position-static mega_menu nav-item">
                                            <a href="#"
                                                class="dropdown-toggle nav-link"><span>Elements</span></a>
                                            <ul class="dropdown-menu width_60_percentage">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-2 m_column">
                                                            <h5>Content 01</h5>
                                                            <div class="list_item_box style_one">
                                                                <ul>
                                                                    <li><a
                                                                            href="elements/testimonial.html">Testimonial</a>
                                                                    </li>
                                                                    <li><a href="elements/call-to-action.html">Contact
                                                                            List</a></li>
                                                                    <li><a href="elements/video-button.html">Video
                                                                            Button</a></li>
                                                                    <li><a
                                                                            href="elements/newsteller.html">Newsteller</a>
                                                                    </li>
                                                                    <li><a href="elements/blog-posts.html">Blog
                                                                            Posts</a>
                                                                    </li>
                                                                    <li><a href="elements/team.html">Team</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 m_column">
                                                            <h5>Content 02</h5>
                                                            <div class="list_item_box style_one">
                                                                <ul>
                                                                    <li><a href="elements/process.html">Process</a>
                                                                    </li>
                                                                    <li><a href="elements/project-carousel.html">Project
                                                                            Carousel</a></li>
                                                                    <li><a href="elements/project-filter.html">Project
                                                                            Filter</a></li>
                                                                    <li><a href="elements/progress-bar.html">Progress
                                                                            Bar</a></li>
                                                                    <li><a href="elements/content-box.html">Content
                                                                            Box</a>
                                                                    </li>
                                                                    <li><a href="elements/faqs-elements.html">Faq’s</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 m_column">
                                                            <h5>Presentational</h5>
                                                            <div class="list_item_box style_one">
                                                                <ul>
                                                                    <li><a href="elements/button.html">Button</a></li>
                                                                    <li><a href="elements/list-items.html">List
                                                                            Items</a>
                                                                    </li>
                                                                    <li><a href="elements/contact-form.html">Contact
                                                                            Form</a></li>
                                                                    <li><a href="elements/service-post.html">Service
                                                                            Post</a></li>
                                                                    <li><a href="elements/sliders.html">Sliders</a>
                                                                    </li>
                                                                    <li><a href="elements/tabs.html">Tabs</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 m_column">
                                                            <h5>Typography</h5>
                                                            <div class="list_item_box style_one">
                                                                <ul>
                                                                    <li><a href="elements/call-to-action.html">Call to
                                                                            Action</a></li>
                                                                    <li><a href="elements/extra-content.html">Extra
                                                                            Content</a></li>
                                                                    <li><a href="elements/simple-image.html">Simple
                                                                            Image</a></li>
                                                                    <li><a href="elements/client-image.html">Client
                                                                            Image</a></li>
                                                                    <li><a href="elements/price-plan.html">Price
                                                                            Plan</a>
                                                                    </li>
                                                                    <li><a href="elements/title.html">Title</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 m_column">
                                                            <h5>Basic</h5>
                                                            <div class="list_item_box style_one">
                                                                <ul>
                                                                    <li><a href="elements/service-box.html">Service
                                                                            Box</a>
                                                                    </li>
                                                                    <li><a href="elements/count-down.html">Count
                                                                            Down</a>
                                                                    </li>
                                                                    <li><a href="elements/timeline.html">Time Line</a>
                                                                    </li>
                                                                    <li><a href="elements/contact-box.html">Contact
                                                                            Box</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 m_column">
                                                            <h5>Infographic</h5>
                                                            <div class="list_item_box style_one">
                                                                <ul>
                                                                    <li><a href="elements/image-box.html">Image Box</a>
                                                                    </li>
                                                                    <li><a href="elements/icon-box.html">Icon Box</a>
                                                                    </li>
                                                                    <li><a href="elements/fun-facts.html">Fun Facts</a>
                                                                    </li>
                                                                    <li><a href="elements/quotes.html">Quotes</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item menu-item-has-children dropdown nav-item">
                                            <a href="blog.html" class="dropdown-toggle nav-link">
                                                <span>Blog</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="menu-item nav-item">
                                                    <a href="blog.html" class="dropdown-item nav-link">
                                                        <span>Blog Classic</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="blog-modern.html" class="dropdown-item nav-link">
                                                        <span>Blog Modern</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="blog-simple.html" class="dropdown-item nav-link">
                                                        <span>Blog Simple</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="blog-list-view.html" class="dropdown-item nav-link">
                                                        <span>Blog List View</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="blog-metro-fullwidth.html"
                                                        class="dropdown-item nav-link">
                                                        <span>Metro Fullwidth</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item nav-item">
                                                    <a href="blog-single.html" class="dropdown-item nav-link">
                                                        <span>Single Post</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item menu-item-has-children dropdown nav-item">
                                            <a href="project-1-column-grid.html" class="dropdown-toggle nav-link">
                                                <span>Projects</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="menu-item  nav-item">
                                                    <a href="project-1-column-grid.html"
                                                        class="dropdown-item nav-link">
                                                        <span>1 Column Grid</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="project-1-column-with-sidebar.html"
                                                        class="dropdown-item nav-link">
                                                        <span>1 Column With Sidebar</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="project-2-column-grid.html"
                                                        class="dropdown-item nav-link">
                                                        <span>2 Columns Grid</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="project-3-column-grid.html"
                                                        class="dropdown-item nav-link">
                                                        <span>3 Columns Grid</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="project-3-column-overlay.html"
                                                        class="dropdown-item nav-link">
                                                        <span>3 Columns Overlay</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item nav-item">
                                                    <a href="project-details.html" class="dropdown-item nav-link">
                                                        <span>Project Details</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item  menu-item-has-children dropdown nav-item">
                                            <a href="shop.html" class="dropdown-toggle nav-link">
                                                <span>Shop</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="menu-item  nav-item">
                                                    <a href="shop.html" class="dropdown-item nav-link">
                                                        <span>Products</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item nav-item">
                                                    <a href="shop-details.html" class="dropdown-item nav-link">
                                                        <span>Product Details</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item nav-item">
                                                    <a href="shop-with-sidebar.html" class="dropdown-item nav-link">
                                                        <span>Product With Sidebar</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="my-account.html" class="dropdown-item nav-link">
                                                        <span>My account</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="checkout.html" class="dropdown-item nav-link">
                                                        <span>Checkout</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item  nav-item">
                                                    <a href="cart.html" class="dropdown-item nav-link">
                                                        <span>Cart</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <ul class="navbar_right navbar_nav ">
                                <li>
                                    <button type="button" class="search-toggler"><i
                                            class="icon-search"></i></button>
                                </li>
                                <li>
                                    <div class="mini_cart_togglers header_side_cart">
                                        <div class="mini-cart-count">
                                            0 </div>
                                        <i class="icon-shopping-bag1"></i>
                                    </div>
                                </li>

                                <li>
                                    <button type="button" class="contact-toggler"><i
                                            class="icon-menu1"></i></button>
                                </li>

                            </ul>
                        </div>

                    </nav>


                </div>

            </section>
        </header>
        <!-- end of the loop -->
    </div>
@endif
