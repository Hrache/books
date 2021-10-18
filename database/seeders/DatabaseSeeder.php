<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BookAuthor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\User::factory(10)->create();
        \App\Models\Book::factory(30)->create();
        \App\Models\Author::factory(30)->create();

        for ($i = 1; $i < 31; $i++)
        {
            (new BookAuthor())->fill(
            [
                'books_id' => $i,
                'authors_id' => $i
            ])->save();
        }
    }
}
