@extends('layouts.kentha')
<x-header-area />

<div class="page_header_default style_one ">
    <div class="parallax_cover">
       <div class="simpleParallax">
            <img src="themes/kentha/assets/images/page-header-default.jpg" alt="bg_image"
             class="cover-parallax">
        </div>
    </div>
    <div class="page_header_content">
       <div class="auto-container">
          <div class="row">
             <div class="col-md-12">
                <div class="banner_title_inner">
                   <div class="title_page">
                      Servicios
                   </div>
                </div>
             </div>
             <div class="col-lg-12">
                <div class="breadcrumbs creote">
                   <ul class="breadcrumb m-auto">
                      <li><a href="">Home</a></li>
                      <li class="active">Servicios</li>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>


<!--===============spacing==============-->
<div class="pd_top_90"></div>
<!--===============spacing==============-->
<x-servicios-area-pagina />
<!--===============spacing==============-->
<div class="pd_top_80"></div>



<x-footer-area />


<x-modal-area />