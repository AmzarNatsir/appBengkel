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
        Schema::create('tb_purchase_order', function (Blueprint $table) {
            $table->id();
            $table->string('po_number', 30);
            $table->date('po_date');
            $table->date('po_delivery_order')->nullable();
            $table->integer('id_supplier');
            $table->string('po_remark', 200)->nullable();
            $table->double('po_total')->nullable();
            $table->string('status', 20)->nullable();
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
        Schema::dropIfExists('tb_purchase_order');
    }
};
