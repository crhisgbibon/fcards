<div class="w-full border-b border-gray-100">
  <div class="flex flex-row justify-center items-center w-full max-w-xl mx-auto" style="height:calc(var(--vh) * 7.5)">
    <button class="mr-4 w-8 h-full flex justify-center items-center" id="pPlayButton">
      <img id="i_pPlay" class="w-11/12 h-11/12" src="{{ asset('storage/Assets/databaseLight.svg') }}">
    </button>
    <div class="mx-2 w-10 h-full flex justify-center items-center" id="pScore">@isset($currentscore){{$currentscore}}@endisset</div>
    <div class="w-2 h-full flex justify-center items-center">{{ __(' / ')}}</div>
    <div class="mx-2 w-10 h-full flex justify-center items-center" id="pTotal">@isset($currenttotal){{$currenttotal}}@endisset</div>
    <button class="mx-2 w-8 h-full flex justify-center items-center" id="pReset">
      <img class="w-11/12 h-11/12" src="{{ asset('storage/Assets/undoLight.svg') }}">
    </button>
  </div>
</div>

@isset($decks)
  @isset($stacks)
    <x-playSelect :decks="$decks" :stacks="$stacks"></x-playCard>
  @endisset
@endisset

<div id="pDisplay">
  @isset($card)
    <x-playCard :card="$card"></x-playCard>
  @endisset
</div>