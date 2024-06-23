<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Academic\Entities\AcaThemeComment;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Academic\Entities\AcaTheme;

class AcaThemeCommentController extends Controller
{
    use ValidatesRequests;

    public function list($id)
    {
        $comments = AcaThemeComment::with('user')
            ->where('theme_id', $id)
            ->get();

        $comments->each(function ($comment) {
            $comment->created_atx = Carbon::parse($comment->created_at)->locale('es')->isoFormat('MMM D, YYYY');
            $comment->time_elapsed = timeElapsed($comment->created_at);
            $comment->edit_status = false;
            $comment->reply = false;
            $comment->loading = false;
        });

        return response()->json([
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academic::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'theme_id'   => 'required',
                'message'   => 'required',
            ]
        );

        //$theme = AcaTheme::find($request->theme_id);

        AcaThemeComment::create([
            'user_id' => Auth::id(),
            'theme_id' => $request->get('theme_id'),
            'description' => $request->get('message'),
            'i_like' => 0,
            'not_like' => 0
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('academic::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('academic::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        if ($request->get('description')) {
            AcaThemeComment::find($id)->update([
                'description' => $request->get('description'),
                'i_like' => $request->get('i_like'),
                'not_like' => $request->get('not_like')
            ]);
        }

        response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = null;
        $success = false;
        try {
            // Usamos una transacción para asegurarnos de que la operación se realice de manera segura.
            DB::beginTransaction();

            // Verificamos si existe.
            $item = AcaThemeComment::findOrFail($id);

            // Si no hay detalles asociados, eliminamos.
            $item->delete();

            // Si todo ha sido exitoso, confirmamos la transacción.
            DB::commit();

            $message =  'Comentario eliminado correctamente';
            $success = true;
        } catch (\Exception $e) {
            // Si ocurre alguna excepción durante la transacción, hacemos rollback para deshacer cualquier cambio.
            DB::rollback();
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }
}
