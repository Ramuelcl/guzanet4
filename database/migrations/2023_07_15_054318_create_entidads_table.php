<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'entidades';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->string('razonSocial', 128)->nullable()->default(null)->charset('utf8mb4');
            $table->string('nombres', 80)->charset('utf8mb4')->nullable()->default(null);
            $table->string('apellidos', 80)->charset('utf8mb4')->nullable()->default(null);
            $table->boolean('is_active')->nullable()->default(true);
            $table->unsignedBigInteger('email_id');
            $table->string('tipo')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
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
