@isset($stacks)
@isset($decks)

<div class="flex flex-row justify-center items-center w-full max-w-xl mx-auto" style="height:calc(var(--vh) * 7.5)">

  <input class="w-full max-w-xs h-11/12" type="text" id="Find" placeholder="Search...">

  <button class="mx-2 flex justify-center items-center" id="New" style="width:10%">
    <img src="{{ asset('storage/Assets/plus.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
  </button>

</div>

<div id="Display" class="overflow-y-scroll" style="height:calc(var(--vh) * 77)">
  @isset($stacks)
    <x-stackData :stacks="$stacks" :decks="$decks"></x-stackData>
  @endisset
</div>

<div id="NewEntry">

  <div class="my-2 w-full max-w-xl flex justify-center items-center font-bold">{{ __('New Stack') }}</div>

  <label class="my-2 w-full max-w-sm flex justify-center items-center" for="NewEntryName">{{ __('Name:') }}</label>
  <input class="my-2 w-full max-w-sm flex justify-center items-center" type="text" id="NewEntryName">

  <label class="my-2 w-full max-w-sm flex justify-center items-center" for="SelectNew">{{ __('Decks:') }}</label>
  <select multiple class="w-full max-w-sm h-11/12" id="SelectNew" style="min-height:calc(var(--vh) * 25)">
    @foreach($decks as $option)
      <option value="{{$option->id}}">{{$option->name}}</option>
    @endforeach
  </select>

  <x-primary-button class="my-4 w-full max-w-xs flex justify-center items-center" id="AddNew">{{ __('Add') }}</x-primary-button>
  <x-primary-button class="my-4 w-full max-w-xs flex justify-center items-center" id="CloseNewEntry">{{ __('Close') }}</x-primary-button>
  
</div>

<div id="EditEntry">

  <div class="my-2 w-full max-w-xl flex justify-center items-center font-bold">{{ __('Edit Stack') }}</div>

  <label class="my-2 w-full max-w-sm flex justify-center items-center" for="EditEntryName">{{ __('Name:') }}</label>
  <input class="my-2 w-full max-w-sm flex justify-center items-center" type="text" id="EditEntryName">

  <label class="my-2 w-full max-w-sm flex justify-center items-center" for="SelectEdit">{{ __('Decks:') }}</label>
  <select multiple class="w-full max-w-sm h-11/12" id="SelectEdit" style="min-height:calc(var(--vh) * 25)">
    @foreach($decks as $option)
      <option value="{{$option->id}}">{{$option->name}}</option>
    @endforeach
  </select>

  <x-primary-button class="my-4 w-full max-w-xs flex justify-center items-center" id="SubmitEdit">{{ __('Submit') }}</x-primary-button>
  <x-primary-button class="my-4 w-full max-w-xs flex justify-center items-center" id="CloseEdit">{{ __('Close') }}</x-primary-button>
  
</div>

@endisset
@endisset