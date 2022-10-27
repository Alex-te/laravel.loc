<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\NewsSourcesQueryBuilder;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        return view('admin.news', [
            'news' => (new NewsQueryBuilder())->getNews(),
            'categories' => (new CategoriesQueryBuilder())->getCategories(),
            'newsSources' => (new NewsSourcesQueryBuilder())->getNewsSources()
        ]);
    }


    public function create()
    {
        $categories = new CategoriesQueryBuilder();
        $newsSource = new NewsSourcesQueryBuilder();
//        $builder = new NewsQueryBuilder();

        return view('admin.create', [
            'categories' => $categories->getCategories(),
            'news' => null,
            'newsSource' => $newsSource->getNewsSources()
        ]);
    }


    public function store(CreateRequest $request, NewsQueryBuilder $builder, CategoriesQueryBuilder $categories)
    {
        $news = $builder->insert($request->validated());
        if (!empty($news)) {
            $category_slug = $categories->getCategoryById($news->category_id)->slug;
            return redirect()->route('news.show', [$category_slug, $news->id])
                ->with('success', __('messages.admin.news.create.success'));
        } else {
            return redirect()->route('admin.news.index')
                ->with('error', __('messages.admin.news.create.error'));
        }
    }


    public function show(
        $id,
        NewsQueryBuilder $builder,
        CategoriesQueryBuilder $categories,
        NewsSourcesQueryBuilder $newsSources
    ) {
        return view('admin.create', [
            'categories' => $categories->getCategories(),
            'news' => $builder->getNewsById($id),
            'newsSource' => $newsSources->getNewsSources()
        ]);
    }


    public function edit()
    {
    }

    public function update(UpdateRequest $request, NewsQueryBuilder $builder, $id)
    {
        if ($builder->update($id, $request->validated())) {
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.update.success'));
        } else {
            return redirect()->back()
                ->with('error', __('messages.admin.news.update.error'));
        }
    }


    public function destroy($id, NewsQueryBuilder $builder)
    {
        if ($builder->remove($id)) {
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.remove.success'));
        } else {
            return redirect()->back()
                ->with('error', __('messages.admin.news.remove.error'));
        }
    }


}
