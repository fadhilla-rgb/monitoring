<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kolam_id')->constrained('kolams')->onDelete('cascade');
            $table->float('ph')->nullable();
            $table->float('ketinggian_air')->nullable();
            $table->float('suhu_air')->nullable();
            $table->float('salinitas')->nullable();
            $table->timestamp('waktu_monitoring')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
