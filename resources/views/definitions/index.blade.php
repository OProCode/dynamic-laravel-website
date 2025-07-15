<x-app-layout>

    <x-slot name="header">
        {{__('DEFINITIONS')}}
    </x-slot>

    <x-slot name="slot">

        <table class="table w-full text-gray-900 dark:text-gray-200 text-align:left">
            <thead>
            <tr class="text-left text-xl">
                <th class="py-6">NO.</th>
                <th class="py-6">DEFINITION</th>
                @if(Auth::user())
                    <th class="py-6">YOUR RATING</th>
                @endif
                <th class="py-6">AVERAGE RATING</th>
                <th class="py-6 text-center">ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($definitions as $definition)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$definition->definition}}</td>
                    @if(Auth::user())
                        <td>
                            @for($value = 1; $value <=10; $value++)
                                @if($value <= $definition->userRating())
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                @else
                                    <i class="fa-solid fa-star text-grey-200"></i>
                                @endif
                            @endfor
                        </td>
                    @endif
                    <td>
                        @for($value = 1; $value <=10; $value++)
                            @if($value <= $definition->averageRating())
                               <i class="fa-solid fa-star text-yellow-400"></i>

                            @else
                                <i class="fa-solid fa-star text-grey-200"></i>
                            @endif
                        @endfor
                    </td>
                    <td class="flex flex-row text-l w-full text-center">
                    @if(!Auth::user())
                            <a href="{{route('definitions.show', ['definition'=>$definition])}}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                    @elseif(Auth::user()->hasRole('admin'))
                        <a href="{{route('definitions.show', ['definition'=>$definition])}}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                        <a href="{{route('definitions.edit', ['definition'=>$definition])}}" class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                        <a href="{{route('definitions.delete', ['definition'=>$definition])}}" class="fa fa-trash-alt hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                    @elseif(Auth::user()->hasRole('staff'))
                        @if($definition->user->hasRole('admin'))
                            <a href="{{route('definitions.show', ['definition'=>$definition])}}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{route('definitions.edit', ['definition'=>$definition])}}" class="fa-regular fa-star hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            @else
                            <a href="{{route('definitions.show', ['definition'=>$definition])}}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{route('definitions.edit', ['definition'=>$definition])}}" class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{route('definitions.delete', ['definition'=>$definition])}}" class="fa fa-trash-alt hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                       @endif
                    @elseif(Auth::user()->hasRole('user'))
                        @if(Auth::user()->id == $definition->user->id)
                            <a href="{{route('definitions.show', ['definition'=>$definition])}}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{route('definitions.edit', ['definition'=>$definition])}}" class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{route('definitions.delete', ['definition'=>$definition])}}" class="fa fa-trash-alt hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                        @else
                            <a href="{{route('definitions.show', ['definition'=>$definition])}}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{route('definitions.edit', ['definition'=>$definition])}}" class="fa-regular fa-star hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            @endif
                    @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <x-slot name="pagination">
            @if(Auth::user())
            <a href="{{route('definitions.add')}}" class="text-4xl text-center"><i class="fa-solid fa-plus hover:scale-150 hover:text-orange-500 active:text-orange-800 transition ease-in-out-300"></i></a>
            @endif
            {{ $definitions -> links() }}
        </x-slot>
    </x-slot>

</x-app-layout>
