<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
//dd($this->getData());
    }

    private function getData()
    {
        $faker = Factory::create('ru_RU');
        $data = [];
        for($cat = 0; $cat < 5; $cat++) {
            for ($i = 0; $i < 10; $i++) {
                $data[] = [
                    'title' => $faker->sentence(rand(3, 10)),
                    'text' => $faker->text(rand(100, 300)),
                    'category_id' => $cat,
                    'news_source_id' => rand(1,10),
                    'is_private' => rand(0, 1)
                ];
            }
        }
       return $data;
    }
}
