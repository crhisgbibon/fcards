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
    Schema::create('logs', function (Blueprint $table) {
      $table->id()->unique();
      $table->integer('userID');
      $table->integer('cardID');
      $table->integer('logTime');
      $table->boolean('result');
      $table->boolean('hiddenRow');
      $table->integer('deckID');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('logs');
  }
};
