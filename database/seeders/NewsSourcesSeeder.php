<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSourcesSeeder extends Seeder
{
    public function run()
    {
        DB::table('news_sources')->insert($this->getData());
    }

    private function getData()
    {
        $faker = Factory::create('ru_RU');
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => $faker->text(20),
                'url' => $faker->url(),
                'description' => $faker->text(rand(50,200))
            ];
        }
        return $data;
    }
}
