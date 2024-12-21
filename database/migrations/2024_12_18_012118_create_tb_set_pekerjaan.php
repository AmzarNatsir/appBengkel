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
        Schema::create('tb_set_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("kategori_id");
            $table->foreign('kategori_id')->references('id')->on('tb_set_kategori_pekerjaan');
            $table->string('nama_pekerjaan', 200);
            $table->double('biaya')->default(0);
            $table->tinyInteger('aktif')->default('1'); //aktif
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
        Schema::dropIfExists('tb_set_pekerjaan');
    }
};
