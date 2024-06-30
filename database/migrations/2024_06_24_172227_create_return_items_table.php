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
        Schema::create('return_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('date');
            $table->string('place');
            $table->string('image');
            $table->string('description');
            $table->string('category');
            $table->json('return_to');
            $table->json('return_by');
            $table->unsignedBigInteger('claim_id')->nullable();
            $table->unsignedBigInteger('report_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_items');
    }
};
