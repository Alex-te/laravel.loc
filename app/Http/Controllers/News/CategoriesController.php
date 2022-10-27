<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Categories;

use App\Queries\CategoriesQueryBuilder;

use function abort;
use function view;

class CategoriesController extends Controller
{
    function index(Categories $categories)
    {
        $categories = $categories->all();
        return view('news.categories')->with('categories', $categories);
    }

    function show($slug )
    {
        //с этим надо что-то делать
        $builder = (New CategoriesQueryBuilder);
        $news = $builder->getNewsByCategorieSlug($slug);
        $builder = (New CategoriesQueryBuilder);
        $name = $builder->getCategoryBySlug($slug);

        return $news->count() > 0 ?
            view('news.catsOne')
            ->with('categories', $news)
            ->with('category_name', $name ?? 'Без назавания'):
            redirect()->route('news.categories');

    }
}
