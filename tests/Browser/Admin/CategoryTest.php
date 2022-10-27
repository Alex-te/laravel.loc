<?php

namespace Tests\Browser\Admin;

use App\Models\Categories;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateForm()
    {
        $category = Categories::factory()->create();
        $this->browse(function (Browser $browser) use ($category) {
            $browser->visit('/admin/category_single/id')
                ->type('title', $category->title)
                ->press('Добавить')
                ->assertPathIs('/admin/categories_show');
        });
    }
}
