@vite(['resources/js/play.js'])
@vite(['resources/css/play.css'])

<x-app-layout>

  <x-slot name="appTitle">
    {{ __('Play') }}
  </x-slot>

  <x-slot name="appName">
    {{ __('Play') }}
  </x-slot>

  <div id="messageBoxHolder" style="display:none;"><div id="messageBox"></div></div>

  <x-playControls :decks="$decks" :stacks="$stacks" :card="$card" :currentscore="$currentscore" :currenttotal="$currenttotal"></x-playControls>

</x-app-layout>