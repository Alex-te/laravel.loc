<?php

namespace App\Queries;

use App\Models\Categories;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoriesQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = Categories::query();
    }

    public function getCategories(): Collection
    {
        return $this->model
            ->get()->keyBy('id');
    }

    public function getCategoryById($id)
    {
        return $this->model
            ->where('id', '=', $id)
            ->first();
    }

    public function getNewsByCategoryId($id)
    {
        return News::query()
            ->where('category_id', '=', $id)
            ->get();
    }

    public function getCategoryBySlug($slug)
    {
        return $this->model
            ->where('slug', '=', $slug)
            ->first();
    }

    public function getNewsByCategorieSlug($slug){
        return $this->model
            ->select('news.id', 'news.title', 'news.text', 'news.is_private', 'news.category_id')
            ->join('news', 'news.category_id', '=', 'categories.id')
            ->where('categories.slug', '=', $slug)
            ->get();
    }

    public function insert(array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->getCategoryById($id)->fill($data)->save();
    }

    public function remove($id)
    {
        $news_remove = News::query()
            ->where('category_id', '=', $id);
        if($news_remove->count() > 0){
            $news_remove->delete();
        }
        return $this->getCategoryById($id)->delete();
    }
}
