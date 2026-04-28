<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("admin_id")->constrained("admins")->default(null); //المدير المسؤول عن الطلب
            $table->json("coupon")->nullable();
            $table->json("product_name");
            $table->json("single_price");
            $table->json("quantity");
            $table->json("total_price");
            $table->double("sub_total");
            $table->double("order_price");
            $table->text("address");
            $table->string("phone");
            $table->text("notes")->nullable();
            $table->enum("order_status", ["delivered", "delivery_in_progress", "waiting", "cancelled", "received"])->default("waiting"); //تم التوصيل ام لا
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
