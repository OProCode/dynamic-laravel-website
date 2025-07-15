<x-app-layout>
    <x-slot name="header">
        {{__('ADD')}}
    </x-slot>

    @if($errors->any())
        <div class=" flex flex-row gap-4 bg-red-200 text-red-800 my-4">
            @foreach($errors->all() as $error)<p class="p-4">{{$error}}</p>@endforeach
        </div>
    @endif

    <x-slot name="slot">

        <form method="POST"
              action="{{route('users.store')}}"
              class="flex flex-col w-full gap-4 rounded-l-md">
            @csrf
            @method('POST')

            <div class="flex flex-row w-full">
                <label for=Name" class="p-2 w-1/6 bg-gray-400 dark:bg-gray-600 rounded-l-md">{{__("NAME")}}</label>
                <input id="Name" name="name" type="text" class="p-2 w-full bg-gray-400 dark:bg-gray-800 border-none" value=""/>

            </div>

            <div class="flex flex-row w-full">
                <label for=Name" class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("EMAIL")}}</label>
                <input id="Name" name="email" type="text" class="p-2 w-full bg-gray-400 dark:bg-gray-800 border-none" value=""/>
            </div>

            <div class="flex flex-row w-full">
                <label for=Password" class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("PASSWORD")}}</label>
                <input id="Password" name="password" type="text" class="p-2 w-full bg-gray-400 dark:bg-gray-800 border-none" value=""/>
            </div>

            <div class="flex flex-row w-full text-center pt-10 text-2xl">

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
