<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ControllerFlashcards;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/play');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(ControllerFlashcards::class)->group(function () {
  Route::get('/play', 'play')->middleware(['auth', 'verified'])->name('Play');
  Route::get('/decks', 'decks')->middleware(['auth', 'verified'])->name('Decks');
  Route::get('/stacks', 'stacks')->middleware(['auth', 'verified'])->name('Stacks');
  Route::get('/stats', 'stats')->middleware(['auth', 'verified'])->name('Stats');

  Route::post('/play/RightAnswer', 'RightAnswer')->middleware(['auth', 'verified'])->name('RightAnswer');
  Route::post('/play/WrongAnswer', 'WrongAnswer')->middleware(['auth', 'verified'])->name('WrongAnswer');
  Route::post('/play/NewCard', 'NewCard')->middleware(['auth', 'verified'])->name('NewCard');
  Route::post('/play/ResetCount', 'ResetCount')->middleware(['auth', 'verified'])->name('ResetCount');

  Route::post('/decks/GetCards', 'GetCards')->middleware(['auth', 'verified'])->name('GetCards');
  Route::post('/decks/SaveCardChanges', 'SaveCardChanges')->middleware(['auth', 'verified'])->name('SaveCardChanges');
  Route::post('/decks/DeleteCard', 'DeleteCard')->middleware(['auth', 'verified'])->name('DeleteCard');
  Route::post('/decks/UpdateCategoryName', 'UpdateCategoryName')->middleware(['auth', 'verified'])->name('UpdateCategoryName');
  Route::post('/decks/AddNewCard', 'AddNewCard')->middleware(['auth', 'verified'])->name('AddNewCard');
  Route::post('/decks/StackCol', 'StackCol')->middleware(['auth', 'verified'])->name('StackCol');

  Route::post('/stacks/AddNewStack', 'AddNewStack')->middleware(['auth', 'verified'])->name('AddNewStack');
  Route::post('/stacks/UpdateStackName', 'UpdateStackName')->middleware(['auth', 'verified'])->name('UpdateStackName');
  Route::post('/stacks/DeleteStack', 'DeleteStack')->middleware(['auth', 'verified'])->name('DeleteStack');
  Route::post('/stacks/EditExistingStack', 'EditExistingStack')->middleware(['auth', 'verified'])->name('EditExistingStack');
});

require __DIR__.'/auth.php';
