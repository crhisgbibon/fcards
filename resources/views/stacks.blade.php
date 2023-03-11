@vite(['resources/js/stacks.js'])

<x-app-layout>

  <style>
    :root{
      --background: var(--backgroundLight);
      --foreground: var(--foregroundLight);

      --buttonBackground: var(--buttonBackgroundLight);
      --buttonBorder: var(--buttonBorderLight);

      --buttonBackgroundLight: rgba(225, 225, 225, 1);
      --buttonBorderLight: rgba(75,75,75,1);

      --foregroundLight: rgba(50, 50, 50, 1);
      --backgroundLight: rgba(255, 255, 255, 1);
    }

    #NewEntry, #EditEntry{
      z-index: 1;
      position: fixed;
      background-color: var(--background);
      width: 100%;
      height: calc(var(--vh) * 77);
      top: calc(var(--vh) * 22.5);
      margin: 0;
      padding: 0;
      overflow-y: auto;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      flex-direction: column;
    }
  </style>

  <x-slot name="appTitle">
    {{ __('Stacks') }}
  </x-slot>

  <x-slot name="appName">
    {{ __('Stacks') }}
  </x-slot>

  <div id="messageBoxHolder" style="display:none;"><div id="messageBox"></div></div>

  @isset($stacks)
    @isset($decks)
      <x-stackControls :stacks="$stacks" :decks="$decks"></x-Flashcards-editControls>
    @endisset
  @endisset

</x-app-layout>