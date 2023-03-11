<div id="AllData" class="w-full flex flex-col items-center justify-evenly max-w-xs mx-auto overflow-y-auto" style="max-height:calc(var(--vh) * 77)">
  
  <div class="w-full flex flex-col items-center justify-evenly max-w-xs mx-auto" style="height:calc(var(--vh) * 77);max-height: 600px;">

    <select id="StatSelect" class="flex flex-row justify-center items-center w-full max-w-2xl mx-auto my-4" style="height:calc(var(--vh) * 7.5)"></select>

    <div class="flex flex-row justify-center items-center w-full max-w-2xl mx-auto my-4" style="height:calc(var(--vh) * 5)">
      <button id="LastStat" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg">
        <img src="{{ asset('storage/Assets/chevronLeftLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
      <div id="Stat" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg">
        {{ __('Totals') }}
      </div>
      <button id="NextStat" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg">
        <img src="{{ asset('storage/Assets/chevronRightLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
      </button>
    </div>

    <div class="w-full my-2 flex justify-center items-center" style="max-height:calc(var(--vh) * 45)">
      <canvas id="Chart"></canvas>
    </div>

    <div class="flex flex-row justify-center items-center w-full max-w-2xl mx-auto my-4" style="height:calc(var(--vh) * 5)">
      <button id="LastPeriod" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg">
        <img src="{{ asset('storage/Assets/chevronLeftLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
      <div id="Period" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg">
        {{ __('Forever') }}
      </div>
      <button id="NextPeriod" class="panelToggle w-1/3 h-10/12 mx-4 p-2 flex justify-center items-center rounded-lg">
        <img src="{{ asset('storage/Assets/chevronRightLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
    </div>

  </div>

</div>