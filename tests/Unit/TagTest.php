<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Tag;

class TagTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function validTagNamePass()
    {
        $faker = \Faker\Factory::create();
        $data = [
            'name' => $faker->word
        ];

        try {
            Tag::create($data);
        } catch (QueryException $e) {
            throw new \InvalidArgumentException($e);
        }

        $this->assertDatabaseHas('tags',$data);

    }

    /** @test */
    public function invalidTagNameException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $faker = \Faker\Factory::create();

        try {
            Tag::create([
                'name' => $faker->sentence(100)
            ]);
        } catch (QueryException $e) {
            throw new \InvalidArgumentException($e);
        }

    }

    /** @test */
    public function sameTagNameException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $faker = \Faker\Factory::create();

        try {
            $w = $faker->word;
            Tag::create([
                'name' => $w
            ]);

            Tag::create([
                'name' => $w
            ]);

        } catch (QueryException $e) {
            throw new \InvalidArgumentException($e);
        }

    }
}
