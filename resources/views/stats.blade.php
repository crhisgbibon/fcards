@vite(['resources/js/stats.js'])
@vite(['resources/css/stats.css'])

<x-app-layout>

  <x-slot name="appTitle">
    {{ __('Stats') }}
  </x-slot>

  <x-slot name="appName">
    {{ __('Stats') }}
  </x-slot>

  <div id="messageBoxHolder" style="display:none;"><div id="messageBox"></div></div>

  <x-statsControls :logs="$logs"
  :summary="$summary"
  :cards="$cards"
  :decks="$decks"
  :stacks="$stacks"></x-Flashcards-statsControls>

  <script>
    let summary = {!! json_encode($summary) !!};
    let days = {!! json_encode($summary["days"]) !!};
    let months = {!! json_encode($summary["months"]) !!};
    let logs = {!! json_encode($logs) !!};
    let cards = {!! json_encode($cards) !!};
    let decks = {!! json_encode($decks) !!};
    let stacks = {!! json_encode($stacks) !!};
  </script>

  <x-statsCharts :logs="$logs"
  :summary="$summary"
  :cards="$cards"
  :decks="$decks"
  :stacks="$stacks"></x-Flashcards-statsCharts>

</x-app-layout>