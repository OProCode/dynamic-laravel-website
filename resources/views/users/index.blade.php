<x-app-layout>

    <x-slot name="header">
        {{__('USERS')}}
    </x-slot>

    <x-slot name="slot">

        <table class="table w-full text-gray-900 dark:text-gray-200 text-align:left">
            <thead>
            <tr class="text-left text-xl">
                <th class="py-6">NO.</th>
                <th class="py-6">NAME</th>
                <th class="py-6">EMAIL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>

                    @if(Auth::user()->hasRole('admin'))

                        <td class="flex flex-row gap-10 text-l">
                            <a href="{{route('users.show', ['user'=>$user])}}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></a>
                            <a href="{{route('users.edit', ['user'=>$user])}}" class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></a>
                            <a href="{{route('users.delete', ['user'=>$user])}}" class="fa fa-trash-alt hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></a>
                        </td>
                    @else
                        <td class="flex flex-row gap-10 text-l">
                            <a href="{{route('users.show', ['user'=>$user])}}" class="fa fa-eye hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></a>
                            <a href="{{route('users.edit', ['user'=>$user])}}" class="fa fa-edit hover:text-orange-500 active:text-orange-800 hover:scale-150 transition ease-in-out-300"></a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

        <x-slot name="pagination">
{{--            <a href="{{route('users.add')}}" class="text-4xl text-center"><i class="fa-solid fa-plus hover:scale-150 hover:text-orange-500 active:text-orange-800 transition ease-in-out-300"></i></a>--}}
            {{ $users -> links() }}
        </x-slot>

    </x-slot>

</x-app-layout>
