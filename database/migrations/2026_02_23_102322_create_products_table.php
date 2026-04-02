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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("desc")->nullable();
            $table->double("price");
            $table->unsignedInteger("quantity")->default(0);
            $table->unsignedInteger("able_to_buy_quantity")->default(0);
            $table->boolean("available")->default(1);
            $table->boolean("special")->default(0);
            $table->boolean("has_offer")->default(0);
            $table->boolean("is_newest")->default(0);
            $table->timestamp("offer_ends_at")->nullable();
            $table->double("offer_price")->nullable();
            $table->foreignId("catigory_id")->constrained("catigories")->cascadeOnDelete();
            $table->foreignId("brand_id")->constrained("brands")->cascadeOnDelete();
            $table->foreignId("tag_id")->constrained("tags")->cascadeOnDelete();
            $table->unsignedBigInteger("sells")->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
