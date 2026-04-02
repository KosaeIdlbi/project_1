<?php

namespace Database\Seeders;

use App\Models\Catigory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatigoriySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ============ 1. الأقسام (Categories) كمصفوفة ============
        $categories = [
            "أدوات كهربائية",
            "إلكترونيات",
            "غذائيات ومعلبات",
            "ألبان وأجبان",
            "وجبات سريعة",
            "منظفات",
            "عناية شخصية",
            "مشروبات",
        ];

        foreach ($categories as $categoryData) {
            Catigory::create(["name" => $categoryData]);
        }
    }
}
