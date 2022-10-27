<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NewsExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use App\Models\NewsSources;
use App\Queries\CategoriesQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class IndexController extends Controller
{
    function index()
    {
        return view('admin.index');
    }



    function test1()
    {
        return response()->download('1.png');
    }


    function test2(Request $request, CategoriesQueryBuilder $builder)
    {
        if ($request->isMethod('post')) {
            $news = [];
            foreach ($builder->getNewsByCategoriesId($request->except('_token')['category_id']) as $item) {
                $news[] = [
                    $builder->getCategoryById($item->category_id)->title,
                    $item->title,
                    $item->text,
                    ($item->is_private ? 'да' : 'нет')
                ];
            }
            $export = new NewsExport($news);

            return Excel::download($export, 'news.xlsx');
        }
        return view('admin.test2', ['categories' => $builder->getCategories()]);
    }


}
