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
        Schema::create('tb_receive', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_receive', 30);
            $table->date('tanggal_receive');
            $table->string('ket_receive', 200)->nullable();
            $table->integer('po_reff');
            $table->string('cara_bayar', 10); //Cash/Credit
            $table->double('uang_muka')->nullable(); //terisi jika credit
            $table->double('biaya_lain')->nullable();
            $table->double('ppn')->nullable();
            $table->double('total')->nullable();
            $table->double('total_net')->nullable();
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
        Schema::dropIfExists('tb_receive');
    }
};
