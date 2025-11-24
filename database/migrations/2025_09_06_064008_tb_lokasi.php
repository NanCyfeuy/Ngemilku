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
    Schema::create('lokasi', function (Blueprint $table) {
    $table->id('id_tempat');
    $table->string('nama', 100);
    $table->string('alamat', 100);
    $table->text('deskripsi')->nullable();
    $table->decimal('longitude', 10, 7);
    $table->decimal('latitude', 10, 7);
    $table->string('hotlink', 255)->nullable();
    $table->string('gambar', 255)->nullable();
    $table->string('jam_operasional', 100)->nullable();
    $table->timestamps();
});

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
