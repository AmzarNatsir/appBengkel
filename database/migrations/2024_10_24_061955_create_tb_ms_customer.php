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
        Schema::create('tb_ms_customer', function (Blueprint $table) {
            $table->id();
            $table->string('oid_customer', 6);
            $table->string('customer_name', 100);
            $table->string('customer_address', 100);
            $table->string('customer_email', 100);
            $table->string('customer_phone', 100);
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
        Schema::dropIfExists('tb_ms_customer');
    }
};
