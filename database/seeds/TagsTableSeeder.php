<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $words = [];
        $k = 1;
        while($k < 15){
            $words[] = $faker->unique()->word;
            $k++;
        }

        $insert = [];
        foreach ($words as $w){
            $insert[] = [
                'name' => $w
            ];
        }

        DB::table('tags')->insert($insert);

        $tags = DB::table('tags')->get();
        $tag_count = count($tags);
        $articles = DB::table('articles')->get();

        foreach ($articles as $article){

            for($i = 1;$i<= rand(0,$tag_count - 1);$i++){
                DB::table('article_tag')->insert([
                    'article_id' => $article->id,
                    'tag_id' => $i,
                ]);
            }

        }

    }
}
