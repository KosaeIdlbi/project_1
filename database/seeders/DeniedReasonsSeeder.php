<?php

namespace Database\Seeders;

use App\Models\DeniedReason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeniedReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeniedReason::create(
            ["name" => "الايصال غير واضح", "desc" => "الايصال غير واضح"]
        );
        DeniedReason::create(
            ["name" => "رقم التحويل البنكي غير صحيح", "desc" => "رقم التحويل البنكي غير صحيح"]
        );
        DeniedReason::create(
            ["name" => "المحفظة تجاوزت الحد المسموح به", "desc" => "المحفظة تجاوزت الحد المسموح به"]
        );
    }
}
