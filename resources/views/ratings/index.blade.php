<x-app-layout>

    <x-slot name="header">
        {{__('RATINGS')}}
    </x-slot>

    <x-slot name="slot">

            <table class="table w-full text-gray-900 dark:text-gray-200 text-align:left">
                <thead>
                    <tr class="text-left text-xl">
                        <th class="py-6">NO.</th>
                        <th class="py-6">NAME</th>
                        <th class="py-6">VALUE</th>
                        <th class="py-6 w-1/6 text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($ratings as $rating)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$rating->name}}</td>
                        <td>
                            @for($count=1; $count <= $rating->value; $count++)
                                <i class="fa-solid fa-{{$rating->icon}} py-2"></i>
                            @endfor
                        </td>
                        <td class="flex flex-row text-l w-full text-center">
                            <a href="{{route('ratings.show', ['rating'=>$rating])}}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{route('ratings.edit', ['rating'=>$rating])}}" class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                            <a href="{{route('ratings.delete', ['rating'=>$rating])}}" class="fa fa-trash-alt hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300 w-full"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <x-slot name="pagination">
                <a href="{{route('ratings.add')}}" class="text-4xl text-center"><i class="fa-solid fa-plus hover:scale-150 hover:text-orange-500 active:text-orange-800 transition ease-in-out-300"></i></a>
                {{ $ratings -> links() }}
            </x-slot>

    </x-slot>

</x-app-layout>
