<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poligon', function (Blueprint $table) {
            $table->id('id_poligon');
            $table->string('nama_area');
            $table->text('deskripsi')->nullable();
            $table->longText('koordinat'); // Simpan GeoJSON atau WKT
            $table->string('warna', 20)->default('#ff0000'); // warna default merah
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poligon');
    }
};
