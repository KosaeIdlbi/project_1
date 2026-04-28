<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Catigory;
use App\Models\Product;
use App\Models\Specification;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{


    private function getTagForCategory($categoryName)
    {
        switch ($categoryName) {
            case "إلكترونيات":
                return Tag::whereIn("name", ["لابتوب", "شاشة", "تلفزيون", "هاتف ذكي", "جهاز لوحي", "سماعة"])->inRandomOrder()->first();
            case "أدوات كهربائية":
                return Tag::whereIn("name", ["خلاط", "مفرمة", "غلاية", "محمصة", "مكنسة", "مكواة", "مروحة"])->inRandomOrder()->first();
            case "ألبان وأجبان":
                return Tag::whereIn("name", ["حليب", "لبنة", "جبنة", "زبادي", "قشطة"])->inRandomOrder()->first();
            case "غذائيات ومعلبات":
                return Tag::whereIn("name", ["معلبات", "زيتون", "مكدوس", "مخلل", "عدس", "أرز"])->inRandomOrder()->first();
            case "وجبات سريعة":
                return Tag::whereIn("name", ["بيتزا", "برغر", "شاورما", "فلافل", "شيبس"])->inRandomOrder()->first();
            case "تجهيزات المطبخ":
                return Tag::whereIn("name", ["طنجرة", "مقلاة", "صحن", "كأس", "ملاعق"])->inRandomOrder()->first();
            case "أثاث ومفروشات":
                return Tag::whereIn("name", ["كرسي", "طاولة", "خزانة", "سرير", "كنبة"])->inRandomOrder()->first();
            case "منظفات":
                return Tag::whereIn("name", ["صابون", "سائل جلي", "منظف زجاج", "معقم", "مسحوق غسيل"])->inRandomOrder()->first();
            case "عناية شخصية":
                return Tag::whereIn("name", ["شامبو", "صابون", "معجون أسنان", "كريم"])->inRandomOrder()->first();
            case "مشروبات":
                return Tag::whereIn("name", ["مشروب غازي", "عصير", "قهوة", "شاي", "ماء"])->inRandomOrder()->first();
            default:
                return Tag::inRandomOrder()->first();
        }
    }
    /**
     * اختيار ماركة مناسبة حسب القسم
     */
    private function getBrandForCategory($categoryName)
    {
        switch ($categoryName) {
            case "إلكترونيات":
            case "أدوات كهربائية":
                // ماركات الإلكترونيات والأجهزة
                return Brand::whereIn("name", [
                    "سامسونج",
                    "إل جي",
                    "توشيبا",
                    "فيليبس",
                    "باناسونيك",
                    "دايو"
                ])->inRandomOrder()->first();

            case "ألبان وأجبان":
            case "غذائيات ومعلبات":
                // ماركات المواد الغذائية
                return Brand::whereIn("name", [
                    "المراعي",
                    "ندى",
                    "الربيع",
                    "نستله",
                    "سيريلاك",
                    "فيرو"
                ])->inRandomOrder()->first();

            case "مشروبات":
                // ماركات المشروبات
                return Brand::whereIn("name", [
                    "كوكاكولا",
                    "بيبسي",
                    "ميرندا",
                    "شويبس",
                    "نستله"
                ])->inRandomOrder()->first();

            case "منظفات":
                // ماركات المنظفات
                return Brand::whereIn("name", [
                    "برسيل",
                    "تايد",
                    "اريال",
                    "فيري",
                    "جيف",
                    "سافو"
                ])->inRandomOrder()->first();

            case "عناية شخصية":
                // ماركات العناية الشخصية
                return Brand::whereIn("name", [
                    "دوف",
                    "لوكس",
                    "نيفيا",
                    "بانثينول",
                    "صانسيلك",
                    "هيد آند شولدرز"
                ])->inRandomOrder()->first();

            case "وجبات سريعة":
                // ============ مطاعم الوجبات السريعة ============
                return Brand::whereIn("name", [
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
                ])->inRandomOrder()->first();
            default:
                // أي ماركة عشوائية
                return Brand::inRandomOrder()->first();
        }
    }
    private function addSpecifications($product, $tagName)
    {
        $faker = Faker::create();
        $specs = [];

        // مواصفات عامة
        $specs[] = ["name" => "بلد المنشأ", "desc" => collect(["سوريا", "مصر", "تركيا", "الصين", "ألمانيا", "إيطاليا"])->random()];

        // مواصفات خاصة حسب نوع المنتج
        switch ($tagName) {
            case "لابتوب":
                $specs[] = ["name" => "المعالج", "desc" => collect(["Intel i3", "Intel i5", "Intel i7", "AMD Ryzen 5", "AMD Ryzen 7"])->random()];
                $specs[] = ["name" => "الرام", "desc" => rand(4, 32) . " جيجابايت"];
                $specs[] = ["name" => "التخزين", "desc" => rand(256, 1024) . " جيجابايت SSD"];
                break;

            case "هاتف ذكي":
                $specs[] = ["name" => "المعالج", "desc" => collect(["Snapdragon", "MediaTek", "Apple A15", "Exynos"])->random()];
                $specs[] = ["name" => "الرام", "desc" => rand(4, 12) . " جيجابايت"];
                $specs[] = ["name" => "الكاميرا", "desc" => rand(12, 108) . " ميجابكسل"];
                break;

            case "خلاط":
            case "مفرمة":
            case "عصارة":
                $specs[] = ["name" => "السعة", "desc" => rand(1, 2) . " لتر"];
                $specs[] = ["name" => "القوة", "desc" => rand(300, 1000) . " واط"];
                break;

            case "جبنة":
                $specs[] = ["name" => "النوع", "desc" => collect(["حلوم", "شلل", "عكاوي", "موزاريلا"])->random()];
                $specs[] = ["name" => "الوزن", "desc" => rand(250, 1000) . " غرام"];
                break;

            case "حليب":
                $specs[] = ["name" => "النوع", "desc" => collect(["بقري", "ماعز", "مجفف"])->random()];
                $specs[] = ["name" => "السعة", "desc" => rand(1, 2) . " لتر"];
                break;

            case "بيتزا":
                $specs[] = ["name" => "الحجم", "desc" => collect(["صغيرة", "متوسطة", "عائلية"])->random()];
                $specs[] = ["name" => "النوع", "desc" => collect(["مارغريتا", "بيبروني", "خضار"])->random()];
                break;

            default:
                $specNames = ["اللون", "المقاس", "الوزن", "النوع"];
                $specCount = rand(2, 3);
                for ($s = 0; $s < $specCount; $s++) {
                    $specs[] = [
                        "name" => $specNames[array_rand($specNames)],
                        "desc" => $faker->word() . " " . rand(1, 100)
                    ];
                }
                break;
        }

        // إضافة المواصفات
        foreach ($specs as $specData) {
            Specification::create([
                "name" => $specData["name"],
                "desc" => $specData["desc"],
                "product_id" => $product->id,
            ]);
        }
    }
    public function run(): void
    {
        $faker = Faker::create();
        // في حلقة إنشاء المنتجات
        for ($i = 1; $i <= 500; $i++) {
            $category = Catigory::inRandomOrder()->first();
            $brand = $this->getBrandForCategory($category->name);
            $tag = $this->getTagForCategory($category->name);

            $product = Product::create([
                "name" => $tag->name . " " . $faker->numberBetween(1, 1000),
                "desc" => $faker->paragraph(2),
                "price" => $faker->numberBetween(500, 50000),
                "offer_price" => $faker->boolean(30) ? $faker->numberBetween(300, 40000) : null,
                "catigory_id" => $category->id,
                "tag_id" => $tag->id,
                "brand_id" => $brand->id,  // الآن الماركة مناسبة للقسم
                "quantity" => $faker->numberBetween(20, 200),
                "able_to_buy_quantity" => $faker->numberBetween(1, 20),
            ]);

            $this->addSpecifications($product, $tag->name);
        }
    }
}
