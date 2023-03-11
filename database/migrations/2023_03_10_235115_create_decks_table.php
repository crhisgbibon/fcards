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
    Schema::create('decks', function (Blueprint $table) {
      $table->id()->unique();
      $table->integer('userID');
      $table->string('name', 255);
      $table->string('col', 255);
      $table->boolean('hiddenRow');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('decks');
  }
};
