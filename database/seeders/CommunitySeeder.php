<?php
namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Assuming the User model exists
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $model = Community::class;

    public function run(): void
    {
        //
        Community::factory(1)->create();
    }
}
