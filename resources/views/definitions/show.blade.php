<x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-xwE/Az9ZE1z3/z87Lh2RzlfQ88dci25JQaegqBR7QNhtB/P0f1dvV5sW84jGzP1x7pGk+q1FwQbndr6zyvs3Wg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <x-slot name="header">
        {{__('DETAILS')}}
    </x-slot>

{{--    TODO: Add functionality to view, edit, and delete all admin/staff/user ratings--}}

    <x-slot name="slot">

            <div class="flex flex-row w-full rounded-md">
                <p class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("DEFINITION")}}</p>
                <p class="p-2 w-full">{{$definition->definition}}</p>
            </div>

            <div class="flex flex-row w-full rounded-md">
                <p class="p-2 w-1/6 bg-gray-600  rounded-l-md">{{__("AUTHOR")}}</p>
                <p class="p-2 w-full">{{$definition->user->name}}</p>
            </div>

            <div class="flex flex-row w-full">
                <p class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("AVERAGE RATING")}}</p>
                <p class="p-2 w-full flex space-x-1">
                    @for($value = 1; $value <=10; $value++)
                        @if($value <= $definition->averageRating())
                            <i class="fa-solid fa-star text-yellow-400"></i>
                        @else
                            <i class="fa-solid fa-star text-gray-400"></i>
                        @endif
                    @endfor
                    <i class="fa-solid fa-ranking-star px-2 text-yellow-400"></i>{{$definition->totalRatings()}}
                </p>
            </div>

        @if(Auth::user())
            <div class="flex flex-row w-full ">
                <p class="p-2 w-1/6 bg-gray-600 rounded-l-md">{{__("YOUR RATING")}}</p>
                <p class="p-2 w-full flex space-x-1">
                    @for($value = 1; $value <=10; $value++)
                        @if($value <= $definition->userRating())
                            <i class="fa-solid fa-star text-yellow-400"></i>
                        @else
                            <i class="fa-solid fa-star text-grey-400"></i>
                        @endif
                    @endfor
                </p>
            </div>
        @endif

            <div class="flex flex-row w-full p-1">
                <p class="w-full text-right text-gray-200">CREATED AT</p>
                <p class="w-1/6 text-right">{{$definition->created_at}}</p>
            </div>

            <div class="flex flex-row w-full p-1">
                <p class="w-full text-right text-gray-200">UPDATED AT</p>
                <p class="w-1/6 text-right">{{$definition->updated_at}}</p>
            </div>

        <div class="flex flex-row w-full text-center py-10 text-2xl">

            @if(!Auth::user())
                <a href="{{ route('definitions.index') }}" class="grow">
                    <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                    <span class="sr-only">Home</span>
                </a>
            @elseif(!Auth::user()->hasRole('admin'))
                @if(Auth::user()->hasRole('user') && Auth::user()->id !== $definition->user_id)
                    <a href="{{ route('definitions.index') }}" class="grow">
                        <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                        <span class="sr-only">Home</span>
                    </a>
                @elseif(Auth::user()->hasRole('staff'))
                    @if($definition->user->hasRole('admin'))
                        <a href="{{ route('definitions.index') }}" class="grow">
                            <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                            <span class="sr-only">Home</span>
                        </a>
                        <a href="{{route('definitions.edit', ['definition'=>$definition])}}" class="grow">
                            <i class="fa-regular fa-star hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                            <span class="sr-only">Edit</span>
                        </a>
                    @else
                        <a href="{{ route('definitions.index') }}" class="grow">
                            <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                            <span class="sr-only">Home</span>
                        </a>
                        <a href="{{route('definitions.edit', ['definition'=>$definition])}}" class="grow">
                            <i class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                            <span class="sr-only">Edit</span>
                        </a>
                        <a href="{{ route('definitions.delete', ['definition'=>$definition])}}" class="grow">
                            <i class="fa-solid fa-trash-alt hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                        </a>
                    @endif
                @endif
            @else
                <a href="{{ route('definitions.index') }}" class="grow">
                    <i class="fa-solid fa-house hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                    <span class="sr-only">Home</span>
                </a>
                <a href="{{route('definitions.edit', ['definition'=>$definition])}}" class="grow">
                    <i class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></i>
                    <span class="sr-only">Edit</span>
                </a>
                <a href="{{ route('definitions.delete', ['definition'=>$definition])}}" class="grow">
                    <i class="fa-solid fa-trash-alt hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                </a>
            @endif

        </div>

    </x-slot>

</x-app-layout>
