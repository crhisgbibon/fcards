<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ModelFlashcards extends Model
{
  use HasFactory;

  protected $table = "cards";

  public function GetCardData(int $index)
  {
    $id = Auth::user()->id;
    return $cards = DB::table('cards')
    ->where('userID', '=', $id)
    ->where('id', '=', $index)
    ->where('hiddenRow', '=', 0)
    ->first();
  }

  public function GetCardDataByCategory()
  {
    $id = Auth::user()->id;
    return $cards = DB::table('cards')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('id', 'asc')
    ->orderBy('deckID', 'asc')
    ->get();
  }

  public function GetDecks()
  {
    $id = Auth::user()->id;
    return $categories = DB::table('decks')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('name', 'asc')
    ->distinct()
    ->get();
  }

  public function GetAnyCard()
  {
    $id = Auth::user()->id;
    return $cards = DB::table('cards')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->inRandomOrder()
    ->first();
  }

  public function GetRandomCard(string $type, int $deckID)
  {
    $id = Auth::user()->id;
    if($type === "DECK")
    {
      return $cards = DB::table('cards')
      ->where('userID', '=', $id)
      ->where('deckID', '=', $deckID)
      ->where('hiddenRow', '=', 0)
      ->inRandomOrder()
      ->first();
    }
    else if($type === "STACK")
    {
      $decks = json_decode($this->GetStackDeck($deckID));
      $whereDeck = [];
      $len = count($decks);
      for($i = 0; $i < $len; $i++)
      {
        array_push($whereDeck, (int)$decks[$i]);
      }
      return $cards = DB::table('cards')
      ->where('userID', '=', $id)
      ->where('hiddenRow', '=', 0)
      ->whereIn('deckID', $whereDeck)
      ->inRandomOrder()
      ->first();
    }
  }

  public function AddLog($result, $cardData)
  {
    $userID = Auth::id();
    $now = time();
    DB::table('logs')->insert([
      'userID' => $userID,
      'cardID' => $cardData->id,
      'deckID' => $cardData->deckID,
      'logTime' => $now,
      'result' => $result,
      'hiddenRow' => 0
    ]);
  }

  public function UpdateCard(int $index, int $deckID, string $deckName, $question, $answer, $link)
  {
    $userID = Auth::id();

    if(DB::table('decks')->where('name', "=", $deckName)->where('userID', "=", $userID)->exists())
    {
      $id = DB::table('decks')
      ->select('id')
      ->where('userID', "=", $userID)
      ->where('name', "=", $deckName)
      ->get();
      $id = $id[0]->id;
    }
    else
    {
      $id = DB::table('decks')->insertGetId([
        'userID' => $userID,
        'name' => $deckName,
        'hiddenRow' => 0
      ]);
    }

    DB::table('cards')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'deckID' => $id,
      'question' => $question,
      'answer' => $answer,
      'link' => $link,
    ]);
  }

  public function DeleteCard(int $index)
  {
    $userID = Auth::id();
    DB::table('cards')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'hiddenRow' => 1
    ]);
  }

  public function UpdateCategory(int $index, string $newName)
  {
    $userID = Auth::id();
    DB::table('decks')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'name' => $newName
    ]);
  }

  public function AddNewCard(string $name, $question, $answer, $link)
  {
    $userID = Auth::id();
    if(DB::table('decks')->where('name', "=", $name)->where('userID', "=", $userID)->exists())
    {
      $id = DB::table('decks')
      ->select('id')
      ->where('userID', "=", $userID)
      ->where('name', "=", $name)
      ->get();
      $id = $id[0]->id;
    }
    else
    {
      $col = '#ffffff';
      $id = DB::table('decks')->insertGetId([
        'userID' => $userID,
        'name' => $name,
        'col' => $col,
        'hiddenRow' => 0
      ]);
    }

    DB::table('cards')->insert([
      'userID' => $userID,
      'deckID' => $id,
      'question' => $question,
      'answer' => $answer,
      'link' => $link,
      'hiddenRow' => 0
    ]);
  }

  public function SaveCol(int $index, array $rgb)
  {
    $json = json_encode($rgb);
    $userID = Auth::id();
    DB::table('decks')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'col' => $json
    ]);
  }

  public function GetCardCol($card)
  {
    if($card === null) return;
    if($card->deckID === null) return;
    $id = Auth::user()->id;
    $deck = DB::table('decks')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->where('id', '=', $card->deckID)
    ->first();
    return $deck->col;
  }

  public function GetCardCategory($card)
  {
    if($card === null) return;
    if($card->deckID === null) return;
    $id = Auth::user()->id;
    $deck = DB::table('decks')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->where('id', '=', $card->deckID)
    ->first();
    return $deck->name;
  }

  public function GetStacks()
  {
    $id = Auth::user()->id;
    return $stacks = DB::table('stacks')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('name', 'asc')
    ->get();
  }

  public function GetStackDeck($index)
  {
    $id = Auth::user()->id;
    $stack = DB::table('stacks')
    ->where('userID', '=', $id)
    ->where('id', '=', $index)
    ->where('hiddenRow', '=', 0)
    ->orderBy('name', 'asc')
    ->first();
    return $stack->decks;
  }

  public function FormatStacks($stacks)
  {
    $len = count($stacks);
    for($i = 0; $i < $len; $i++)
    {
      $stacks[$i]->decks = json_decode($stacks[$i]->decks);
    }
    return $stacks;
  }

  public function AddNewStack(string $name, array $decks)
  {
    $id = Auth::user()->id;
    $json = json_encode($decks);
    DB::table('stacks')->insert([
      'userID' => $id,
      'name' => $name,
      'decks' => $json,
      'hiddenRow' => 0
    ]);
  }

  public function UpdateStackName(int $index, string $newName)
  {
    $userID = Auth::id();
    DB::table('stacks')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'name' => $newName
    ]);
  }

  public function DeleteStack(int $index)
  {
    $userID = Auth::id();
    DB::table('stacks')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'hiddenRow' => 1
    ]);
  }

  public function EditExistingStack(int $index, string $name, array $decks)
  {
    $userID = Auth::id();
    $json = json_encode($decks);
    DB::table('stacks')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'name' => $name,
      'decks' => $json
    ]);
  }

  public function GetLogs()
  {
    $id = Auth::user()->id;
    return $logs = DB::table('logs')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('logTime', 'desc')
    ->get();
  }

  public function GetSummaryFromLogs($logs)
  {
    $total = count($logs);
    $now = time();

    $today = strtotime("midnight");
    $week = strtotime("last Sunday midnight");
    $month = strtotime("first day of this month midnight");
    $year = strtotime("first day of January midnight");

    $rightAll = 0;
    $rightDay = 0;
    $rightWeek = 0;
    $rightMonth = 0;
    $rightYear = 0;
    
    $totalAll = 0;
    $totalDay = 0;
    $totalWeek = 0;
    $totalMonth = 0;
    $totalYear = 0;

    $days = [];

    for($i = 0; $i < $total; $i++)
    {
      // Day summaries
      $day = date("Y-m-d", $logs[$i]->logTime);
      if(array_key_exists($day, $days))
      {
        if($logs[$i]->result)
        {
          $days[$day]["right"]++;
        }
        else
        {
          $days[$day]["wrong"]++;
        }
        $days[$day]["total"]++;
      }
      else
      {
        $formattedDay = date("d/m", $logs[$i]->logTime);
        $days[$day]["date"] = $formattedDay;
        $days[$day]["logTime"] = $logs[$i]->logTime;
        $days[$day]["right"] = 0;
        $days[$day]["wrong"] = 0;
        $days[$day]["total"] = 0;
        $days[$day]["percent"] = 0;
        $days[$day]["stat"] = "";
        if($logs[$i]->result)
        {
          $days[$day]["right"]++;
        }
        else
        {
          $days[$day]["wrong"]++;
        }
        $days[$day]["total"]++;
      }

      // Total summaries
      if($logs[$i]->result)
      {
        $rightAll++;
        $totalAll++;
        if((int)$logs[$i]->logTime >= $today)
        {
          $rightDay++;
          $totalDay++;
        }
        if((int)$logs[$i]->logTime >= $week)
        {
          $rightWeek++;
          $totalWeek++;
        }
        if((int)$logs[$i]->logTime >= $month)
        {
          $rightMonth++;
          $totalMonth++;
        }
        if((int)$logs[$i]->logTime >= $year)
        {
          $rightYear++;
          $totalYear++;
        }
      }
      else
      {
        $totalAll++;
        if((int)$logs[$i]->logTime >= $today)
        {
          $totalDay++;
        }
        if((int)$logs[$i]->logTime >= $week)
        {
          $totalWeek++;
        }
        if((int)$logs[$i]->logTime >= $month)
        {
          $totalMonth++;
        }
        if((int)$logs[$i]->logTime >= $year)
        {
          $totalYear++;
        }
      }
    }

    $counter = 0;
    $days2 = [];
    $months = [];
    foreach($days as $day)
    {
      if((int)$day["total"] !== 0) $day["percent"] = (float)number_format( ( 100 / (int)$day["total"]) * (int)$day["right"], 2 );
      else $day["percent"] = 0;

      if($counter === 0) $day["stat"] = "DAY";
      else if($counter > 0 && $counter < 7) $day["stat"] = "WEEK";
      else if($counter >= 7 && $counter < 30) $day["stat"] = "MONTH";
      else if($counter >= 30 && $counter < 365) $day["stat"] = "YEAR";
      else $day["stat"] = "IGNORE";

      $day['dayStart'] = strtotime(date("Y-m-d 00:00:00", $day["logTime"]));
      $day['dayEnd'] = strtotime(date("Y-m-d 23:59:59", $day["logTime"]));

      $counter++;
      array_push($days2, $day);

      $month = date("m/y", $day["logTime"]);
      if(array_key_exists($month, $months))
      {
        $months[$month]["right"] += (int)$day["right"];
        $months[$month]["wrong"] += (int)$day["wrong"];
        $months[$month]["total"] += (int)$day["total"];
      }
      else
      {
        $months[$month]["date"] = $month;
        $months[$month]["monthStart"] = strtotime(date("Y-m-01", $day["logTime"]));
        $months[$month]["monthEnd"] = strtotime(date("Y-m-t", $day["logTime"]));
        $months[$month]["right"] = 0;
        $months[$month]["wrong"] = 0;
        $months[$month]["total"] = 0;
        $months[$month]["percent"] = 0;
        $months[$month]["stat"] = "";

        $months[$month]["right"] += (int)$day["right"];
        $months[$month]["wrong"] += (int)$day["wrong"];
        $months[$month]["total"] += (int)$day["total"];
      }
    }

    $counter = 0;
    $months2 = [];
    foreach($months as $month)
    {
      if((int)$month["total"] !== 0) $month["percent"] = (float)number_format( ( 100 / (int)$month["total"]) * (int)$month["right"], 2 );
      else $month["percent"] = 0;

      if($counter < 12) $month["stat"] = "YEAR";
      else $month["stat"] = "IGNORE";

      $counter++;
      array_push($months2, $month);
    }

    if($totalAll !== 0) $percentAll = (float)number_format( ((100 / $totalAll) * $rightAll), 2 );
    else $percentAll = 0;
    if($totalDay !== 0) $percentDay = (float)number_format( ((100 / $totalDay) * $rightDay), 2 );
    else $percentDay = 0;
    if($totalWeek !== 0) $percentWeek = (float)number_format( ((100 / $totalWeek) * $rightWeek), 2 );
    else $percentWeek = 0;
    if($totalMonth !== 0) $percentMonth = (float)number_format( ((100 / $totalMonth) * $rightMonth), 2 );
    else $percentMonth = 0;
    if($totalYear !== 0) $percentYear = (float)number_format( ((100 / $totalYear) * $rightYear), 2 );
    else $percentYear = 0;

    return [ 
      "days" => $days2,
      "months" => $months2,
      
      "rightAll" => $rightAll,
      "wrongAll" => $totalAll - $rightAll,
      "totalAll" => $totalAll,
      'percentAll' => $percentAll,

      "rightDay" => $rightDay,
      "wrongDay" => $totalDay - $rightDay,
      "totalDay" => $totalDay,
      'percentDay' => $percentDay,

      "rightWeek" => $rightWeek,
      "wrongWeek" => $totalWeek - $rightWeek,
      "totalWeek" => $totalWeek,
      'percentWeek' => $percentWeek,

      "rightMonth" => $rightMonth,
      "wrongMonth" => $totalMonth - $rightMonth,
      "totalMonth" => $totalMonth,
      'percentMonth' => $percentMonth,

      "rightYear" => $rightYear,
      "wrongYear" => $totalYear - $rightYear,
      "totalYear" => $totalYear,
      'percentYear' => $percentYear,

      "today" => $today,
      "week" => $week,
      "month" => $month,
      'year' => $year,
    ];
  }
}