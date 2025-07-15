<x-app-layout>
    <x-slot name="header">
        {{__('EDIT')}}
    </x-slot>

    <script>
        const icon = document.getElementById('Icon');

        function onclick(){
            icon.innerHTML =
        }
    </script>

    @if($errors->any())
    <div class=" flex flex-row gap-4 bg-red-200 text-red-800 my-4">
        @foreach($errors->all() as $error)<p class="p-4">{{$error}}</p>@endforeach
    </div>
    @endif

    <x-slot name="slot">

        <form method="POST"
              action="{{route('ratings.update', ['rating'=>$rating])}}"
              class="flex flex-col w-full gap-4 rounded-md">
            @csrf
            @method('PATCH')


            <div class="flex flex-row w-full">
                <label for=Name" class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("NAME")}}</label>
                <input id="Name" name="name" type="text" class="p-2 w-full bg-gray-400 dark:bg-gray-800 border-none" value="{{old('name') ?? $rating->name}}"/>
            </div>

            <div class="flex flex-row w-full">
                <label for=Icon" class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("ICON")}}</label>
                <div class="p-4 space-x-5 w-full bg-gray-400 dark:bg-gray-800 justify-items-center">
                    @foreach($icons as $icon)
                        <input type="radio" id="Icon" name="icon" value="{{ $icon }}" @if(old('icon') ?? $rating->icon==$icon) checked="checked" @endif>
                        <i class="fa-solid fa-{{ $icon }} text-2xl transition duration-150 transform hover:scale-125"></i></input>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-row items-center w-full ">
                <p class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{ __("VALUE") }}</p>
                <div class="p-4 w-full">
                    <label for="Value" class="w-full ml-2">
                    <input id="Value" name="value" type="range" min="1" max="10" value="{{old('value') ?? $rating->value}}" class="w-full appearance-none bg-gray-500 h-2 rounded-full outline-none"/>
                    <div class="flex justify-between p-4">
                        @for($count=1; $count <= 10; $count++)
                            <span class="text-gray-500">{{ $count }}</span>
                        @endfor
                    </div>
                    </label>
                </div>
            </div>


            <div class="flex flex-row w-full text-center pt-10 text-2xl">

                    <a href="{{route('ratings.show', ['rating'=>$rating])}}" class="grow">
                        <i class="fa-solid fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                        <span class="sr-only">Show</span>
                    </a>

                    <button type="submit" class="grow">
                        <i class="fa-solid fa-save hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                        <span class="sr-only">Save</span>
                    </button>

                    <a href="{{ route('ratings.index', ['rating'=>$rating])}}" class="grow">
                        <i class="fa-solid fa-home hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                        <span class="sr-only">Home</span>
                    </a>

                </div>


        </form>

    </x-slot>
</x-app-layout>
