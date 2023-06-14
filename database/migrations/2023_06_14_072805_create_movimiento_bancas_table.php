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
        Schema::disableForeignKeyConstraints();

        Schema::create('movimiento_bancas', function (Blueprint $table) {
            $table->id();
            $table->string('cuenta', 12)->nullable()->default('5578733W020');
            $table->string('tipo', 3)->nullable()->default('CCP');
            $table->date('dateMouvement')->nullable();
            $table->text('libelle');
            $table->decimal('montant', 8, 2);
            $table->bigInteger('cliente_id')->nullable()->default(null);
            $table->bigInteger('releve')->nullable()->default(null);
            $table->date('dateReleve')->nullable();
            $table->boolean('estado')->nullable()->default(0);
            $table->boolean('conciliada')->nullable()->default(false);
            $table->timestamp('created_at')->nullable()->useCurrent('true');
            $table->timestamp('updated_at')->nullable();
            $table->index(['cuenta', 'dateMouvement']);
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento_bancas');
    }
};
