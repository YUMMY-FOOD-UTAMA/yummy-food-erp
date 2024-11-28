<x-table.general-table :data-table="$employees">
    @slot('slotTheadTh')
        <th class="min-w-125px">Num</th>
        <th class="min-w-125px">Nik</th>
        <th class="min-w-125px">Name</th>
        <th class="min-w-125px">Email</th>
        <th class="min-w-125px">Sub Department</th>
        <th class="min-w-125px">Position</th>
        <th class="min-w-125px">Level Name</th>
        <th class="text-end min-w-70px">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($employees as $employee)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$employee->nik}}</td>
                <td>{{$employee->user->name}}</td>
                <td>{{$employee->user->email}}</td>
                <td>{{$employee->subDepartment->name}}</td>
                <td>{{$employee->position}}</td>
                <td>{{$employee->levelGrade->levelName->name}}</td>
                @if($isTrash)
                    <x-table.action-button restore-route="{{route('user-management.employee.restore',$employee->id)}}"
                                           modal-view-i-d="modal_view{{$employee->id}}"/>
                @else
                    <x-table.action-button
                        modal-view-i-d="modal_view{{$employee->id}}"
                        soft-delete-route="{{route('user-management.employee.destroy',$employee->id)}}"
                        delete-preview="{{$employee->user->email}}"/>
                @endif
            </tr>
            <x-modal id="modal_view{{$employee->id}}"
                     title="Data {{$employee->user->email}}" size="1000">
                <div class="d-flex flex-column flex-lg-row align-items-start mb-10">
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <div class="card card-flush">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Avatar</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <x-form.image-input :view-only="true"
                                                    :image="$employee->user->avatar?'users/avatar/'.$employee->user->avatar:''"
                                                    name="profile_picture"/>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column me-n7 pe-7">
                                    <x-form.input class="fv-row mb-10" :default-value="$employee->user->full_name"
                                                  view-only="true"
                                                  label="Full Name" name="full_name"/>
                                    <div class="row g-9 mb-8">
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$employee->nik"
                                                      label="Nik"
                                                      name="nik"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$employee->user->name"
                                                      label="Name"
                                                      name="name"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$employee->subDepartment->name"
                                                      label="Sub Department"
                                                      name="sub_department"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$employee->position"
                                                      label="Position"
                                                      name="position"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$employee->levelGrade->name"
                                                      label="Level Grade"
                                                      name="level_grade"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$employee->levelGrade->levelName->name"
                                                      label="Level Name"
                                                      name="level_name"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$employee->join_date"
                                                      label="Join Date"
                                                      name="join_date"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$employee->date_of_exchange_status"
                                                      label="Date Of Exchange Status"
                                                      name="date_of_exchange_status"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$employee->status"
                                                      label="Status"
                                                      name="status"/>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Email"
                                                      :default-value="$employee->user->email"
                                                      name="email"/>
                                    </div>
                                    <x-form.input class="fv-row mb-10" view-only="true" label="Bio"
                                                  :default-value="$employee->user->bio"
                                                  name="bio"/>

                                    <div class="row g-9 mb-8">
                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Gender"
                                                      :default-value="$employee->user->gender"
                                                      name="gender"/>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Date Of Birth"
                                                      :default-value="$employee->user->date_of_birth"
                                                      name="date_of_birth"/>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Timezone"
                                                      :default-value="$employee->user->timezone"
                                                      name="timezone"/>


                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Province"
                                                      :default-value="$employee->user->province?->name"
                                                      name="province"/>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="District"
                                                      :default-value="$employee->user->district?->name"
                                                      name="District"/>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Sub District"
                                                      :default-value="$employee->user->subDistrict?->name"
                                                      name="sub_district"/>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Village"
                                                      :default-value="$employee->user->subDistrictVillage?->name"
                                                      name="sub_district_village"/>
                                    </div>
                                    <x-form.text-area view-only="true" class="fv-row mb-10"
                                                      label="Address"
                                                      name="address" :default-value="$employee->user->address"
                                                      placeholder="Address..."></x-form.text-area>
                                </div>
                            </div>
                        </div>
                    </div>
            </x-modal>
        @endforeach
    @endslot
</x-table.general-table>
