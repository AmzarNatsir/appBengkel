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
        Schema::create('tb_com_type', function (Blueprint $table) {
            $table->id();
            $table->string('oid_type', 6);
            $table->string('type_name', 50);
            $table->string('oid_brand', 6);
            $table->string('oid_model', 6);
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
        Schema::dropIfExists('tb_com_type');
    }
};
