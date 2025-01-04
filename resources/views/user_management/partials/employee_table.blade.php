<x-table.general-table :data-table="$employees">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Name</th>
        <th style="vertical-align: middle; text-align: left;">Nik</th>
        <th style="vertical-align: middle; text-align: left;">Email</th>
        <th style="vertical-align: middle; text-align: left;">Sub Department</th>
        <th style="vertical-align: middle; text-align: left;">Position</th>
        <th style="vertical-align: middle; text-align: left;">Level Name</th>
        <th style="vertical-align: middle; text-align: left;">Role</th>
        <th class="text-end min-w-70px">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($employees as $employee)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$employee->user->name}}</td>
                <td>{{$employee->nik}}</td>
                <td>{{$employee->user->email}}</td>
                <td>{{$employee->subDepartment->name}}</td>
                <td>{{$employee->position}}</td>
                <td>{{$employee->levelGrade->levelName->name}}</td>
                <td>{{$employee->user->roleName()}}</td>
                @if($isTrash)
                    <x-table.action-button restore-route-name="user-management.employee.restore"
                                           restore-route="{{route('user-management.employee.restore',$employee->id)}}"
                                           modal-view-i-d="modal_view{{$employee->id}}"/>
                @else
                    <x-table.action-button
                            modal-view-i-d="modal_view{{$employee->id}}"
                            soft-delete-route-name="user-management.employee.destroy"
                            soft-delete-route="{{route('user-management.employee.destroy',$employee->id)}}"
                            delete-preview="{{$employee->user->email}}"/>
                @endif
            </tr>
            <x-modal id="modal_view{{$employee->id}}"
                     title="Data {{$employee->user->email}}" size="1000">
                @include('user_management.partials.employee_detail_modal',['employee' => $employee])
            </x-modal>
        @endforeach
    @endslot
</x-table.general-table>
