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
              action="{{route('users.update', ['user'=>$user])}}"
              class="flex flex-col w-full gap-4 rounded-md">
            @csrf
            @method('PATCH')

                <div class="flex flex-row w-full">
                    <label for=Name" class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("NAME")}}</label>
                    <input id="Name" name="name" type="text" class="p-2 w-full dark:bg-gray-800 border-none" value="{{old('name') ?? $user->name}}"/>
                </div>

                <div class="flex flex-row w-full">
                    <label for=Email" class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("EMAIL")}}</label>
                    <input id="Email" name="email" type="text" class="p-2 w-full dark:bg-gray-800 border-none" value="{{old('email') ?? $user->email}}"/>
                </div>

                <div class="flex flex-row w-full">
                    <label for=Password" class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("PASSWORD")}}</label>
                    <input id="Password" name="password" type="text" class="p-2 w-full dark:bg-gray-800 border-none" value="{{old('password') ?? $user->password}}"/>
                </div>

                <div class="flex flex-row w-full text-center pt-10 text-2xl">

                    <a href="{{route('users.show', ['user'=>$user])}}" class="grow">
                        <i class="fa-solid fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                        <span class="sr-only">Show</span>
                    </a>

                    <button type="submit" class="grow">
                        <i class="fa-solid fa-save hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                        <span class="sr-only">Save</span>
                    </button>

                    <a href="{{ route('users.index')}}" class="grow">
                        <i class="fa-solid fa-home hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                        <span class="sr-only">Home</span>
                    </a>

                </div>

        </form>

    </x-slot>
</x-app-layout>
