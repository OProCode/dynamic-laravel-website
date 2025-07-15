<x-app-layout>
    <x-slot name="header">
        {{__('EDIT')}}
    </x-slot>

    <x-slot name="slot">

    <form method="POST"
          action="{{route('wordtypes.update', ['wordType'=>$wordType])}}"
          class="flex flex-col w-full gap-4 rounded-md">
        @csrf
        @method('PATCH')

            <div class="flex flex-row w-full">
                <label for=Code" class="p-2 w-1/6 bg-gray-400 dark:bg-gray-600 rounded-l-md">{{__("CODE")}}</label>
                <input id="Code" name="code" type="text" class="p-2 w-full bg-gray-400 dark:bg-gray-800 border-none hover:bg-gray-500 focus:bg-gray-700" value="{{old('code') ?? $wordType->code}}"/>
            </div>

            <div class="flex flex-row w-full">
                <label for=Name" class="p-2 w-1/6 bg-gray-400 dark:bg-gray-600 rounded-l-md">{{__("NAME")}}</label>
                <input id="Name" name="name" type="text" class="p-2 w-full bg-gray-400 dark:bg-gray-800 border-none hover:bg-gray-500 focus:bg-gray-700" value="{{old('name') ?? $wordType->name}}"/>
            </div>

            <div class="flex flex-row w-full text-center pt-10 text-2xl">

                <a href="{{route('wordtypes.show', ['wordType'=>$wordType])}}" class="grow">
                    <i class="fa-solid fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                    <span class="sr-only">Show</span>
                </a>

                <button type="submit" class="grow">
                    <i class="fa-solid fa-save hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                    <span class="sr-only">Save</span>
                </button>

                <a href="{{ route('wordtypes.index', ['wordType'=>$wordType])}}" class="grow">
                    <i class="fa-solid fa-home hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                    <span class="sr-only">Home</span>
                </a>

            </div>

        </form>

    </x-slot>
</x-app-layout>
