<x-app-layout>

    <x-slot name="header">
        {{__('DELETE')}}
    </x-slot>

    <x-slot name="slot">

        <div class="text-center text-xl">
            <h2>Are you sure you want to delete '{{ $wordType->name }}'?</h2>

            <form method="POST"
                  action="{{route('wordtypes.destroy', ['wordType'=>$wordType])}}"
                  class="flex flex-col w-full gap-4 rounded-md">
                @csrf
                @method('DELETE')

                <section class="flex flex-row w-full text-center pt-16 text-4xl text-gray-200 ">

                    <button type="submit" class="grow">
                        <i class="fa-solid fa-thumbs-up hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                        <span class="sr-only">Yes</span>
                    </button>

                    <a href="{{ route('wordtypes.index') }}" class="grow">
                        <i class="fa-solid fa-thumbs-down hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                    </a>

                </section>

                <div class="flex flex-row w-full text-center text-4xl px-6 text-gray-200">

                </div>

            </form>

        </div>

    </x-slot>

</x-app-layout>
