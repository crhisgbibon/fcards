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
    Schema::create('cards', function (Blueprint $table) {
      $table->id()->unique();
      $table->integer('userID');
      $table->integer('deckID');
      $table->string('question', 1000);
      $table->string('answer', 1000);
      $table->string('link', 255);
      $table->boolean('hiddenRow');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('cards');
  }
};
