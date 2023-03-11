@isset($card)

  <div id='pFlashCard' class="rounded-lg" style="background-color:<?php
  $col = json_decode($card->col);
  if($col !== null && property_exists($col, "r") && property_exists($col, "g") && property_exists($col, "b"))
  {
    echo sprintf("#%02x%02x%02x", $col->r, $col->g,$col->b);
  }
  else
  {
    echo sprintf("#%02x%02x%02x", 255, 255, 255);
  }?>">

    <div id="QuestionHolder">
      <textarea readonly="readonly" class="bg-transparent" unselectable="on" id='pFlashCardCategory'>{{json_decode($card->category)}}</textarea>
      <textarea readonly="readonly" class="bg-transparent" unselectable="on" id='pFlashCardQuestion'>{{json_decode($card->question)}}</textarea>
    </div>

    <div id='pFlashCardAnswer' style='display:none;'>

      <div id="AnswerHolder" class="flex flex-col justify-evenly items-center">
        <textarea readonly="readonly" class="bg-transparent w-full" unselectable="on" id='pFlashCardAnswerContents'>{{json_decode($card->answer)}}</textarea>
        @if(json_decode($card->link) !== null && json_decode($card->link) !== "")
          <a class="m-2 p-2 mx-auto rounded-lg bg-slate-800 text-slate-50 border-slate-900" id="moreLink" href='{{json_decode($card->link)}}' target="_blank">{{ __('More') }}</a>
        @endif
      </div>

      <div class='pControls'>

        <div class='pControlDiv'>
          <button class='pButton' id="rightAnswerButton" data-i={{$card->id}}>
            <img class="w-2/4 h-2/4" src="{{ asset('storage/Assets/tickLight.svg') }}">
          </button>
        </div>

        <div class='pControlDiv'>
          <button class='pButton' id="wrongAnswerButton" data-i={{$card->id}}>
            <img class="w-2/4 h-2/4" src="{{ asset('storage/Assets/xLight.svg') }}">
          </button>
        </div>

      </div>
    </div>
  </div>

@endisset