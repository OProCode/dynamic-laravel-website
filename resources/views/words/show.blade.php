<x-app-layout>

    <x-slot name="header">
        {{__('DETAILS')}}
    </x-slot>

    <x-slot name=slot >

        <div class="flex flex-col gap-4 rounded-md w-full">

            <div class="flex flex-row w-full">
                <p class="p-2 w-1/6 bg-gray-400 dark:bg-gray-600 rounded-l-md">{{__('NAME')}}</p>
                <p class="p-2 w-full">{{$word->name}}</p>
            </div>

            <div class="flex flex-row w-full">
                <p class="p-2 w-1/6 bg-gray-400 dark:bg-gray-600 rounded-l-md">{{__('DEFINITIONS')}}</p>
                <div class="flex flex-col w-full">
                    @foreach($word->definitions as $definition)
                        <p class="p-2 w-full">{{$definition->definition}}</p>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-row w-full">
                <p class="p-2 w-1/6 bg-gray-400 dark:bg-gray-600 rounded-l-md">{{__('WORD TYPE')}}</p>
                @if (is_null($word->wordType)) <p class="p-2 w-full fa-solid fa-question"></p>
                @else <p class="p-2 w-full">{{$word->wordType->code}}</p>
                @endif
            </div>

            <div class="flex flex-row w-full">
                <p class="p-2 w-1/6 bg-gray-400 dark:bg-gray-600 rounded-l-md">{{__('AUTHOR')}}</p>
                <p class="p-2 w-full">{{$word->user->name}} ({{$word->user->role}})</p>
            </div>

        </div>

        <div class="flex flex-row w-full p-1">
            <p class="w-full text-right text-gray-200">CREATED AT</p>
            <p class="w-1/6 text-right">{{$word->created_at}}</p>
        </div>

        <div class="flex flex-row w-full p-1">
            <p class="w-full text-right text-gray-200">UPDATED AT</p>
            <p class="w-1/6 text-right">{{$word->updated_at}}</p>
        </div>

        <div class="flex flex-row w-full text-center py-10 text-2xl">
            @if(!Auth::user())
                <a href="{{ route('words.index') }}" class="grow">
                    <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                    <span class="sr-only">Home</span>
                </a>
            @elseif (Auth::user()->hasRole(['user', 'staff']))
                @if(Auth::user()->id !== $word->user->id)
                    <a href="{{ route('words.index') }}" class="grow">
                        <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                        <span class="sr-only">Home</span>
                    </a>
                @else
                    <a href="{{ route('words.index') }}" class="grow">
                        <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                        <span class="sr-only">Home</span>
                    </a>
                    <a href="{{route('words.edit', ['word'=>$word])}}" class="grow">
                        <i class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                        <span class="sr-only">Edit</span>
                    </a>
                    <a href="{{ route('words.delete', ['word'=>$word])}}" class="grow">
                        <i class="fa-solid fa-trash-alt hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                    </a>
                @endif
            @else
                <a href="{{ route('words.index') }}" class="grow">
                    <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                    <span class="sr-only">Home</span>
                </a>
                <a href="{{route('words.edit', ['word'=>$word])}}" class="grow">
                    <i class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                    <span class="sr-only">Edit</span>
                </a>
                <a href="{{ route('words.delete', ['word'=>$word])}}" class="grow">
                    <i class="fa-solid fa-trash-alt hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                </a>
            @endif
        </div>

    </x-slot>
</x-app-layout>
