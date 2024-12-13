@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Role Management" route-create-name="user-management.role-management.create">
            </x-toolbar>
        @endslot
        <div class="card">
            <x-table.basic-filter-and-export name="Role Management"/>
            <x-table.general-table :data-table="$roles">
                @slot('slotTheadTh')
                    <tr>
                        <th>Name</th>
                        <th style="text-align: right">Action</th>
                    </tr>
                @endslot
                @slot('slotTbodyTr')
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <x-table.action-button
                                edit-route-name="user-management.role-management.update"
                                :edit-route="route('user-management.role-management.show',$role->id)"
                                view-route="{{route('user-management.role-management.show',$role->id)}}"
                                hard-delete-route-name="user-management.role-management.destroy"
                                hard-delete-route="{{route('user-management.role-management.destroy',$role->id)}}"
                                :delete-preview="$role->name"/>
                        </tr>
                    @endforeach
                @endslot
            </x-table.general-table>
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $roles->links() !!}
        </div>
    </x-general-section-content>

@endsection
