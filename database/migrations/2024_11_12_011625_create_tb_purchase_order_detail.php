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
        Schema::create('tb_purchase_order_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_head');
            $table->integer('id_part');
            $table->integer('qty');
            $table->double('harga_satuan');
            $table->double('sub_total');
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_purchase_order_detail');
    }
};
