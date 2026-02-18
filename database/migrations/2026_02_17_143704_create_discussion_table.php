<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discussion', function (Blueprint $table) {
            $table->id();
            $table->uuid('course_id');
            $table->uuid('user_id');
            $table->text('content');
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('course')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discussion');
    }
};
