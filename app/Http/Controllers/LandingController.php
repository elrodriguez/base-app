<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Onlineshop\Entities\OnliItem;

use Intervention\Image\Facades\Image;
use Intervention\Image\Font;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Modules\CMS\Entities\CmsSection;
use Modules\CMS\Entities\CmsSectionItem;
use Modules\Sales\Entities\SaleProductCategory;

class LandingController extends Controller
{
    public function index()
    {
        $jumbotron = CmsSection::where('component_id', 'jumbotron_1')  //siempre cambiar el id del componente
            ->join('cms_section_items', 'section_id', 'cms_sections.id')
            ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
            ->select(
                'cms_items.content',
                'cms_section_items.position'
            )
            ->orderBy('cms_section_items.position')
            ->get();


        return Inertia::render('Landing/Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'jumbotron' => $jumbotron,
            'pageActive' => 'home'
        ]);
    }

    public function computerStore()
    {
        $categories = OnliItem::select('category_description')->groupBy('category_description')->get();
        $products = OnliItem::where('status', true)->inRandomOrder()->get();

        $promotions = CmsSection::where('component_id', 'carrusel_productos_2')
            ->with('items.item.items')
            ->first();
        //dd($promotions);
        return Inertia::render('Landing/ComputerStore', [
            'pageActive' => 'store',
            'categories' => $categories,
            'products' => $products,
            'promotions' => $promotions
        ]);
    }

    public function webhook()
    {
        //TOQUEN QUE QUERRAMOS PONER 
        $token = 'EAAF2Qg4wBKABO0YZAM7xRCYfurumZAmZBQ5MiePU6OTH1rifGA4fi7DoYn8WKBq6RvlZAZAVF0qayHyaWSrKCsLGrPgmvlRJ0KgWKFOw0sw4IFEgBCNjkFtQxyoLn5V6ShTdsGJbzL26ZBnMaWnyS9V7F7SAt97ARctxcumsaCoQcxxyMmEsaooIPYdImAgbVfknFRLk5ADFuG9bBE2mEZD';
        //RETO QUE RECIBIREMOS DE FACEBOOK
        $hub_challenge = isset($_GET['hub_challenge']) ? $_GET['hub_challenge'] : '';
        //TOQUEN DE VERIFICACION QUE RECIBIREMOS DE FACEBOOK
        $hub_verify_token = isset($_GET['hub_verify_token']) ? $_GET['hub_verify_token'] : '';
        //SI EL TOKEN QUE GENERAMOS ES EL MISMO QUE NOS ENVIA FACEBOOK RETORNAMOS EL RETO PARA VALIDAR QUE SOMOS NOSOTROS
        if ($token === $hub_verify_token) {
            echo $hub_challenge;
            exit;
        }
    }

    public function recibe()
    {
        //LEEMOS LOS DATOS ENVIADOS POR WHATSAPP
        $respuesta = file_get_contents("php://input");
        //echo file_put_contents("text.txt", "Hola");
        //SI NO HAY DATOS NOS SALIMOS
        if ($respuesta == null) {
            exit;
        }
        //CONVERTIMOS EL JSON EN ARRAY DE PHP
        $respuesta = json_decode($respuesta, true);
        //EXTRAEMOS EL TELEFONO DEL ARRAY
        $mensaje = "Telefono:" . $respuesta['entry'][0]['changes'][0]['value']['messages'][0]['from'] . "\n";
        //EXTRAEMOS EL MENSAJE DEL ARRAY
        $mensaje .= "Mensaje:" . $respuesta['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
        //GUARDAMOS EL MENSAJE Y LA RESPUESTA EN EL ARCHIVO text.txt
        file_put_contents("text.txt", $mensaje);
    }
}
