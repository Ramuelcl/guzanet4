<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'tablas';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigInteger('tabla');
            $table->bigInteger('tabla_id');
            $table->string('nombre', 45)->charset('utf8mb4');
            $table->string('descripcion', 128)->nullable()->default(null)->charset('utf8mb4');
            $table->boolean('is_active')->nullable()->default(true);
            $table->string('valor1', 128)->nullable()->default(null)->charset('utf8mb4');
            $table->string('valor2', 128)->nullable()->default(null)->charset('utf8mb4');
            $table->boolean('valor3')->nullable()->default(false);
            $table->primary(['tabla', 'tabla_id']);
            $table->index('nombre');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
