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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('departament');
            $table->string('local');
            $table->unsignedBigInteger('branch_id_1')->nullable();  // Primeiro ramal
            $table->unsignedBigInteger('branch_id_2')->nullable(); // Segundo ramal
            $table->boolean('active')->default(true);
            $table->timestamps();

            // Definindo as chaves estrangeiras
            $table->foreign('branch_id_1')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('branch_id_2')->references('id')->on('branches')->onDelete('cascade'); // Relacionamento para o segundo ramal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['branch_id_1']);
            $table->dropForeign(['branch_id_2']);
        });

        Schema::dropIfExists('contacts');
    }
};

