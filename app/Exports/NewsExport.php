<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class NewsExport implements FromCollection
{
    protected $news;


    public function __construct(array $news)
    {
        $title_news =  ['Категория', 'Название', 'Новость', 'Приватная'];
        array_unshift(  $news, $title_news);
        $this->news = $news;
    }

    public function collection()
    {
        return new Collection($this->news);
    }
}

