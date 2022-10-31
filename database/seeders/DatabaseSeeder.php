<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->count(100)->create();
        // Admin::factory()->count(10)->create();
        Article::factory()->count(100)->create();
    }
}
