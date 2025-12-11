<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('thresholds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kolam_id')->constrained('kolams')->onDelete('cascade');
            $table->float('ph_bawah')->nullable();
            $table->float('ph_atas')->nullable();
            $table->float('ketinggian_batas_bawah')->nullable();
            $table->float('ketinggian_batas_atas')->nullable();
            $table->float('suhu_bawah')->nullable();
            $table->float('suhu_atas')->nullable();
            $table->float('salinitas_bawah')->nullable();
            $table->float('salinitas_atas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thresholds');
    }
};
