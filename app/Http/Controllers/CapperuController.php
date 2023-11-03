<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Onlineshop\Entities\OnliItem;
use App\Models\Person;

class CapperuController extends Controller
{
    public function nosotros()
    {
        return view('Capperu/nosotros');
    }

    public function categorias()
    {
        return view('Capperu/categorias');
    }

    public function categoriasector()
    {
        return view('Capperu/categoria-sector');
    }

    public function categoriamodalidad()
    {
        return view('Capperu/categoria-modalidad');
    }

    public function categoriamodalidadenvivo()
    {
        return view('Capperu/categoria-modalidad-en-vivo');
    }

    public function categoriamodalidadelearning()
    {
        return view('Capperu/categoria-modalidad-e-learning');
    }

    public function categoriaprogramacursos()
    {
        return view('Capperu/categoria-programa-cursos');
    }

    public function categoriaprogramadiplomados()
    {
        return view('Capperu/categoria-programa-diplomados');
    }

    public function modalidadpresencial()
    {
        return view('Capperu/modalidad-presencial');
    }

    public function sectorcursos()
    {
        $programs = OnliItem::join('aca_courses', 'onli_items.item_id', '=', 'aca_courses.id')
                ->join('aca_teachers', 'aca_teachers.id', '=', 'aca_courses.teacher_id')
                ->join('people', 'people.id', '=', 'aca_teachers.person_id')
                ->join('users', 'users.person_id', '=', 'people.id')
                ->select('onli_items.id as id', 'onli_items.name as name', 'onli_items.image as image', 'onli_items.price as price', 'onli_items.additional as additional', 'onli_items.additional1 as additional1',
                'onli_items.additional2 as additional2', 'people.names as teacher', 'aca_teachers.id as teacher_id', 'users.avatar as avatar', 'onli_items.description as description')
                ->where('onli_items.status', true)->orderBy('onli_items.id', 'DESC')->get();
                
        return view('Capperu/sector-cursos', [
            'programs' => $programs
        ]);
    }

    public function sectordiplomados()
    {
        return view('Capperu/sector-diplomados');
    }

    public function descripcionenvivo()
    {
        return view('Capperu/descripcion-en-vivo');
    }

    public function descripcionelearning()
    {
        return view('Capperu/descripcion-e-learning');
    }


    public function perfildocente($teacher_id)
    {
        $teacher = Person::join('users', 'people.id','users.person_id')
                            ->join('aca_teachers', 'aca_teachers.person_id', 'people.id')
                            ->where('aca_teachers.id', $teacher_id)
                            ->select('people.names as names', 'people.father_lastname as ApellidoP', 'people.presentacion as presentation')
                            ->select('users.avatar as avatar')
                            ->first();

        $programs = OnliItem::join('aca_courses', 'onli_items.item_id', '=', 'aca_courses.id')
                ->join('aca_teachers', 'aca_teachers.id', '=', 'aca_courses.teacher_id')
                ->join('people', 'people.id', '=', 'aca_teachers.person_id')
                ->join('users', 'users.person_id', '=', 'people.id')
                ->select('onli_items.id as id', 'onli_items.name as name', 'onli_items.image as image', 'onli_items.price as price', 'onli_items.additional as additional', 'onli_items.additional1 as additional1',
                'onli_items.additional2 as additional2', 'people.names as teacher', 'aca_teachers.id as teacher_id', 'users.avatar as avatar', 'onli_items.description as description')
                ->where('onli_items.status', true)
                ->where('aca_teachers.id', $teacher_id)
                ->orderBy('onli_items.id', 'DESC')->get();

        return view('Capperu/perfil-docente', [
            'programs'  => $programs,
            'teacher'   => $teacher
        ]);
    }

    public function carrito(Request $request)
    {
        return view('Capperu/carrito');
    }

    public function pagar()
    {
        return view('Capperu/pagar');
    }

    public function contacto()
    {
        return view('Capperu/contacto');
    }

    public function convenios()
    {
        return view('Capperu/convenios');
    }
}
