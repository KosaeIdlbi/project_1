<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandNames = [
            "سامسونج",
            "إل جي",
            "توشيبا",
            "فيليبس",
            "باناسونيك",
            "دايو",
            "نستله",
            "المراعي",
            "ندى",
            "الربيع",
            "سيريلاك",
            "فيرو",
            "كوكاكولا",
            "بيبسي",
            "ميرندا",
            "شويبس",
            "دانون",
            "فاين",
            "برسيل",
            "تايد",
            "اريال",
            "فيري",
            "جيف",
            "سافو",
            "دوف",
            "لوكس",
            "نيفيا",
            "بانثينول",
            "صانسيلك",
            "هيد آند شولدرز",
            "كنتاكي",
            "ماكدونالدز",
            "بيتزا هت",
            "برغر كينغ",
            "دومينوز بيتزا",
            "هارديز",
            "كنتاكي",
            "بيتزا مارجريتا",
            "شاورمر",
            "أبو فهد",
            "الطازج",
            "الروست",
            "شاورما شام",
            "فود ترك",
            "ديب اند فراي",
            "كنتاكي",
            "بروستد الطازج",
            "مطعم الطازج",
            "الروستو",
        ];

        foreach ($brandNames as $brandName) {
            Brand::create(["name" => $brandName]);
        }
    }
}
