<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('polyline', function (Blueprint $table) {
            $table->id('id_polyline');
            $table->string('nama_garis');
            $table->text('deskripsi')->nullable();
            $table->longText('koordinat'); // GeoJSON atau WKT
            $table->string('warna', 20)->default('#0000ff'); // warna default biru
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('polyline');
    }
};
