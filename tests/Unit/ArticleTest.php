<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Article;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function titleMaxLengthPass()
    {
        $faker = \Faker\Factory::create();
        $data = [
            'user_id' => 1,
            'title' => $faker->sentence(1),
            'body' => $faker->sentence(1),
        ];

        try {
            Article::create($data);
        } catch (QueryException $e) {
            throw new \InvalidArgumentException($e);
        }

        $this->assertDatabaseHas('articles',$data);

    }

    /** @test */
    public function titleMaxLengthException()
    {

        $this->expectException(\InvalidArgumentException::class);
        $faker = \Faker\Factory::create();

        try {
            Article::create([
                'user_id' => 1,
                'title' => $faker->sentence(1000),
                'body' => $faker->sentence(1),
            ]);
        } catch (QueryException $e) {
            throw new \InvalidArgumentException($e);
        }


    }

    /** @test */
    public function articleMissingUserIdException()
    {

        $this->expectException(\InvalidArgumentException::class);
        $faker = \Faker\Factory::create();

        try {
            Article::create([
//                'user_id' => 1,
                'title' => $faker->sentence(1000),
                'body' => $faker->sentence(1),
            ]);
        } catch (QueryException $e) {
            throw new \InvalidArgumentException($e);
        }


    }

    /** @test */
    public function articleMissingBodyException()
    {

        $this->expectException(\InvalidArgumentException::class);
        $faker = \Faker\Factory::create();

        try {
            Article::create([
                'user_id' => 1,
                'title' => $faker->sentence(1000),
//                'body' => $faker->sentence(1),
            ]);
        } catch (QueryException $e) {
            throw new \InvalidArgumentException($e);
        }


    }
}
