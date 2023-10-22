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

    public function categoriamodalidadenvivo(){
        return view('Capperu/categoria-modalidad-en-vivo');
    }

    public function categoriamodalidadelearning(){
        return view('Capperu/categoria-modalidad-e-learning');
    }

    public function categoriaprogramacursos(){
        return view('Capperu/categoria-programa-cursos');
    }

    public function categoriaprogramadiplomados(){
        return view('Capperu/categoria-programa-diplomados');
    }

    public function sectorcursos(){
        return view('Capperu/sector-cursos');
    }

    public function sectordiplomados(){
        return view('Capperu/sector-diplomados');
    }

    public function descripcionenvivo(){
        return view('Capperu/descripcion-en-vivo');
    }

    public function descripcionelearning(){
        return view('Capperu/descripcion-e-learning');
    }

    public function perfildocente(){
        return view('Capperu/perfil-docente');
    }

    public function carrito(){
        return view('Capperu/carrito');
    }

    
    public function contacto(){
        return view('Capperu/contacto');
    }

}
