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
        Schema::create('tb_ms_parts', function (Blueprint $table) {
            $table->id();
            $table->string('oid_part', 6);
            $table->string('part_name', 200);
            $table->integer('id_satuan')->references('id')->on('tb_com_satuan')->onDelete('cascade');
            $table->integer('id_jenis')->references('id')->on('tb_com_jenis')->onDelete('cascade');
            $table->integer('id_brand')->references('id')->on('tb_com_brand')->onDelete('cascade');
            $table->integer('stok_awal')->nullable();
            $table->integer('stok_akhir')->nullable();
            $table->double('harga_beli')->nullable();
            $table->double('harga_jual')->nullable();
            $table->string('crud', 1);
            $table->integer('user_at');
            $table->integer('user_up')->nullable();
            $table->integer('user_del')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ms_parts');
    }
};
