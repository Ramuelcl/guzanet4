<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'paises';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 64)->nullable()->default(null)->charset('utf8mb4');
            $table->string('bandera', 128)->nullable()->default(null)->charset('utf8mb4');
            $table->string('idioma', 64)->nullable()->default(null)->charset('utf8mb4');
            $table->string('idioma_web', 5)->nullable()->default(null)->charset('utf8mb4');
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
