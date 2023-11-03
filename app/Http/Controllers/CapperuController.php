<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Onlineshop\Entities\OnliItem;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use Modules\Onlineshop\Entities\OnliSale;
use Modules\Onlineshop\Entities\OnliSaleDetail;
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
                'onli_items.description as description'
            )
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
        $teacher = Person::join('users', 'people.id', 'users.person_id')
            ->join('aca_teachers', 'aca_teachers.person_id', 'people.id')
            ->where('aca_teachers.id', $teacher_id)
            ->select('people.names as names', 'people.father_lastname as ApellidoP', 'people.presentacion as presentacion', 'users.avatar as avatar')
            ->first();

        $programs = OnliItem::join('aca_courses', 'onli_items.item_id', '=', 'aca_courses.id')
            ->join('aca_teachers', 'aca_teachers.id', '=', 'aca_courses.teacher_id')
            ->join('people', 'people.id', '=', 'aca_teachers.person_id')
            ->join('users', 'users.person_id', '=', 'people.id')
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
                'onli_items.description as description'
            )
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

    public function pagar(Request $request)
    {
        try {
            $sale_id = $request->get('sale');
        $sale = OnliSale::find($sale_id);

        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_TOKEN'));
        $client = new PreferenceClient();

        $mp_items = [];
        $preference_id = null;

        $cart_items = [];

        $sale_details = OnliSaleDetail::where('sale_id', $sale_id)->get();

        foreach ($sale_details as $k => $sale_detail) {
            $item = OnliItem::join('aca_courses', 'onli_items.item_id', '=', 'aca_courses.id')
                ->leftJoin('aca_teachers', 'aca_teachers.id', '=', 'aca_courses.teacher_id')
                ->join('people', 'people.id', '=', 'aca_teachers.person_id')
                ->join('users', 'users.person_id', '=', 'people.id')
                ->where('onli_items.id', $sale_detail->onli_item_id)
                ->select(
                    'onli_items.*',
                    'people.names as teacher',
                    'aca_teachers.id as teacher_id',
                    'users.avatar as avatar',
                    'onli_items.description as description'
                )
                ->first();

            $mp_items[$k] = [
                'id' => $item->id,
                'title' => $item->name,
                'description'   => $item->category_description . ' ' . $item->additional . ' ' . $item->additional1,
                'picture_url'   => $item->image,
                'category_id'   => $item->category_description,
                'quantity'      => 1,
                'currency_id'   => 'PEN',
                'unit_price'    => floatval($item->price)
            ];

            $cart_items[$k] = [
                'id'                        => $item->id,
                'name'                      => $item->name,
                'image'                     => $item->image,
                'price'                     => $item->price,
                'category_description'      => $item->category_description,
                'additional'                => $item->additional,
                'additional1'               => $item->additional1,
                'teacher'                   => $item->teacher,
                'teacher_id'                => $item->teacher_id,
                'avatar'                    => $item->avatar,
                'description'               => $item->description
            ];
        }

        $preference = $client->create([
            "items" => $mp_items,
            "back_urls" =>  array(
                'success' => route('onlineshop_response_mercadopago'),
                'failure' => route('onlineshop_response_mercadopago'),
                'pending' => route('onlineshop_response_mercadopago')
            )
        ]);

        $preference_id =  $preference->id;

        return view('Capperu/pagar', [
            'person_full_name'  => $sale->clie_full_name,
            'preference_id'     => $preference_id,
            'cart_items'        => $cart_items
        ]);
        } catch (\Throwable $th) {
             return redirect('carrito');
        }
        
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
