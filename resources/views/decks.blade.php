@vite(['resources/js/decks.js'])
@vite(['resources/css/decks.css'])

<x-app-layout>

  <x-slot name="appTitle">
    {{ __('Decks') }}
  </x-slot>

  <x-slot name="appName">
    {{ __('Decks') }}
  </x-slot>

  <div id="messageBoxHolder"><div id="messageBox"></div></div>

  @isset($cards)
    @isset($decks)
      <x-deckControls :cards="$cards" :decks="$decks"></x-Flashcards-deckControls>
    @endisset
  @endisset

</x-app-layout>