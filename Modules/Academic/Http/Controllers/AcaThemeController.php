<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Academic\Entities\AcaTheme;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AcaThemeController extends Controller
{
    use ValidatesRequests;

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'position' => 'required',
                'description' => 'required|max:255'
            ]
        );

        $theme = AcaTheme::create([
            'module_id'     => $request->get('module_id'),
            'position'      => $request->get('position'),
            'description'   => $request->get('description')
        ]);

        return response()->json([
            'theme' => $theme
        ]);
    }

    public function destroy($id)
    {
        //
    }
}
