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
        Schema::create('tb_com_color', function (Blueprint $table) {
            $table->id();
            $table->string('oid_color', 6);
            $table->string('color_idn', 30);
            $table->string('color_eng', 30);
            $table->string('crud', 1);
            $table->integer('user_at');
            $table->integer('user_up')->nullable();
            $table->integer('user_del')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_com_color');
    }
};