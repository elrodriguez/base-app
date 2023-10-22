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
        $programs = OnliItem::where('status', true)->orderBy('id', 'DESC')->get();
        return view('capperu/index', [
            'programs' => $programs
        ]);
    }
}
