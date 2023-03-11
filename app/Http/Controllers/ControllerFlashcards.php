<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\ModelFlashcards;

class ControllerFlashcards extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
  */

  public function play()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelFlashcards();
    $card = $model->GetAnyCard();
    if($card !== null)
    {
      $col = $model->GetCardCol($card);
      if($col === null) $col = json_encode(["r"=>"255","g"=>"255","b"=>"255"]);
      $card->col = $col;

      $cat = $model->GetCardCategory($card);
      $card->category = $cat;
    }
    $decks = $model->GetDecks();
    $stacks = $model->GetStacks();
    $now = time();
    $currentScore = (int)session('score');
    $currentTotal = (int)session('total');
    return view('play', [
      'now' => $now,
      'card' => $card,
      'decks' => $decks,
      'stacks' => $stacks,
      'currentscore' => $currentScore,
      'currenttotal' => $currentTotal,
    ]);
  }

  public function decks()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelFlashcards();
    $cards = $model->GetCardDataByCategory();
    $decks = $model->GetDecks();
    $now = time();
    return view('decks', [
      'now' => $now,
      'cards' => $cards,
      'decks' => $decks
    ]);
  }

  public function stacks()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelFlashcards();
    $stacks = $model->GetStacks();
    $decks = $model->GetDecks();
    $now = time();
    return view('stacks', [
      'now' => $now,
      'stacks' => $stacks,
      'decks' => $decks
    ]);
  }

  public function stats()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelFlashcards();
    $logs = $model->GetLogs();
    $summary = $model->GetSummaryFromLogs($logs);
    $cards = $model->GetCardDataByCategory();
    $decks = $model->GetDecks();
    $stacks = $model->GetStacks();
    $formattedStacks = $model->FormatStacks($stacks);
    return view('stats', [
      'logs' => $logs,
      'summary' => $summary,
      'cards' => $cards,
      'decks' => $decks,
      'stacks' => $stacks,
    ]);
  }

  public function RightAnswer(Request $request)
  {
    $cardID = (int)$request->data[0];
    $model = new ModelFlashcards();
    $cardData = $model->GetCardData($cardID);
    $model->AddLog(1, $cardData);

    $currentScore = (int)session('score');
    $currentScore++;
    session(['score' => $currentScore]);
    $currentTotal = (int)session('total');
    $currentTotal++;
    session(['total' => $currentTotal]);
    return [$currentScore, $currentTotal];
  }

  public function WrongAnswer(Request $request)
  {
    $cardID = (int)$request->data[0];
    $model = new ModelFlashcards();
    $cardData = $model->GetCardData($cardID);
    $model->AddLog(0, $cardData);

    $currentScore = (int)session('score');
    $currentTotal = (int)session('total');
    $currentTotal++;
    session(['total' => $currentTotal]);
    return [$currentScore, $currentTotal];
  }

  public function NewCard(Request $request)
  {
    $type = (string)$request->data[0];
    $sourceIndex = (int)$request->data[1];
    
    $model = new ModelFlashcards();
    if($type !== -1 && $sourceIndex !== -1)
    {
      $card = $model->GetRandomCard($type, $sourceIndex);
    }
    else
    {
      $card = $model->GetAnyCard();
    }
    if($card !== null)
    {
      $col = $model->GetCardCol($card);
      if($col === null) $col = json_encode(["r"=>"255","g"=>"255","b"=>"255"]);
      $card->col = $col;

      $cat = $model->GetCardCategory($card);
      $card->category = $cat;
    }
    return view('components.playCard', [
      'card' => $card
    ]);
  }

  public function ResetCount()
  {
    session(['score' => 0]);
    session(['total' => 0]);
  }

  public function GetCards()
  {
    $model = new ModelFlashcards();
    $cards = $model->GetCardDataByCategory();
    $decks = $model->GetDecks();
    return view('components.deckCardData', [
      'cards' => $cards,
      'decks' => $decks
    ]);
  }

  public function SaveCardChanges(Request $request)
  {
    $index = (int)$request->data[0];
    $deck = (int)$request->data[1];
    $deckName = (string)$request->data[2];
    $question = json_encode((string)$request->data[3]);
    $answer = json_encode((string)$request->data[4]);
    $link = json_encode((string)$request->data[5]);
    $model = new ModelFlashcards();
    $model->UpdateCard($index, $deck, $deckName, $question, $answer, $link);
    return $this->GetCards();
  }

  public function DeleteCard(Request $request)
  {
    $index = (int)$request->data[0];
    $model = new ModelFlashcards();
    $model->DeleteCard($index);
    return $this->GetCards();
  }

  public function UpdateCategoryName(Request $request)
  {
    $index = (int)$request->data[0];
    $newName = (string)$request->data[1];
    $model = new ModelFlashcards();
    $model->UpdateCategory($index, $newName);
    return $this->GetCards();
  }

  public function AddNewCard(Request $request)
  {
    $category = (string)$request->data[0];
    $question = json_encode((string)$request->data[1]);
    $answer = json_encode((string)$request->data[2]);
    $link = json_encode((string)$request->data[3]);
    $model = new ModelFlashcards();
    $model->AddNewCard($category, $question, $answer, $link);
    return $this->GetCards();
  }

  public function StackCol(Request $request)
  {
    $index = (int)$request->data[0];
    $rgb = (array)$request->data[1];
    if($rgb['r'] === null) $rgb['r'] = 255;
    if($rgb['g'] === null) $rgb['g'] = 255;
    if($rgb['b'] === null) $rgb['b'] = 255;
    $model = new ModelFlashcards();
    $model->SaveCol($index, $rgb);
    return $this->GetCards();
  }

  public function GetStacks()
  {
    $model = new ModelFlashcards();
    $stacks = $model->GetStacks();
    $decks = $model->GetDecks();
    return view('components.stackData', [
      'stacks' => $stacks,
      'decks' => $decks
    ]);
  }

  public function AddNewStack(Request $request)
  {
    $name = (string)$request->data[0];
    $decks = (array)$request->data[1];
    $model = new ModelFlashcards();
    $model->AddNewStack($name, $decks);
    return $this->GetStacks();
  }

  public function UpdateStackName(Request $request)
  {
    $index = (int)$request->data[0];
    $newName = (string)$request->data[1];
    $model = new ModelFlashcards();
    $model->UpdateStackName($index, $newName);
    return $this->GetStacks();
  }

  public function DeleteStack(Request $request)
  {
    $index = (int)$request->data[0];
    $model = new ModelFlashcards();
    $model->DeleteStack($index);
    return $this->GetStacks();
  }

  public function EditExistingStack(Request $request)
  {
    $index = (int)$request->data[0];
    $name = (string)$request->data[1];
    $newDeck = (array)$request->data[2];
    $model = new ModelFlashcards();
    $model->EditExistingStack($index, $name, $newDeck);
    return $this->GetStacks();
  }
}