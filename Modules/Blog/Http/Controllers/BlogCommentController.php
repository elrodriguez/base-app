<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Entities\BlogComment;

class BlogCommentController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('blog::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'article_id' => 'required',
        ]);

        $user = Auth::user();

        BlogComment::create([
            'message' => htmlentities($request->get('message'), ENT_QUOTES, "UTF-8"),
            'user_id' => $user->id,
            'person_id' => $user->person_id,
            'article_id' => $request->get('article_id'),
            'appreciate' => 0,
            'comment_id' => $request->get('comment_id') ?? null
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function appreciateStore(Request $request)
    {
        $comment = BlogComment::find($request->get('id'));
        $comment->increment('appreciate', 1);

        return response()->json(['appreciate' => $comment->appreciate]);
    }

    public function storeReply(Request $request)
    {
        $user = Auth::user();

        $msg = $request->get('reply') ?? null;
        $reply = [];
        if ($msg) {
            $reply = BlogComment::create([
                'message' => htmlentities($msg, ENT_QUOTES, "UTF-8"),
                'user_id' => $user->id,
                'person_id' => $user->person_id,
                'article_id' => $request->get('article_id'),
                'appreciate' => 0,
                'comment_id' => $request->get('id') ?? null
            ]);

            $reply = BlogComment::with('person')->where('id', $reply->id)->first();
        }

        return response()->json([
            'reply' => $reply
        ]);
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
        $message = null;
        $success = false;
        try {
            // Usamos una transacción para asegurarnos de que la operación se realice de manera segura.
            DB::beginTransaction();

            // Verificamos si existe.
            $item = BlogComment::findOrFail($id);

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
