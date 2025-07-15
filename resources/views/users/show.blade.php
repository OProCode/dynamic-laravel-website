<x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-xwE/Az9ZE1z3/z87Lh2RzlfQ88dci25JQaegqBR7QNhtB/P0f1dvV5sW84jGzP1x7pGk+q1FwQbndr6zyvs3Wg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <x-slot name="header">
        {{__('DETAILS')}}
    </x-slot>

    <x-slot name="slot">

        <div class="flex flex-row w-full">
            <p class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("NAME")}}</p>
            <p class="p-2 w-full">{{$user->name}}</p>
        </div>

        <div class="flex flex-row w-full">
            <p class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("EMAIL")}}</p>
            <p class="p-2 w-full">{{$user->email}}</p>
        </div>

        <div class="flex flex-row w-full p-1">
            <p class="w-full text-right text-gray-200">CREATED AT</p>
            <p class="w-1/6 text-right">{{$user->created_at}}</p>
        </div>

        <div class="flex flex-row w-full p-1">
            <p class="w-full text-right text-gray-200">UPDATED AT</p>
            <p class="w-1/6 text-right">{{$user->updated_at}}</p>
        </div>

        <div class="flex flex-row w-full text-center py-10 text-2xl">

            <a href="{{route('users.index')}}" class="grow">
                <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                <span class="sr-only">Home</span>
            </a>

            <a href="{{route('users.edit', ['user'=>$user])}}" class="grow">
                <i class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                <span class="sr-only">Edit</span>
            </a>

            <a href="{{ route('users.delete', ['user'=>$user])}}" class="grow">
                <i class="fa-solid fa-trash-alt hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
            </a>

        </div>

    </x-slot>

</x-app-layout>
