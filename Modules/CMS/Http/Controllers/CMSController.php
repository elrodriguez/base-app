<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\CmsPageSection;

class CMSController extends Controller
{
    public function apiGetPageData($page_id)
    {
        //$page = CmsPageSection::with('sections.items.item')->where('page_id', $page_id)->get();

        $page = CmsPageSection::with(['sections.items' => function ($query) {
            $query->orderBy('position', 'asc'); // Ordena por el campo 'position' de la tabla 'cms_section_items'
        }, 'sections.items.item'])->where('page_id', $page_id)->get();

        return response()->json([
            'page' => $page
        ]);
    }
}
