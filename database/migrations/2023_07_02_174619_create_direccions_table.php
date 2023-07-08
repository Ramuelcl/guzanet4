<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'direccions';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->string('entidad_id');
            $table->string('direccion', 128)->charset('utf8mb4');
            $table->string('ciudad_id');
            $table->string('codigo_postal', 6)->nullable()->default('0')->charset('utf8mb4');
            $table->string('region', 64)->nullable()->default(null)->charset('utf8mb4');
            $table->timestamps();
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
