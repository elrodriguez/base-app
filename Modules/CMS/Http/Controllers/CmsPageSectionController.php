<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\CmsPageSection;
use Inertia\Inertia;

class CmsPageSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
                // EDITANDO --- APRENDIENDO
        
                $pagesSections = (new CmsPageSection())->newQuery();
                 if (request()->has('search')) {
                     $pagesSections->whereDate('summardescriptiony_date', 'like', '%' . request()->input('search') . '%');
                 }
                if (request()->query('sort')) {
                    $attribute = request()->query('sort');
                    $sort_order = 'ASC';
                    if (strncmp($attribute, '-', 1) === 0) {
                        $sort_order = 'DESC';
                        $attribute = substr($attribute, 1);
                    }
                    $pagesSections->orderBy($attribute, $sort_order);
                } else {
                    $pagesSections->latest();
                }
        
                $pagesSections = $pagesSections->paginate(10)->onEachSide(2);
        
                
                return Inertia::render('CMS::Pages/Sections/List', [
                    'sections' => $pagesSections
                ]); 
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
