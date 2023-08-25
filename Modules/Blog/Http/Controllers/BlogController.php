<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Blog\Entities\BlogArticle;
use Modules\Blog\Entities\BlogCategory;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $articles = BlogArticle::where('status', true)->get();
        return view('blog::index_tutos')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function dashboard()
    {
        return Inertia::render('Blog::Dashboard');
    }


    public function article($url)
    {
        $article = BlogArticle::where('url', $url);
        $article->increment('views');
        return view('blog::tutorials.article')->with('article', $article->first());
    }


    public function policies()
    {
        return view('blog::tutorials.policies');
    }

    public function contactUs()
    {
        return view('blog::tutorials.contact_us');
    }
    public function storiesArticle($url)
    {
        $article = BlogArticle::where('url', $url);
        $article->increment('views');
        return view('blog::stories.article')->with('article', $article->first());
    }


    public function storiesPolicies()
    {
        return view('blog::stories.policies');
    }

    public function storiesContactUs()
    {
        return view('blog::stories.contact_us');
    }


    public function apiGetDataBlog()
    {
        $categories = BlogCategory::where('status', true)->get();

        $articles = BlogArticle::with('category')->with('author')
            ->where('status', true)
            ->paginate(10);

        $latest_articles = BlogArticle::select(
            'title',
            'imagen',
            'url',
            'created_at'
        )
            ->where('status', true)
            ->latest('created_at') // Ordena por la columna created_at en orden descendente
            ->take(4) // Limita el resultado a 4 registros
            ->get();

        return response()->json([
            'categories'        => $categories,
            'articles'          => $articles,
            'latest_articles'   => $latest_articles
        ]);
    }

    public function apiGetDataArticle($url)
    {
        $categories = BlogCategory::where('status', true)->get();

        $article = BlogArticle::where('url', $url)
            ->first();

        $latest_articles = BlogArticle::select(
            'title',
            'imagen',
            'url',
            'created_at'
        )
            ->where('status', true)
            ->latest('created_at') // Ordena por la columna created_at en orden descendente
            ->take(4) // Limita el resultado a 4 registros
            ->get();

        return response()->json([
            'categories'        => $categories,
            'articles'          => $article,
            'latest_articles'   => $latest_articles
        ]);
    }
}
