<?php

namespace App\Queries;

use App\Models\News;
use App\Models\NewsSources;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class NewsSourcesQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = NewsSources::query();
    }

    public function getNewsSources(): Collection
    {
        return $this->model
            ->get()
            ->sortByDesc('id');
    }

    public function getNewsSourceById($id)
    {
        return $this->model
            ->where('id', '=', $id)
            ->first();
    }

    public function insert(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->getNewsSourceById($id)->fill($data)->save();
    }

    public function remove($id)
    {
        return $this->getNewsSourceById($id)->delete();
    }

    function fillNews($parseNews, $id){
        $category = (new CategoriesQueryBuilder())->insert(['title'=>$parseNews['title']]);
        $data=[];
        foreach($parseNews['news'] as $item){
            $data []=  ['title' => $item['title'],
                        'text' => $item['description'],
                        'is_private' => false,
                        'category_id' => $category->id,
                        'news_source_id' => $id];
        }
       return (new News())->insert($data);
    }
}
