<?php

namespace Tests\Browser\Admin;

use App\Models\Categories;
use App\Models\News;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\NewsSourcesQueryBuilder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NewsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateForm()
    {
        $news = News::factory()->create();
        $this->browse(function (Browser $browser) use ($news) {
            $browser->visit('/admin/news_single/id')
                ->type('title', $news->title)
                ->type('text', $news->text)
                ->check('is_private')
                ->press('Добавить')
                ->assertPathIs('/news/'.((new CategoriesQueryBuilder())->getCategories()->first()->slug)
                    .'/'
                    .((new News)::query()->get()->last()->id ));


        });
    }
}
