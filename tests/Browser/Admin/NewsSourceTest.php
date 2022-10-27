<?php

namespace Tests\Browser\Admin;

use App\Models\NewsSources;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NewsSourceTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testNewsSources()
    {
        $newssources = NewsSources::factory()->create();
        $this->browse(function (Browser $browser) use ($newssources) {
            $browser->visit('/admin/news_single/id')
                ->type('title', $newssources->name)
                ->type('url', $newssources->url)
                ->type('description', $newssources->description)
                ->assertPathIs('/admin/news_sources_show');
        });
    }
}
