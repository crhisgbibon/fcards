@isset($cards)
@isset($decks)

<div class="flex flex-row justify-center items-center w-full max-w-2xl mx-auto" style="height:calc(var(--vh) * 7.5)">

  <select class="w-full h-11/12" id="eCategory" style="width:45%">
    <option selected value="-1">{{ __('Show All') }}</option>
    @foreach($decks as $option)
      <option value="{{$option->id}}">{{$option->name}}</option>
    @endforeach
  </select>

  <input class="w-full h-11/12" type="text" id="eFind" placeholder="Search..." style="width:45%">

  <button class="mx-2 flex justify-center items-center" id="eNewCard" style="width:10%">
    <img src="{{ asset('storage/Assets/plus.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
  </button>

</div>

<div id="eCardDisplay" class="overflow-y-scroll" style="height:calc(var(--vh) * 77)">
  @isset($cards)
    <x-deckCardData :cards="$cards" :decks="$decks"></x-deckCardData>
  @endisset
</div>

<div id="eEditCardScreen" class="flex flex-col justify-start items-center" style="min-height:calc(var(--vh) * 77)">

  <div class="my-2 w-full max-w-xl flex justify-center items-center font-bold">{{ __('New Card') }}</div>

  <label class="my-2 w-full max-w-sm flex justify-center items-center" for="eEditCardScreenCategories">{{ __('Category:') }}</label>
  <input class="my-2 w-full max-w-sm flex justify-center items-center" type="text" id="eEditCardScreenCategory">

  <label class="my-2 w-full max-w-sm flex justify-center items-center" for="eEditCardScreenQuestion">{{ __('Question:') }}</label>
  <textarea class="my-2 w-full max-w-sm flex justify-center items-center" style="min-height:50px" id="eEditCardScreenQuestion" contentEditable="true"></textarea>

  <label class="my-2 w-full max-w-sm flex justify-center items-center" for="eEditCardScreenAnswer">{{ __('Answer:') }}</label>
  <textarea class="my-2 w-full max-w-sm flex justify-center items-center" style="min-height:50px" id="eEditCardScreenAnswer" contentEditable="true"></textarea>

  <label class="my-2 w-full max-w-sm flex justify-center items-center" for="eEditCardScreenLink">{{ __('Link:') }}</label>
  <textarea class="my-2 w-full max-w-sm flex justify-center items-center" style="min-height:50px" id="eEditCardScreenLink" contentEditable="true"></textarea>

  <x-primary-button class="my-4 w-full max-w-xs flex justify-center items-center" id="eEditCardScreenAdd">{{ __('Add') }}</x-primary-button>
  <x-primary-button class="my-4 w-full max-w-xs flex justify-center items-center" id="eEditCardScreenClose">{{ __('Close') }}</x-primary-button>
  
</div>

@endisset
@endisset