<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nourriture_id')->constrained()->onDelete('cascade'); // Clé étrangère vers Nourriture
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clé étrangère vers Nourriture
            $table->integer('quantité');
            $table->date('dateExpiration');
            $table->string('status'); // 'disponible', 'fini'
            $table->date('dateCollectePrevue')->nullable(); // Date de collecte facultative
            $table->unsignedBigInteger('collection_id')->nullable(); // Allow null initially
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dons');
    }
};
