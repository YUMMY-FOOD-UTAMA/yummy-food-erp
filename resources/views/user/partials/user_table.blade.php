<x-table.general-table :data-table="$users">
    @slot('slotTheadTh')
        <th class="min-w-125px">Full Name</th>
        <th class="min-w-125px">Phone Number</th>
        <th class="min-w-125px">Email</th>
        <th class="min-w-125px">Time zone</th>
        <th class="min-w-125px">Gender</th>
        <th class="min-w-125px">Role</th>
        <th class="text-end min-w-70px">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->phone_number}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->timezone}}</td>
                <td>{{$user->gender}}</td>
                <td>{{$user->getRoleNames()->join(", ")}}</td>
                @if($isTrash)
                    <x-table.action-button restore-route="{{route('user.restore',$user->id)}}"
                                           modal-view-i-d="modal_view{{$user->id}}"
                                           hard-delete-route="{{route('user.force-delete',$user->id)}}"
                                           delete-preview="{{$user->full_name}}"></x-table.action-button>
                @else
                    <x-table.action-button
                        modal-view-i-d="modal_view{{$user->id}}"
                        soft-delete-route="{{route('user.destroy',$user->id)}}"
                        delete-preview="{{$user->full_name}}"></x-table.action-button>
                @endif
            </tr>
            <x-modal id="modal_view{{$user->id}}" :route-view-data="$isTrash ? null:route('user.show',$user->id)"
                     title="Data {{$user->name}}" size="1000">
                <div class="d-flex flex-column flex-lg-row align-items-start mb-10">
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <div class="card card-flush">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Avatar</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <x-form.image-input :view-only="true" :image="'users/avatar/'.$user->avatar"
                                                    name="profile_picture"/>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column me-n7 pe-7">
                                    <x-form.input class="fv-row mb-10" :default-value="$user->full_name"
                                                  view-only="true"
                                                  label="Full Name" name="full_name"/>
                                    <div class="row g-9 mb-8">
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$user->name"
                                                      label="Name"
                                                      name="name"></x-form.input>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Email"
                                                      :default-value="$user->email"
                                                      name="email"></x-form.input>
                                    </div>
                                    <x-form.input class="fv-row mb-10" view-only="true" label="Bio"
                                                  :default-value="$user->bio"
                                                  name="bio"></x-form.input>

                                    <div class="row g-9 mb-8">
                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Gender"
                                                      :default-value="$user->gender"
                                                      name="gender"></x-form.input>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Date Of Birth"
                                                      :default-value="$user->date_of_birth"
                                                      name="date_of_birth"></x-form.input>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Timezone"
                                                      :default-value="$user->timezone" name="timezone"></x-form.input>


                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Province"
                                                      :default-value="$user->province?->name"
                                                      name="province"></x-form.input>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="District"
                                                      :default-value="$user->district?->name"
                                                      name="District"></x-form.input>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Sub District"
                                                      :default-value="$user->subDistrict?->name"
                                                      name="sub_district"></x-form.input>

                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Village"
                                                      :default-value="$user->subDistrictVillage?->name"
                                                      name="sub_district_village"></x-form.input>
                                    </div>
                                    <x-form.text-area view-only="true" class="fv-row mb-10"
                                                      label="Address"
                                                      name="address" :default-value="$user->address"
                                                      placeholder="Address..."></x-form.text-area>
                                </div>
                            </div>
                        </div>
                    </div>
            </x-modal>
        @endforeach
    @endslot
</x-table.general-table>
