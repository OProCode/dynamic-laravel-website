<x-app-layout>

    <x-slot name="header">
        {{__('WORD TYPES')}}
    </x-slot>

    <x-slot name="slot">

        <table class="table w-full text-gray-900 dark:text-gray-200 text-align:left">
            <thead>
            <tr class="text-left text-xl">
                <th class="py-6">NO.</th>
                <th class="py-6">CODE</th>
                <th class="py-6">NAME</th>
                <th class="py-6 text-center w-1/6">ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($wordTypes as $wordType)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$wordType->code}}</td>
                    <td>{{$wordType->name}}</td>
                    <td class="flex flex-row text-l w-full text-center">
                        <a href="{{route('wordtypes.show', ['wordType'=>$wordType])}}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                        <a href="{{route('wordtypes.edit', ['wordType'=>$wordType])}}" class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                        <a href="{{route('wordtypes.delete', ['wordType'=>$wordType])}}" class="fa fa-trash-alt hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        {{ $wordTypes -> links() }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <x-slot name="pagination">
            <a href="{{route('wordtypes.add')}}" class="text-4xl text-center"><i class="fa-solid fa-plus hover:scale-150 hover:text-orange-500 active:text-orange-800 transition ease-in-out-300"></i></a>
            {{ $wordTypes -> links() }}
        </x-slot>

    </x-slot>

</x-app-layout>
