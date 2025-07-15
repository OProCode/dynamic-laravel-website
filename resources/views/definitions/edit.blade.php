<x-app-layout>

    <x-slot name="header">
        {{__('EDIT')}}
    </x-slot>

    <x-slot name="slot">

    @if($errors->any())
        <div class=" flex flex-row gap-4 bg-red-200 text-red-800 my-4">
            @foreach($errors->all() as $error)<p class="p-4">{{$error}}</p>@endforeach
        </div>
    @endif

    <form method="POST"
          action="{{route('definitions.update', ['definition'=>$definition])}}"
          class="flex flex-col w-full gap-4 rounded-md">
        @csrf
        @method('PATCH')


            <div class="flex flex-row w-full">
                <label for=Definition" class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("DEFINITION")}}</label>
            @if(!Auth::user()->hasRole('admin'))
                @if($definition->user->hasRole('admin'))
                    <input id="Definition" name="definition" type="text" disabled class="p-2 w-full bg-gray-400 dark:bg-gray-800 border-none" value="{{old('definition') ?? $definition->definition}}"/>
                @else
                    <input id="Definition" name="definition" type="text" class="p-2 w-full bg-gray-400 dark:bg-gray-800 border-none" value="{{old('definition') ?? $definition->definition}}"/>
                @endif
            @elseif(Auth::user()->hasRole('user'))
                    @if(!Auth::user()->id == $definition->user->id)
                        <input id="Definition" name="definition" type="text" disabled class="p-2 w-full bg-gray-400 dark:bg-gray-800 border-none" value="{{old('definition') ?? $definition->definition}}"/>
                     @endif
            @else
                    <input id="Definition" name="definition" type="text" class="p-2 w-full bg-gray-400 dark:bg-gray-800 border-none" value="{{old('definition') ?? $definition->definition}}"/>
            @endif
            </div>


            <div class="flex flex-row items-center w-full">
                <div class="flex flex-row gap-28 items-center p-2 w-1/6 bg-gray-600 rounded-l-md">
                    <p>{{ __("RATE") }}</p>
                </div>

                <div class="p-4 w-full text-end">
                    <label for="ratingSlider" class="w-full ml-2">
                        @if ($userRating == null)
                            <input id="Rating" name="rating" type="range" min="1" max="10" value="1" class="w-full appearance-none bg-gray-500 h-2 rounded-full outline-none"/>
                        @else
                            <input id="Rating" name="rating" type="range" min="1" max="10" value="{{old('value') ?? $userRating->value}}" class="w-full appearance-none bg-gray-500 h-2 rounded-full outline-none"/>
                        @endif
                            <div class="flex justify-between p-4">
                        @for($value = 1; $value <= 10; $value++)
                            <span class="text-gray-500">{{ $value }}</span>
                        @endfor
                    </div>
                    </label>
                </div>
            </div>

            <div class="flex flex-row w-full text-center pt-10 text-2xl">

                <a href="{{route('definitions.show', ['definition'=>$definition])}}" class="grow">
                    <i class="fa-solid fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                    <span class="sr-only">Show</span>
                </a>

                <button type="submit" class="grow">
                    <i class="fa-solid fa-save hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                    <span class="sr-only">Save</span>
                </button>

                <a href="{{ route('definitions.index')}}" class="grow">
                    <i class="fa-solid fa-home hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                    <span class="sr-only">Home</span>
                </a>

            </div>

        </form>

    </x-slot>
</x-app-layout>
