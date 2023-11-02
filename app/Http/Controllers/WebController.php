<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Onlineshop\Entities\OnliItem;

use Intervention\Image\Facades\Image;
use Intervention\Image\Font;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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

    public function testimage($content){

        // create Image from file
$img = Image::make('http://base-app.test/storage/uploads/onlineshop/items/20231031043434.jpg');

// write text
//$img->text('The quick brown fox jumps over the lazy dog.');

// write text at position
//$img->text('The quick brown fox jumps over the lazy dog.', 120, 100);




$img->text($content, 300, 500, function($font) {
    $font->file('fonts/OLDENGL.TTF');
    $font->size(46);
    $font->color('#0d06e3');
    $font->align('center');
    $font->valign('top');
    $font->angle(0);
});

// Obtener el contenido binario de la imagen
$imageContent = $img->encode('png');

// Generar la respuesta HTTP con la imagen
$response = Response::make($imageContent);

// Establecer el tipo de contenido de la respuesta como imagen PNG
$response->header('Content-Type', 'image/png');

// Retornar la respuesta
return $response;
    }
}
