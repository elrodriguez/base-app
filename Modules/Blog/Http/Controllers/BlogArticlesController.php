<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Blog\Entities\BlogArticle;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Str;

class BlogArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use ValidatesRequests;

    public function index()
    {
        $articles = (new BlogArticle())->newQuery();

        if (request()->has('search')) {
            $articles->where('title', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $articles->orderBy($attribute, $sort_order);
        } else {
            $articles->latest();
        }

        $articles = $articles->paginate(10)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Blog::articles/List', [
            'articles' => $articles,
            'filters' => request()->all('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return Inertia::render('Blog::articles/Create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255|unique:blog_articles,url',
            'content_text' => 'required'
        ]);

        BlogArticle::create([
            'title'         => $request->get('title'),
            'content_text'  => htmlentities($request->get('content_text'), ENT_QUOTES, "UTF-8"),
            'url'           => Str::slug($request->get('title')),
            'status'        => $request->get('status')
        ]);

        return redirect()->route('blog-article.index')
            ->with('message', 'Articulo creado con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(BlogArticle $blogArticle)
    {
        return Inertia::render('Blog::articles/Edit', ['article' => $blogArticle]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, BlogArticle $blogArticle)
    {
        $this->validate($request, [
            'title' => 'required|max:255|unique:blog_articles,url,' . $blogArticle->id,
            'content_text' => 'required'
        ]);

        $blogArticle->update([
            'title'         => $request->get('title'),
            'content_text'  => htmlentities($request->get('content_text'), ENT_QUOTES, "UTF-8"),
            'url'           => Str::slug($request->get('title')),
            'status'        => $request->get('status')
        ]);

        return redirect()->route('blog-article.edit', $blogArticle->id)
            ->with('message', 'Categoria updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(BlogArticle $blogArticle)
    {
        $blogArticle->delete();

        return redirect()->route('blog-article.index')
            ->with('message', __('Artículo eliminado con éxito'));
    }
}
