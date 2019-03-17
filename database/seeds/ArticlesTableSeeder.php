<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = DB::table('users')->get();

        $insert = [];
        foreach ($users as  $user){

            for($i = 1;$i<= rand(3,5);$i++) {
                $insert[] = [
                    'user_id' => $user->id,
                    'title' => $faker->unique()->text(20),
                    'body' => $faker->sentence(1000),
                    'created_at' => date("Y-m-d H:i:s")
                ];
            }

        }

        DB::table('articles')->insert($insert);
    }
}
