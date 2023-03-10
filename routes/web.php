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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/flashcards', function(){
  return redirect('/flashcards/play');
});

Route::controller(ControllerFlashcards::class)->group(function () {
  Route::get('/flashcards/play', 'play')->middleware(['auth', 'verified'])->name('flashcardsPlay');
  Route::get('/flashcards/decks', 'edit')->middleware(['auth', 'verified'])->name('flashcardsEdit');
  Route::get('/flashcards/stacks', 'stacks')->middleware(['auth', 'verified'])->name('flashcardsStacks');
  Route::get('/flashcards/stats', 'stats')->middleware(['auth', 'verified'])->name('flashcardsStats');

  Route::post('/flashcards/play/RightAnswer', 'RightAnswer')->middleware(['auth', 'verified'])->name('flashcardsRightAnswer');
  Route::post('/flashcards/play/WrongAnswer', 'WrongAnswer')->middleware(['auth', 'verified'])->name('flashcardsWrongAnswer');
  Route::post('/flashcards/play/NewCard', 'NewCard')->middleware(['auth', 'verified'])->name('flashcardsNewCard');
  Route::post('/flashcards/play/ResetCount', 'ResetCount')->middleware(['auth', 'verified'])->name('flashcardsResetCount');

  Route::post('/flashcards/decks/GetCards', 'GetCards')->middleware(['auth', 'verified'])->name('flashcardsGetCards');
  Route::post('/flashcards/decks/SaveCardChanges', 'SaveCardChanges')->middleware(['auth', 'verified'])->name('flashcardsSaveCardChanges');
  Route::post('/flashcards/decks/DeleteCard', 'DeleteCard')->middleware(['auth', 'verified'])->name('flashcardsDeleteCard');
  Route::post('/flashcards/decks/UpdateCategoryName', 'UpdateCategoryName')->middleware(['auth', 'verified'])->name('flashcardsUpdateCategoryName');
  Route::post('/flashcards/decks/AddNewCard', 'AddNewCard')->middleware(['auth', 'verified'])->name('flashcardsAddNewCard');
  Route::post('/flashcards/decks/StackCol', 'StackCol')->middleware(['auth', 'verified'])->name('flashcardsStackCol');

  Route::post('/flashcards/stacks/AddNewStack', 'AddNewStack')->middleware(['auth', 'verified'])->name('flashcardsAddNewStack');
  Route::post('/flashcards/stacks/UpdateStackName', 'UpdateStackName')->middleware(['auth', 'verified'])->name('flashcardsUpdateStackName');
  Route::post('/flashcards/stacks/DeleteStack', 'DeleteStack')->middleware(['auth', 'verified'])->name('flashcardsDeleteStack');
  Route::post('/flashcards/stacks/EditExistingStack', 'EditExistingStack')->middleware(['auth', 'verified'])->name('flashcardsEditExistingStack');
});

require __DIR__.'/auth.php';
