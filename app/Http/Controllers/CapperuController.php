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

    public function carrito(){
        return view('Capperu/carrito');
    }

    
    public function contacto(){
        return view('Capperu/contacto');
    }

}
