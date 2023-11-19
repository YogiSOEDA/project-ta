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
        Schema::create('detail_request_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rm_id')->constrained('request_material')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barang')->onUpdate('cascade')->onDelete('cascade');
            $table->double('jumlah',8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_request_material');
    }
};
