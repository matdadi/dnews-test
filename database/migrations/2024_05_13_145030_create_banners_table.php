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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('image_id');
            $table->string('url');
            $table->unsignedBigInteger('position_id');
            $table->boolean('is_active');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('image_id')->references('id')->on('files');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('created_by')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
