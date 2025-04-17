<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                "title" => fake()->sentence(),
                "author" => fake()->name(),
                "description" => fake()->paragraph(),
                "publisher" => fake()->name(),
                "publication_date" => fake()->date(),
                "category" => fake()->word(),
                "isbn" => fake()->isbn10(),
                "page_count" => fake()->randomNumber(3),
                "created_at" => fake()->date(),
                "updated_at" => fake()->date(),
            ],
            [
                "title" => fake()->sentence(),
                "author" => fake()->name(),
                "description" => fake()->paragraph(),
                "publisher" => fake()->name(),
                "publication_date" => fake()->date(),
                "category" => fake()->word(),
                "isbn" => fake()->isbn10(),
                "page_count" => fake()->randomNumber(3),
                "created_at" => fake()->date(),
                "updated_at" => fake()->date(),
            ],
            [
                "title" => fake()->sentence(),
                "author" => fake()->name(),
                "description" => fake()->paragraph(),
                "publisher" => fake()->name(),
                "publication_date" => fake()->date(),
                "category" => fake()->word(),
                "isbn" => fake()->isbn10(),
                "page_count" => fake()->randomNumber(3),
                "created_at" => fake()->date(),
                "updated_at" => fake()->date(),
            ],
            [
                "title" => fake()->sentence(),
                "author" => fake()->name(),
                "description" => fake()->paragraph(),
                "publisher" => fake()->name(),
                "publication_date" => fake()->date(),
                "category" => fake()->word(),
                "isbn" => fake()->isbn10(),
                "page_count" => fake()->randomNumber(3),
                "created_at" => fake()->date(),
                "updated_at" => fake()->date(),
            ]
        ];

        DB::table("books")->insert($books);
    }
}
