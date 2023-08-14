<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\CMS\Entities\CmsItem;
use Modules\CMS\Entities\CmsItemType;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CmsItemController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $types = CmsItemType::all();
        $items = (new CmsItem())->newQuery();
        if (request()->has('search')) {
            $items->whereDate('type_id', '=', request()->input('search'));
        }
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $items->orderBy($attribute, $sort_order);
        } else {
            $items->latest();
        }

        $items = $items->paginate(10)->onEachSide(2);

        return Inertia::render('CMS::Items/List', [
            'types' => $types,
            'items' => $items,
            'filters' => request()->all('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $types = CmsItemType::all();
        return inertia::render('CMS::Items/Create', ['types' => $types,]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'type_id' => 'required',
                'content' => 'required',
            ],
            [
                'type_id.required' => 'el campo tipo es obligatorio',
                'content.required' => 'el campo contenido es obligatorio',
            ]
        );

        CmsItem::create([
            'type_id',
            'position',
            'content'
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('cms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
