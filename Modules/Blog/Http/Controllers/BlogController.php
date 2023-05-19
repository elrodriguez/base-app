<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Blog\Entities\BlogArticle;

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
}
