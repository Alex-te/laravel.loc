<?php

namespace App\Queries;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

final class NewsQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = News::query();
    }

    private function getNewsData($data)
    {
        $getNews = $data;
        !isset($getNews['is_private'])
            ? $getNews['is_private'] = false
            : $getNews['is_private'] = true;
        return $getNews;
    }

    public function getNews(): LengthAwarePaginator
    {
        return
            $this->model
            ->paginate(config('pagination.admin.news'));
    }

    public function getNewsById($id)
    {
        return $this->model
            ->where('id', '=', $id)
            ->first();
    }

    public function insert(array $data)
    {
        return $this->model->create($this->getNewsData($data));
    }

    public function update($id, array $data)
    {

        return $this->getNewsById($id)->fill($this->getNewsData($data))->save();
    }

    public function remove($id)
    {
        return $this->getNewsById($id)->delete();
    }
}
