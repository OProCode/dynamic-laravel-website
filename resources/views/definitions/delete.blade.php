<x-app-layout>

    <x-slot name="header">
        {{__('DELETE')}}
    </x-slot>

    <x-slot name="slot" class="w-full text-gray-900 bg-gray-200 dark:bg-gray-800 dark:text-gray-200">

        <div class="text-center text-xl">
            <h2>Are you sure you want to delete '{{ $definition->definition }}'?</h2>

            <form method="POST"
                  action="{{route('definitions.destroy', ['definition'=>$definition])}}"
                  class="flex flex-col w-full gap-4 rounded-md">
                @csrf
                @method('DELETE')

                <section class="flex flex-row w-full text-center pt-16 text-4xl text-gray-200 ">

                    <button type="submit" class="grow">
                        <i class="fa-solid fa-thumbs-up hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                        <span class="sr-only">Yes</span>
                    </button>

                    <a href="{{ route('definitions.index') }}" class="grow">
                        <i class="fa-solid fa-thumbs-down hover:text-orange-500 hover:scale-150 transition ease-in-out duration-350"></i>
                        <span class="sr-only">No</span>
                    </a>

                </section>

                <div class="flex flex-row w-full text-center text-4xl px-6 text-gray-200">


                </div>

            </form>

        </div>

    </x-slot>

</x-app-layout>
