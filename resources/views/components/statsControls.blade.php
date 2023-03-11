<div class="flex flex-row justify-center items-center w-full max-w-2xl mx-auto" style="height:calc(var(--vh) * 7.5)">
  <button id="ToggleAll" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg">
    {{ __('All') }}
  </button>
  <button id="ToggleCards" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg">
    {{ __('Cards') }}
  </button>
  <button id="ToggleDecks" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg">
    {{ __('Decks') }}
  </button>
  <button id="ToggleStacks" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg">
    {{ __('Stacks') }}
  </button>
</div>

<div id="logsDisplay" style="height:calc(var(--vh) * 77)">
  @isset($logs)
    <x-statsData :logs="$logs"
    :summary="$summary"
    :cards="$cards"
    :decks="$decks"
    :stacks="$stacks"></x-statsData>
  @endisset
</div>