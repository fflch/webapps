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
        Schema::create('webapps', function (Blueprint $table) {
            $table->id();
            $table->string('dominio');
            $table->string('url_github')->nullable();
            $table->string('justificativa');
            $table->string('tipo');
            $table->string('status')->default('Solicitado');
            $table->foreignId('user_id')->constrained();
            $table->string('database_username')->nullable();
            $table->string('database_name')->nullable();
            $table->string('database_password')->nullable();
            $table->string('bucket_username')->nullable();
            $table->string('bucket_password')->nullable();
            $table->string('bucket_name')->nullable();
            $table->string('version')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webapps');
    }
};
