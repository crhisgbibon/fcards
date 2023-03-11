@isset($decks)
@isset($stacks)

<div id="playSelectMenu" class="fixed z-10 w-full bg-white mx-auto flex flex-col justify-start items-center" style="height:calc(var(--vh) * 77">

  <div id="Toggles" class="mx-auto flex flex-row justify-center items-center w-full max-w-xs" style="height:calc(var(--vh) * 7.5">
    <button id="toggleDecks" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg" style="background-color:var(--foregroundLight);color:var(--background)">{{ __('Decks') }}</button>
    <button id="toggleStacks" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg" style="background-color:var(--buttonBackgroundLight);">{{ __('Stacks') }}</button>
  </div>

  <div id="selectDeckPanel" class="togglePanels mx-auto flex flex-col justify-start items-center w-full max-w-xs">
    <div id="triggerSelectDeck" class="togglePanelSub max-w-xs w-full max-h-full overflow-y-auto" style="max-height:calc(var(--vh) * 62">
      <?php
        foreach($decks as $deck)
        {
          echo "<div onclick='MakeCurrent(this)'class='source w-10/12 mx-auto my-2 p-2 rounded-lg hover:bg-gray-100' data-type='DECK' data-value='$deck->id' style='background-color:var(--buttonBackgroundLight);'>$deck->name</div>";
        }
      ?>
    </div>
  </div>

  <div id="selectStackPanel" class="togglePanels mx-auto flex flex-col justify-start items-center w-full max-w-xs" style="display:none;">
    <div id="triggerSelectStack" class="togglePanelSub max-w-xs w-full max-h-full overflow-y-auto" style="max-height:calc(var(--vh) * 62">
      <?php
        foreach($stacks as $stack)
        {
          echo "<div onclick='MakeCurrent(this)'class='source w-10/12 mx-auto my-2 p-2 rounded-lg hover:bg-gray-100' data-type='STACK'data-value='$stack->id' style='background-color:var(--buttonBackgroundLight);'>$stack->name</div>";
        }
      ?>
    </div>
  </div>

  <div class="mx-auto flex flex-col justify-center items-center" style="height:calc(var(--vh) * 7.5">
    <x-primary-button id="LoadSource" class="max-w-xs">Load</x-primary-button>
  </div>

</div>

@endisset
@endisset