<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapperuController extends Controller
{
    public function nosotros(){
        return view('Capperu/nosotros');
    }

    public function categorias(){
        return view('Capperu/categorias');
    }

    public function categoriasector(){
        return view('Capperu/categoria-sector');
    }

    public function categoriamodalidad(){
        return view('Capperu/categoria-modalidad');
    }

    public function categoriaprogramacursos(){
        return view('Capperu/categoria-programa-cursos');
    }

    public function categoriaprogramadiplomados(){
        return view('Capperu/categoria-programa-diplomados');
    }

    public function modalidadpresencial(){
        return view('Capperu/modalidad-presencial');
    }

    public function carrito(){
        return view('Capperu/carrito');
    }

    
    public function contacto(){
        return view('Capperu/contacto');
    }

}
