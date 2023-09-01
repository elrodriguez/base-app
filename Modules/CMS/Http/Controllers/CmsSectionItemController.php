<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Modules\CMS\Entities\CmsSectionItem;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Modules\CMS\Entities\CmsItem;
use Modules\CMS\Entities\CmsSection;

class CmsSectionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        // EDITANDO --- 
        $items = (new CmsItem())->newQuery();

        if (request()->has('search')) {
            $items->where('description', 'like', '%' . request()->input('search') . '%');
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

        $items = $items->where(function ($query) use ($id) {
            $query->select('cms_section_items.item_id')
                ->from('cms_section_items')
                ->whereColumn('cms_section_items.item_id', 'cms_items.id')
                ->where('cms_section_items.section_id', $id)
                ->doesntExist();
        }, 'pro');



        $items = $items->paginate(10)->onEachSide(2);


        $items->getCollection()->transform(function ($item) {
            $item->display = true;
            return $item;
        });

        $sItems = CmsSectionItem::join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
            ->select(
                'cms_items.id',
                'cms_items.type_id',
                'cms_items.position',
                'cms_items.content',
                'cms_items.description',
                'cms_section_items.id AS si_id',
                'cms_section_items.description AS si_description'
            )
            ->where('section_id', $id)->get();

        return Inertia::render('CMS::Sections/Items/List', [
            'section'   => CmsSection::find($id),
            'items'     => $items,
            'sItems'    => $sItems
        ]);
    }

    public function store(Request $request)
    {
        $items = $request->get('data');
        $section_id = $request->get('section_id');
        $description = $request->get('description');

        if (count($items) > 0) {
            foreach ($items as $k => $item) {
                CmsSectionItem::create([
                    'item_id'       => $item['id'],
                    'section_id'    => $section_id,
                    'position'      => 0,
                    'description'   => $description
                ]);
            }
        }
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
