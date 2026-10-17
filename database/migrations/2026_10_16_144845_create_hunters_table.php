<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hunters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rank');
            $table->string('class');
            $table->integer('level');
            $table->integer('power');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hunters');
    }
};