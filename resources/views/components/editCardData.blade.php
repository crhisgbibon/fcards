@isset($cards)
@isset($decks)

<div class="w-full flex flex-col items-start">

@foreach($decks as $deck)

  <div class="cardType flex flex-col justify-center items-center w-full max-w-2xl mx-auto mb-2" data-search='{{$deck->id}}' data-name='{{$deck->name}}'>

    <div class="flex flex-row justify-center items-center w-full mx-2 bg-zinc-100 border-y md:border-x border-zinc-400">
      <button class="cardmodify mx-2 flex justify-center items-center" id='eCardModify' data-i={{$deck->id}}>
        <img src="{{ asset('storage/Assets/eyeLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
      <button class="newcardwithcategory mx-2 flex justify-center items-center" id='eCardModify' data-i={{$deck->id}}>
        <img src="{{ asset('storage/Assets/plusLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
      <input type="text" class="mx-2 w-full p-2 bg-transparent border-0" id="{{$deck->id}}newCategoryName" value='{{$deck->name}}'>
      <button class="updatecategoryname mx-2 flex justify-center items-center" id='eCardModify' data-i={{$deck->id}}>
        <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
      <div id="{{$deck->id}}colDiv" class="showCols mx-2 rounded-lg" data-i={{$deck->id}}
        style="width:75%;height:75%;min-width:20px;min-height:20px;max-width:40px;max-height:40px;background-color:<?php
          $col = json_decode($deck->col);
          if($col !== null && property_exists($col, "r") && property_exists($col, "g") && property_exists($col, "b"))
          {
            echo sprintf("#%02x%02x%02x", $col->r, $col->g,$col->b);
          }
          else
          {
            echo sprintf("#%02x%02x%02x", 255, 255, 255);
          }?>">
        <input hidden type="color" id="{{$deck->id}}colInput" class="hiddenCols" data-i={{$deck->id}} value="<?php
          $col = json_decode($deck->col);
          if($col !== null && property_exists($col, "r") && property_exists($col, "g") && property_exists($col, "b"))
          {
            echo sprintf("#%02x%02x%02x", $col->r, $col->g,$col->b);
          }
          else
          {
            echo sprintf("#%02x%02x%02x", 255, 255, 255);
          }?>">
      </div>
    </div>

    <div class="w-full" id="{{$deck->id}}displayCards" style="display:none;">

      @foreach($cards as $card)

        @if($card->deckID === $deck->id)

          <div class="flex flex-col justify-center items-center w-full md:border-x border-b border-zinc-400" 
          data-id='{{$card->id}}'
          data-deckID='{{$card->deckID}}'
          id='{{$card->id}}eCardCategory'
          >

            <div class="flex flex-row justify-between items-center w-full mb-2 mt-4">
              <div class="flex flex-row justify-start items-center w-full">
                <div class="mx-2">{{ __('D: ') }}</div>
                <textarea class="w-full p-2 mx-2" id='{{$card->id}}eCardDeck'>{{$deck->name}}</textarea>
              </div>
            </div>

            <div class="flex flex-row justify-between items-center w-full mb-2 mt-4">
              <div class="flex flex-row justify-start items-center w-full">
                <div class="mx-2">{{ __('Q: ') }}</div>
                <textarea class="w-full p-2 mx-2" id='{{$card->id}}eCardQuestion'>{{json_decode($card->question)}}</textarea>
              </div>
            </div>

            <div class="flex flex-row justify-between items-center w-full my-2">
              <div class="flex flex-row justify-start items-center w-full">
                <div class="mx-2">{{ __('A: ') }}</div>
                <textarea class="w-full p-2 mx-2" id='{{$card->id}}eCardAnswer'>{{json_decode($card->answer)}}</textarea>
              </div>
            </div>

            <div class="flex flex-row justify-between items-center w-full my-2">
              <div class="flex flex-row justify-start items-center w-full">
                <div class="mx-2">{{ __('L: ') }}</div>
                <textarea class="w-full p-2 mx-2" id='{{$card->id}}eCardLink'>{{json_decode($card->link)}}</textarea>
              </div>
            </div>

            <div class="flex flex-row justify-evenly items-center w-full mx-auto m-2">
              <button class="savecardchanges m-2" data-i={{$card->id}}>
                <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/saveLight.svg') }}">
              </button>
              <button class="deletecardbutton m-2" data-i={{$card->id}}>
                <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/eraseLight.svg') }}">
              </button>
            </div>

          </div>

        @endif

      @endforeach

      <div class="w-full m-2 p2 flex justify-center items-center">
        <button class="addcardwithcategory m-2 p2 flex justify-center items-center" data-i={{$deck->id}} id='eCardModify'>
          <img src="{{ asset('storage/Assets/plusLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
        </button>
      </div>

    </div>

  </div>

@endforeach

</div>

@endisset
@endisset