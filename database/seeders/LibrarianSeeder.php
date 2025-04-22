<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class LibrarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $librarian = User::create([
           'name' => 'Librarian',
           'email' => 'librarian@example.com', 
           'password' => \bcrypt('librariansRock123!'),
        ]);

        $librarian->assignRole('librarian');
    }
}
