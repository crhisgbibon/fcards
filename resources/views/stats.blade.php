@vite(['resources/js/stats.js'])

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

    .right{
      background-color: var(--green);
    }

    .wrong{
      background-color: var(--red);
    }

    .rightWrong{
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
      height: 50px;
      width: 50px;
      border: 1px solid var(--foreground);
    }
  </style>

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