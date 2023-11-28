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
            ->join('aca_category_courses', 'aca_category_courses.id', 'aca_courses.category_id')
            ->select(
                'onli_items.id as id',
                'onli_items.name as name',
                'onli_items.image as image',
                'onli_items.price as price',
                'onli_items.additional as additional',
                'onli_items.additional1 as additional1',
                'onli_items.additional2 as additional2',
                'people.names as teacher',
                'aca_teachers.id as teacher_id',
                'users.avatar as avatar',
                'onli_items.description as description',
                'aca_courses.id as course_id',
                'aca_category_courses.description as category_description'
            )
            ->where('onli_items.status', true)->orderBy('onli_items.id', 'DESC')
            ->limit(8)
            ->get();

        return view('capperu/index', [
            'programs' => $programs
        ]);
    }

    public function testimage($content, $fecha = null)
    {


        if ($fecha == null) {
            echo "Agrega un Slash '/' y agrega la fecha ejemplo 'test-image/Miguel de Cervantes Saavedra/23-01-2021'";
        } else {
            // create Image from file
            $img = Image::make('https://aprendiendoconsira.com/wp-content/uploads/2022/06/5-2000x1000.png');


            // write text
            //$img->text('The quick brown fox jumps over the lazy dog.');

            // write text at position
            //$img->text('The quick brown fox jumps over the lazy dog.', 120, 100);

            $img->text($content, 1070, 496, function ($font) {
                $font->file('fonts/OLDENGL.TTF');
                $font->size(72);
                $font->color('#0d0603');
                $font->align('center');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text("Entregado el: " . $fecha, 120, 15, function ($font) {
                $font->file('fonts/OLDENGL.TTF');
                $font->size(40);
                $font->color('#0d0603');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text("Pragot Especialistas en Especialización y mejora continua.", 1840, 15, function ($font) {
                $font->file('fonts/OLDENGL.TTF');
                $font->size(40);
                $font->color('#0d0603');
                $font->align('right');
                $font->valign('top');
                $font->angle(0);
            });

            $qr = Image::make('https://borealtech.com/wp-content/uploads/2018/10/codigo-qr-1024x1024-1.jpg');
            $qr->fit(200, 200);
            $img->insert($qr, 'bottom-left', 30, 30);


            // Ejemplo de Redimensionar la imagen manteniendo la proporción para avatares y similares
            // Establecer el ancho máximo y la altura máxima deseados
            $maxWidth = 1550;
            $maxHeight = 1550;
            $img->resize($maxWidth, $maxHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
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
}
