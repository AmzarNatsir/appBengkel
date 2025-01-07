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
        Schema::create('tb_service', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_service');
            $table->string('no_service', 50);
            $table->unsignedBigInteger("unit_id");
            $table->foreign('unit_id')->references('id')->on('tb_ms_vehicle');
            $table->text('deskripsi');
            $table->string('cara_bayar', 20);
            $table->double('total_pekerjaan');
            $table->double('total_parts');
            $table->double('total_pekerjaa_parts');
            $table->double('diskon')->nullable();
            $table->integer('ppn_persen')->nullable();
            $table->double('ppn_rupiah')->nullable();
            $table->double('total_net');
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
        Schema::dropIfExists('tb_service');
    }
};
