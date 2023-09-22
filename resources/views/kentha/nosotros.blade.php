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
                      Nosotros
                   </div>
                </div>
             </div>
             <div class="col-lg-12">
                <div class="breadcrumbs creote">
                   <ul class="breadcrumb m-auto">
                      <li><a href="{{ route('cms_principal') }}">Home</a></li>
                      <li class="active">Nosotros</li>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
<x-about />
<x-footer-area />