<x-app-layout>

    <x-slot name="header" >
        {{__('WORDS')}}
    </x-slot>

    <x-slot name="slot">

        <table class="table w-full text-gray-900 dark:text-gray-200 text-align:left">
            <thead>
            <tr class="text-left text-xl">
                <th class="py-6">NO.</th>
                <th class="py-6">NAME</th>
                <th class="py-6">DEFINITIONS</th>
                <th class="py-6">WORD TYPE ID</th>
                <th class="py-6 text-center">ACTIONS</th>
            </tr>
            </thead>
            <tbody>

            @foreach($words as $word)
                <tr>
                    <td>{{$word->id}}</td>
                    <td>{{$word->name}}</td>
                    <td>
                        <p>{{ $word->definitions->count() }}</p>
                    </td>
                    @if(is_null($word->wordType))
                        <td><i class="fa-solid fa-question"></i></td>
                    @else
                        <td>{{$word->wordType->code}}</td>
                    @endif

                    @if(!Auth::user())
                        <td class="flex flex-row w-full text-center align-middle">
                            <a href="{{ route('words.show', ['word' => $word]) }}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                        </td>
                    @elseif(Auth::user()->hasRole('user'))
                        @if(Auth::user()->id == $word->user->id)
                            <td class="flex flex-row text-l w-full text-center align-middle">
                                <a href="{{ route('words.show', ['word' => $word]) }}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                                <a href="{{ route('words.edit', ['word' => $word]) }}" class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                                <a href="{{ route('words.delete', ['word' => $word]) }}" class="fa fa-trash-alt hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            </td>
                        @else
                            <td class="flex flex-row text-l w-full text-center align-middle">
                                <a href="{{ route('words.show', ['word' => $word]) }}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            </td>
                        @endif
                    @elseif(Auth::user()->hasRole('staff'))
                        @if($word->user->role == 'admin')
                            <td class="flex flex-row text-l w-full text-center align-middle">
                                <a href="{{ route('words.show', ['word' => $word]) }}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            </td>
                        @else
                        <td class="flex flex-row text-l w-full text-center align-middle">
                            <a href="{{ route('words.show', ['word' => $word]) }}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{ route('words.edit', ['word' => $word]) }}" class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{ route('words.delete', ['word' => $word]) }}" class="fa fa-trash-alt hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                        </td>
                        @endif
                    @else
                        <td class="flex flex-row text-l w-full text-center align-middle">
                            <a href="{{ route('words.show', ['word' => $word]) }}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{ route('words.edit', ['word' => $word]) }}" class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{ route('words.delete', ['word' => $word]) }}" class="fa fa-trash-alt hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                        </td>
                    @endif
                </tr>
            @endforeach

        </table>
        <x-slot name="pagination">
            @if (Auth::user())
            <a href="{{route('words.add')}}" class="text-4xl text-center"><i class="fa-solid fa-plus hover:scale-150 hover:text-orange-500 active:text-orange-800 transition ease-in-out-300"></i></a>
            @endif
            {{ $words -> links() }}
        </x-slot>

    </x-slot>

</x-app-layout>
