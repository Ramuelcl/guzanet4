<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'user_settings';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('theme', 20)->default('dark')->charset('utf8');
            $table->string('language', 5)->default('fr-FR')->charset('utf8');
            $table->boolean('autologin')->default(true);
            $table->string('ipVisitor', 45)->nullable()->default(null)->charset('utf8');
            $table->json('options')->nullable()->default(null);
            $table->string('device', 17)->nullable()->default(null)->charset('utf8');
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
