<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    private function getData()
    {
        $faker = Factory::create('ru_RU');
        $data = [];
        for ($cat = 0; $cat < 5; $cat++) {
            $title = $faker->text(20);
            $data[] = [
                'title' => $title,
                'slug' => Str::slug($title, '_')
            ];
        }
        return $data;
    }

}
