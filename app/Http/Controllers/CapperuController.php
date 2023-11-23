<?php

namespace App\Http\Controllers;

use App\Mail\StudentRegistrationMailable;
use Illuminate\Http\Request;
use Modules\Onlineshop\Entities\OnliItem;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use Modules\Onlineshop\Entities\OnliSale;
use Modules\Onlineshop\Entities\OnliSaleDetail;
use App\Models\Person;
use Carbon\Carbon;
use Modules\Academic\Entities\AcaCapRegistration;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaStudent;

class CapperuController extends Controller
{
    public function nosotros()
    {
        return view('capperu/nosotros');
    }

    public function categorias()
    {
        return view('capperu/categorias');
    }

    public function categoriasector($sector)
    {
        
        return view('capperu/categoria-sector', [
            'sector' => $sector
        ]);
    }

    public function categoriamodalidad()
    {
        return view('capperu/categoria-modalidad');
    }

    public function categoriamodalidadenvivo()
    {
        return view('capperu/categoria-modalidad-en-vivo');
    }

    public function categoriamodalidadelearning()
    {
        return view('capperu/categoria-modalidad-e-learning');
    }

    public function categoriaprogramacursos()
    {
        return view('capperu/categoria-programa-cursos');
    }

    public function categoriaprogramadiplomados()
    {
        return view('capperu/categoria-programa-diplomados');
    }

    public function modalidadpresencial()
    {
        return view('capperu/modalidad-presencial');
    }

    public function sector_programs($sector, $tipo) //cursos o diplomados
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
                'onli_items.category_description as category_description'
            )
            ->where('onli_items.status', true)->orderBy('onli_items.id', 'DESC')
            ->where('onli_items.additional', $tipo)
            ->where('onli_items.additional2', $sector)->get();
            
        return view('capperu/sector-cursos', [
            'programs' => $programs
        ]);
    }

    public function descripcionPrograma($id)
    {
        $item = OnliItem::find($id);
        
        $course = AcaCourse::with('category')
            ->with('modality')
            ->with('modules')
            ->with('teachers.teacher.person.resumes')
            ->with('brochure')
            ->with('agreements')
            ->where('id', $item->item_id)
            ->first();

        return view('capperu/descripcion-programa', [
            'course' => $course,
            'item' => $item
        ]);
    }

    public function descripcionelearning()
    {
        return view('capperu/descripcion-e-learning');
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
                'aca_category_courses.description as category_description'
            )
            ->where('onli_items.status', true)
            ->where('aca_teachers.id', $teacher_id)
            ->orderBy('onli_items.id', 'DESC')->get();

        return view('capperu/perfil-docente', [
            'programs'  => $programs,
            'teacher'   => $teacher
        ]);
    }

    public function carrito(Request $request)
    {
        return view('capperu/carrito');
    }

    public function pagar(Request $request)
    {
        $sale_id = $request->get('sale');
        $sale = OnliSale::find($sale_id);

        if (!$sale->response_payer) {
            MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_TOKEN'));
            $client = new PreferenceClient();

            $mp_items = [];
            $preference_id = null;

            $cart_items = [];

            $sale_details = OnliSaleDetail::where('sale_id', $sale_id)->get();
            $total = 0;

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

                $total = $total + floatval($item->price);
            }

            $preference = $client->create([
                "items" => $mp_items,
                "back_urls" =>  array(
                    'success' => route('web_gracias', $sale_id),
                    // 'failure' => route('onlineshop_response_mercadopago'),
                    // 'pending' => route('onlineshop_response_mercadopago')
                )
            ]);

            $preference_id =  $preference->id;
            $sale->total = $total;

            $sale->save();

            return view('capperu/pagar', [
                'person_full_name'  => $sale->clie_full_name,
                'preference_id'     => $preference_id,
                'cart_items'        => $cart_items
            ]);
        } else {
            return view('capperu/pagar', [
                'person_full_name'  => $sale->clie_full_name,
                'preference_id'     => null,
                'cart_items'        => []
            ]);
        }
    }

    public function contacto()
    {
        return view('capperu/contacto');
    }

    public function convenios()
    {
        return view('capperu/convenios');
    }

    public function gracias(Request $request, $sale_id)
    {
        $sale = OnliSale::find($sale_id);
        $saleDetails = OnliSaleDetail::where('sale_id', $sale_id)->get();
        //dd($request->all());
        $sale->response_status = $request->get('collection_status');
        $sale->response_id = $request->get('collection_id');
        $sale->response_date_approved = Carbon::now()->format('Y-m-d');
        $sale->response_payer = json_encode($request->all());
        $sale->response_payment_method_id = $request->get('payment_type');

        $sale->save();

        $person = Person::where('id', $sale->person_id)->first();
        $student = AcaStudent::where('person_id', $sale->person_id)->first();

        // al hacer el pago se realiza activa la patricula
        $courses = [];
        foreach ($saleDetails as $k => $detail) {
            AcaCapRegistration::where('student_id', $student->id)
                ->where('course_id', $detail->item_id)
                ->update([
                    'status' => true
                ]);
            $item = OnliItem::find($detail->onli_item_id);
            $courses[$k] = [
                'image'       => $item->image,
                'name'        => $item->name,
                'description' => $item->description,
                'type'        => $item->additional,
                'modality'    => $item->additional1,
                'sector'      => $item->category_description
            ];
        }

        //////////codigo enviar correo /////
        Mail::to('elrodriguez2423@gmail.com')
            ->send(new StudentRegistrationMailable([
                'courses'   => $courses,
                'user'      => $person->email,
                'password'  => $person->number
            ]));

        return view('capperu/gracias', [
            'person' => $person
        ]);
    }
}
