<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saved_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type', 20); // electricity, gas, internet
            $table->string('provider_key', 50); // iesco, sngpl, etc.
            $table->string('provider_name', 100);
            $table->string('reference_number', 64);
            $table->string('nickname', 100)->nullable();
            $table->timestamp('last_checked_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'provider_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_bills');
    }
};


