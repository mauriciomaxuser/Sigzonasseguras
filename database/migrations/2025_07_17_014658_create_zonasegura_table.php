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
        Schema::create('zonasegura', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->double("radio");
            $table->decimal("latitud");
            $table->decimal("longitud");
            $table->string("tipo_seguridad");
            $table->timestamps();
        });
    }

    /**S
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zonasegura');
    }
};
