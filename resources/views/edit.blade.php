@vite(['resources/js/edit.js'])

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

    #messageBoxHolder{
      position: absolute;
      z-index: 100;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(var(--vh) * 10);
      bottom: calc(var(--vh) * 20);
      pointer-events: none;
    }

    #messageBox{
      background-color: var(--foreground);
      color: var(--background);
      width: 100%;
      max-width: 300px;
      height: 100%;
      max-height: 100px;
      border-radius: 6px;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      pointer-events: default;
    }

    #eEditCardScreen{
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
    {{ __('Decks') }}
  </x-slot>

  <x-slot name="appName">
    {{ __('Decks') }}
  </x-slot>

  <div id="messageBoxHolder"><div id="messageBox"></div></div>

  @isset($cards)
    @isset($decks)
      <x-editControls :cards="$cards" :decks="$decks"></x-Flashcards-editControls>
    @endisset
  @endisset

</x-app-layout>