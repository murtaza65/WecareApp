<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create the admin user
        User::factory()->user1()->create();

        // Create the doctor user
        User::factory()->user2()->create();

        // Create the patient user
        // User::factory(10)->users()->create();
    }
}
