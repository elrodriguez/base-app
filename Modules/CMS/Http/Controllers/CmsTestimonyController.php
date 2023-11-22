<?php

namespace Modules\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Parameter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Modules\CMS\Entities\CmsTestimony;
use Modules\Onlineshop\Entities\OnliItem;

class CmsTestimonyController extends Controller
{
    protected $P000009;
    protected $reg;

    public function __construct()
    {
        $vallue = Parameter::where('parameter_code', 'P000009')->value('value_default');
        $this->P000009 = $vallue ?? 1;
        $this->reg = env('RECORDS_PAGE_TABLE');
    }

    public function index()
    {
        $testimonies = (new CmsTestimony())->newQuery();
        if (request()->has('search')) {
            $testimonies->where('title', 'like', '%' . request()->input('search') . '%');
        }
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $testimonies->orderBy($attribute, $sort_order);
        } else {
            $testimonies->latest();
        }


        $testimonies = $testimonies->paginate($this->reg)->onEachSide(2);

        return Inertia::render('CMS::Testimonies/List', [
            'testimonies' => $testimonies,
            'filters' => request()->all('search'),
            'type'  => $this->P000009
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = [];

        if ($this->P000009 == 2) {
            $items = OnliItem::select(
                'id AS value',
                'name'
            )
                ->where('entitie', 'App-Models-Product')
                ->get();
        }
        return Inertia::render('CMS::Testimonies/Create', [
            'venture'  => $this->P000009,
            'items' => $items,
            'tiny_api_key' => env('TINY_API_KEY')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'item_id' => 'required',
                'title' => 'required|max:255',
                'description' => 'required',
                'image' => 'required',
                'video' => 'required'
            ],
            [
                'item_id.required' => 'el campo producto o servicio es obligatorio',
                'title.required' => 'el campo titulo es obligatorio',
                'title.max' => 'el campo titulo solo acepta 255 caracteres',
                'description.required' => 'el campo Descripción es obligatorio',
                'image.required' => 'el campo imagen es obligatorio',
                'video.required' => 'el campo vídeo es obligatorio',
            ]
        );

        $destination = 'uploads/cms/testimonies';
        $file = $request->file('image');
        $path = null;

        if ($file) {
            $original_name = strtolower(trim($file->getClientOriginalName()));
            $original_name = str_replace(" ", "_", $original_name);
            $extension = $file->getClientOriginalExtension();
            $file_name = date('YmdHis') . '.' . $extension;
            $img = $request->file('image')->storeAs(
                $destination,
                $file_name,
                'public'
            );

            $path  = asset('storage/' . $img);
        }

        CmsTestimony::create([
            'item_id'           => $request->get('item_id'),
            'entitie'           => OnliItem::class,
            'title'             => $request->get('title'),
            'description'       => $request->get('description'),
            'image'             => $path,
            'video'             => $request->get('video'),
            'status'            => $request->get('status') ? true : false
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('cms::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('cms::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
