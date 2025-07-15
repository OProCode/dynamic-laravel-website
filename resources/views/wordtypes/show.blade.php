<x-app-layout>

    <x-slot name="header">
        {{__('DETAILS')}}
    </x-slot>

    <x-slot name="slot">

        <div class="flex flex-col gap-4 rounded-md w-full">

            <div class="flex flex-row w-full">
                <p class="p-2 w-1/6 text-gray-200 bg-gray-600 rounded-l-md">{{__("CODE")}}</p>
                <p class="p-2 w-full">{{$wordType->code}}</p>
            </div>

            <div class="flex flex-row w-full">
                <p class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("NAME")}}</p>
                <p class="p-2 w-full">{{$wordType->name}}</p>
            </div>

        </div>

        <div class="flex flex-row w-full p-1">
            <p class="w-full text-right text-gray-200">CREATED AT</p>
            <p class="w-1/6 text-right">{{$wordType->created_at}}</p>
        </div>

        <div class="flex flex-row w-full p-1">
            <p class="w-full text-right text-gray-200">UPDATED AT</p>
            <p class="w-1/6 text-right">{{$wordType->updated_at}}</p>
        </div>

        <div class="flex flex-row w-full text-center py-10 text-2xl">
            <a href="{{ route('wordtypes.index') }}" class="grow">
                <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                <span class="sr-only">Home</span>
            </a>

            <a href="{{route('wordtypes.edit', ['wordType'=>$wordType])}}" class="grow">
                <i class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                <span class="sr-only">Edit</span>
            </a>

            <a href="{{ route('wordtypes.delete', ['wordType'=>$wordType])}}" class="grow">
                <i class="fa-solid fa-trash-alt hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
            </a>
        </div>

    </x-slot>
</x-app-layout>
