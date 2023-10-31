<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Onlineshop\Entities\OnliItem;

class WebController extends Controller
{
    public function index()
    {
        //return view('kentha/index');
        return view('capperu/index');
    }

    public function capperu()
    {
            $programs = OnliItem::join('aca_courses', 'onli_items.item_id', '=', 'aca_courses.id')
                ->join('aca_teachers', 'aca_teachers.id', '=', 'aca_courses.teacher_id')
                ->join('people', 'people.id', '=', 'aca_teachers.person_id')
                ->join('users', 'users.person_id', '=', 'people.id')
                ->select('onli_items.id as id', 'onli_items.name as name', 'onli_items.image as image', 'onli_items.price as price', 'onli_items.additional as additional', 'onli_items.additional1 as additional1',
                'onli_items.additional2 as additional2', 'people.names as teacher', 'aca_teachers.id as teacher_id', 'users.avatar as avatar', 'onli_items.description as description')
                ->where('onli_items.status', true)->orderBy('onli_items.id', 'DESC')->get();
                
        return view('capperu/index', [
            'programs' => $programs
        ]);
    }
}
