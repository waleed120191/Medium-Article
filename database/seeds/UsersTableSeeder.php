<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
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
            $words[] = $faker->unique()->userName;
            $k++;
        }


        $insert = [];
        foreach ($words as $w){
            $insert[] = [
                'name' => $w,
                'email' => $w.'@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date("Y-m-d H:i:s")
            ];
        }

        DB::table('users')->insert($insert);
    }
}
