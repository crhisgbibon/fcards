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
    Schema::create('stacks', function (Blueprint $table) {
      $table->id()->unique();
      $table->integer('userID');
      $table->string('decks', 1000);
      $table->string('name', 250);
      $table->boolean('hiddenRow');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('stacks');
  }
};
