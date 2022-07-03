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
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->dateTimeTz('utcDate');
            $table->string('status');
            $table->json('area');
            $table->json('competition');
            $table->json('season');
            $table->json('homeTeam');
            $table->json('awayTeam');
            $table->json('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
