<x-table.general-table :data-table="$customers">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Region Name</th>
        <th style="vertical-align: middle; text-align: left;">Region Covered</th>
        <th style="vertical-align: middle; text-align: left;">Sub Region Name</th>
        <th style="vertical-align: middle; text-align: left;">Area Name</th>
        <th style="vertical-align: middle; text-align: left;">Customer Segment</th>
        <th style="vertical-align: middle; text-align: left;">Customer Category</th>
        <th style="vertical-align: middle; text-align: left;">Customer Code</th>
        <th style="vertical-align: middle; text-align: left;">Customer Name</th>
        <th style="vertical-align: middle; text-align: left;">Contact Person</th>
        <th class="text-end min-w-70px">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($customers as $customer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $customer->area?->subRegion?->region?->name }}</td>
                <td>{{ $customer->area?->subRegion?->region?->covered }}</td>
                <td>{{ $customer->area->subRegion->name }}</td>
                <td>{{ $customer->area->name }}</td>
                <td>{{ $customer->customerSegment->name }}</td>
                <td>{{ $customer->customerCategory->name }}</td>
                <td>{{ $customer->code }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->contact_person_phone }}</td>
                @if($isTrash)
                    <x-table.action-button restore-route="{{route('receivable.customer.restore',$customer->id)}}"
                                           modal-view-i-d="modal_view{{$customer->id}}"/>
                @else
                    <x-table.action-button
                        modal-view-i-d="modal_view{{$customer->id}}"
                        soft-delete-route="{{route('receivable.customer.destroy',$customer->id)}}"
                        delete-preview="{{$customer->name ?$customer->name :'Customer'}}"/>
                @endif
            </tr>
            {{--            <x-modal id="modal_view{{$customer->id}}"--}}
            {{--                     title="Data {{$customer->user->email}}" size="1000">--}}
            {{--                <div class="d-flex flex-column flex-lg-row align-items-start mb-10">--}}
            {{--                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">--}}
            {{--                        <div class="card card-flush">--}}
            {{--                            <div class="card-header">--}}
            {{--                                <div class="card-title">--}}
            {{--                                    <h2>Avatar</h2>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="card-body text-center pt-0">--}}
            {{--                                <x-form.image-input :view-only="true"--}}
            {{--                                                    :image="$customer->user->avatar?'users/avatar/'.$customer->user->avatar:''"--}}
            {{--                                                    name="profile_picture"/>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100">--}}
            {{--                        <div class="card">--}}
            {{--                            <div class="card-body">--}}
            {{--                                <div class="d-flex flex-column me-n7 pe-7">--}}
            {{--                                    <x-form.input class="fv-row mb-10" :default-value="$employee->user->full_name"--}}
            {{--                                                  view-only="true"--}}
            {{--                                                  label="Full Name" name="full_name"/>--}}
            {{--                                    <div class="row g-9 mb-8">--}}
            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true"--}}
            {{--                                                      :default-value="$employee->nik"--}}
            {{--                                                      label="Nik"--}}
            {{--                                                      name="nik"/>--}}
            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true"--}}
            {{--                                                      :default-value="$employee->user->name"--}}
            {{--                                                      label="Name"--}}
            {{--                                                      name="name"/>--}}
            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true"--}}
            {{--                                                      :default-value="$employee->subDepartment->name"--}}
            {{--                                                      label="Sub Department"--}}
            {{--                                                      name="sub_department"/>--}}
            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true"--}}
            {{--                                                      :default-value="$employee->position"--}}
            {{--                                                      label="Position"--}}
            {{--                                                      name="position"/>--}}
            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true"--}}
            {{--                                                      :default-value="$employee->levelGrade->name"--}}
            {{--                                                      label="Level Grade"--}}
            {{--                                                      name="level_grade"/>--}}
            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true"--}}
            {{--                                                      :default-value="$employee->levelGrade->levelName->name"--}}
            {{--                                                      label="Level Name"--}}
            {{--                                                      name="level_name"/>--}}
            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true"--}}
            {{--                                                      :default-value="$employee->join_date"--}}
            {{--                                                      label="Join Date"--}}
            {{--                                                      name="join_date"/>--}}
            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true"--}}
            {{--                                                      :default-value="$employee->date_of_exchange_status"--}}
            {{--                                                      label="Date Of Exchange Status"--}}
            {{--                                                      name="date_of_exchange_status"/>--}}
            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true"--}}
            {{--                                                      :default-value="$employee->status"--}}
            {{--                                                      label="Status"--}}
            {{--                                                      name="status"/>--}}

            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Email"--}}
            {{--                                                      :default-value="$employee->user->email"--}}
            {{--                                                      name="email"/>--}}
            {{--                                    </div>--}}
            {{--                                    <x-form.input class="fv-row mb-10" view-only="true" label="Bio"--}}
            {{--                                                  :default-value="$employee->user->bio"--}}
            {{--                                                  name="bio"/>--}}

            {{--                                    <div class="row g-9 mb-8">--}}
            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Gender"--}}
            {{--                                                      :default-value="$employee->user->gender"--}}
            {{--                                                      name="gender"/>--}}

            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Date Of Birth"--}}
            {{--                                                      :default-value="$employee->user->date_of_birth"--}}
            {{--                                                      name="date_of_birth"/>--}}

            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Timezone"--}}
            {{--                                                      :default-value="$employee->user->timezone"--}}
            {{--                                                      name="timezone"/>--}}


            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Province"--}}
            {{--                                                      :default-value="$employee->user->province?->name"--}}
            {{--                                                      name="province"/>--}}

            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="District"--}}
            {{--                                                      :default-value="$employee->user->district?->name"--}}
            {{--                                                      name="District"/>--}}

            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Sub District"--}}
            {{--                                                      :default-value="$employee->user->subDistrict?->name"--}}
            {{--                                                      name="sub_district"/>--}}

            {{--                                        <x-form.input class="col-md-6 fv-row" view-only="true" label="Village"--}}
            {{--                                                      :default-value="$employee->user->subDistrictVillage?->name"--}}
            {{--                                                      name="sub_district_village"/>--}}
            {{--                                    </div>--}}
            {{--                                    <x-form.text-area view-only="true" class="fv-row mb-10"--}}
            {{--                                                      label="Address"--}}
            {{--                                                      name="address" :default-value="$employee->user->address"--}}
            {{--                                                      placeholder="Address..."></x-form.text-area>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--            </x-modal>--}}
        @endforeach
    @endslot
</x-table.general-table>
