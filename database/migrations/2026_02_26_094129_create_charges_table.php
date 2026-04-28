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
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("admin_id")->nullable()->constrained("admins");
            $table->double("amount");
            $table->string("transcation_number"); //bank app transfer transcation number
            $table->enum("charge_status", ["denied", "success", "waiting", "received"]);
            $table->foreignId("denied_reason_id")->nullable()->constrained("denied_reasons");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charges');
    }
};
