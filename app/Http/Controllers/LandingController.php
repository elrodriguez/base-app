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

    public function redirectToWhatsApp($id)
    {
        $product = OnliItem::find($id);
        $telefono = '51921008708';
        $mensaje = 'Hola, estoy interesado en el producto: ' . $product->name . ' Precio: ' . $product->price;

        $urlWhatsApp = 'https://api.whatsapp.com/send/?phone=' . $telefono . '&text=' . urlencode($mensaje) . '&type=phone_number&app_absent=0';

        return redirect()->away($urlWhatsApp);
    }
}
