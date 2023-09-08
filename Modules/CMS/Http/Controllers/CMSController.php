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
        $page = CmsPageSection::with('sections.items.item')->where('page_id', $page_id)->get();

        return response()->json([
            'page' => $page
        ]);
    }
}
