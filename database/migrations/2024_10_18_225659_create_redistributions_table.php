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
        Schema::create('redistributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('beneficiaire_id')->constrained()->onDelete('cascade'); // Beneficiaire relationship
            $table->string('nom');
            $table->foreignId('collection_id')->constrained()->onDelete('cascade');
            $table->date('date');    // Redistribution date
            $table->string('status'); // Redistribution status (loading, completed, canceled)
            $table->timestamps();     // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redistributions');
    }
};
