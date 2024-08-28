<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Blog\Entities\BlogCategory;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Blog\Entities\BlogArticle;

class BlogCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use ValidatesRequests;

    public function index()
    {
        $gategories = (new BlogCategory())->newQuery();

        if (request()->has('search')) {
            $gategories->where('description', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $gategories->orderBy($attribute, $sort_order);
        } else {
            $gategories->latest();
        }

        $gategories = $gategories->paginate(10)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Blog::categories/List', [
            'categories' => $gategories,
            'filters' => request()->all('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return Inertia::render('Blog::categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|max:255'
        ]);

        BlogCategory::create([
            'description' => $request->get('description'),
            'status'        => $request->get('status')
        ]);

        return redirect()->route('blog-category.index')
            ->with('message', 'Categoria creado con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(BlogCategory $blogCategory)
    {
        return Inertia::render('Blog::categories/Edit', [
            'category' => $blogCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $this->validate($request, [
            'description' => 'required|max:255'
        ]);

        $blogCategory->update([
            'description'   => $request->get('description'),
            'status'        => $request->get('status') ? $request->get('status') : false
        ]);

        return redirect()->route('blog-category.edit', $blogCategory->id)
            ->with('message', 'Categoria updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();

        return redirect()->route('blog-category.index')
            ->with('message', __('Category deleted successfully'));
    }

    public function articlesAll($id)
    {
        $articlesCategory = BlogArticle::with(['author', 'comments'])
            ->withCount('comments')
            ->where('category_id', $id)
            ->get();

        $categories = BlogCategory::where('status', true)->get();

        $articles = BlogArticle::orderByDesc('views')->take(4)->get();

        $archives = BlogArticle::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total_articles')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        return Inertia::render('Blog::categories/Articles', [
            'articlesCategory' => $articlesCategory,
            'categories' => $categories,
            'articles' => $articles,
            'archives' => $archives,
            'category_id' => $id
        ]);
    }
}
