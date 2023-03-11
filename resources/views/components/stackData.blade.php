@isset($stacks)
@isset($decks)

<div class="w-full flex flex-col items-start">

  @foreach($stacks as $stack)

    <div class="stackType flex flex-col justify-center items-center w-full max-w-2xl mx-auto mb-2"
    id="{{$stack->id}}Meta"
    data-id='{{$stack->id}}'
    data-search='{{$stack->name}}'
    data-decks='{{$stack->decks}}'>

      <div class="flex flex-row justify-center items-center w-full mx-2 bg-zinc-100 border-y md:border-x border-zinc-400">
        <button class="togglestack mx-2 flex justify-center items-center" data-i={{$stack->id}}>
          <img src="{{ asset('storage/Assets/eyeLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
        </button>
        <input class="mx-2 w-full p-2 bg-transparent" id="{{$stack->id}}NewName" value='{{$stack->name}}'>
        <button class="updatestackname mx-2 flex justify-center items-center" data-i={{$stack->id}}>
          <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
        </button>
      </div>

      <div class="w-full" id="{{$stack->id}}displayStack" style="display:none;">

        <div class="flex flex-row justify-between items-center w-full my-2">
          <div class="flex flex-row justify-start items-center w-full">
            <div class="mx-2">{{ __('Decks: ') }}</div>
            <div class="w-full p-2 mx-2" id='{{$stack->id}}Contents'>
              @foreach(json_decode($stack->decks) as $deck)
                @foreach($decks as $d)
                  @if((int)$d->id === (int)$deck)
                    {{$d->name}}
                    @if(!$loop->parent->last)
                      {{","}}
                    @endif
                  @endif
                @endforeach
              @endforeach
            </div>
          </div>
        </div>

        <div class="flex flex-row justify-evenly items-center w-full mx-auto m-2">
          <button data-i={{$stack->id}} class="editstackscreen m-2">
            <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/plusLight.svg') }}">
          </button>
          <button data-i={{$stack->id}} class="deletestack m-2">
            <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/eraseLight.svg') }}">
          </button>
        </div>

      </div>

    </div>

  @endforeach

</div>

@endisset
@endisset