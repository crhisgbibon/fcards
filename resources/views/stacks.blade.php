@vite(['resources/js/stacks.js'])
@vite(['resources/css/stacks.css'])

<x-app-layout>

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