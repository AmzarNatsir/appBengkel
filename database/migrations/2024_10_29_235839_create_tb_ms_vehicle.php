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
        Schema::create('tb_ms_vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('oid_vehicle', 6);
            $table->string('plat_number', 50);
            $table->string('oid_brand', 6)->references('oid_brand')->on('tb_com_brand')->onDelete('cascade');
            $table->string('oid_model', 6)->references('oid_model')->on('tb_com_model');
            $table->string('oid_type', 6)->references('oid_type')->on('tb_com_type');
            $table->string('oid_jenis', 6)->references('oid_jenis')->on('tb_com_jenis');
            $table->string('oid_color', 6)->references('oid_color')->on('tb_com_color');
            $table->string('oid_customer', 6)->references('oid_customer')->on('tb_ms_customer');
            $table->string('year', 4);
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
        Schema::dropIfExists('tb_ms_vehicle');
    }
};
