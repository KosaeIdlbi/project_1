<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([CatigoriySeeder::class]);
        $this->call([TagSeeder::class]);
        $this->call([BrandSeeder::class]);
        $this->call([ProductSeeder::class]);
        $this->call([ImgSeeder::class]);
        $this->call([ProductStatusSeeder::class]);
        $this->call([PermissionsSeeder::class]);
    }
}
