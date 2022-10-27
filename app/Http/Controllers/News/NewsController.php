<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;

use App\Queries\CategoriesQueryBuilder;

use App\Queries\NewsQueryBuilder;

use function abort;
use function view;

class NewsController extends Controller
{
    function index(NewsQueryBuilder $news): string
    {

        return view('news')->with('news', $news->getNews());
    }

    function show($slug, $id, NewsQueryBuilder $news, CategoriesQueryBuilder $builder)
    {
        $news = $news->getNewsById($id);
        return is_null($news) ?
            abort(404) :
            view('news.show')
                ->with('news', $news)
                ->with('category', $builder->getCategoryBySlug($slug));
    }

}
