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
        Schema::create('tb_receive_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_head');
            $table->integer('id_part');
            $table->integer('terima');
            $table->integer('order');
            $table->double('harga_satuan');
            $table->double('sub_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_receive_detail');
    }
};
