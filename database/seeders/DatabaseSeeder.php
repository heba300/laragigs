<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;
use Database\Factories\ListingFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'name' => 'heba hassan',
            'email' => 'test@test.com',
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);
       
    }
}
