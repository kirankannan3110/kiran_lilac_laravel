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
        Schema::create('forgot_token', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_code_id')->nullable()->references('id')->on('country_codes');
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forgot_token');
    }
};
