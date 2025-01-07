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
        Schema::create('tb_service_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("service_id");
            $table->foreign('service_id')->references('id')->on('tb_service');
            $table->unsignedBigInteger("pekerjaan_id");
            $table->foreign('pekerjaan_id')->references('id')->on('tb_set_pekerjaan');
            $table->double('biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_service_pekerjaan');
    }
};
