<?php

use App\Models\ShamCashAccount;
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
        Schema::create('sham_cash_account', function (Blueprint $table) {
            $table->id();
            $table->string("account_number");
            $table->double("minimum_charge");
            $table->double("maximum_charge");
            $table->timestamps();
        });
        ShamCashAccount::create([
            "account_number" => "xxxx xxxx xxxx xxxx",
            "minimum_charge" => 0,
            "maximum_charge" => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sham_cash_account');
    }
};
