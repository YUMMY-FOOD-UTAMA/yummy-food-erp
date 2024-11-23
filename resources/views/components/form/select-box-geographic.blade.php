@if($type=='vertical')
    <div class="mb-10">
        <label class="form-label fw-semibold">Province:</label>
        <div>
            <select name="province_id" aria-label="Select a Province" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a province.."
                    class="form-select form-select-solid form-select-lg" id="selectProvince{{$id}}">
                <option value="">Select a Province..</option>
                @foreach($province as $p)
                    <option value="{{ $p->id }}"
                        @selected(old('province_id', $province_id) == $p->id)>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-10" id="districtRow{{$id}}" style="{{ $district_id ? '' : 'display: none;' }}">
        <label class="form-label fw-semibold">District</label>
        <div>
            <select name="district_id" aria-label="Select a District" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a district.."
                    class="form-select form-select-solid form-select-lg" id="selectDistrict{{$id}}">
                <option value="">Select a District..</option>
                @if($district_id)
                    @foreach($district as $d)
                        <option value="{{ $d->id }}"
                            @selected(old('district_id', $district_id) == $d->id)>
                            {{ $d->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="mb-10" id="subDistrictRow{{$id}}" style="{{ $sub_district_id ? '' : 'display: none;' }}">
        <label class="form-label fw-semibold">Sub District</label>
        <div>
            <select name="sub_district_id" aria-label="Select a Sub-District" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a sub-district.."
                    class="form-select form-select-solid form-select-lg" id="selectSubDistrict{{$id}}">
                <option value="">Select a Sub-District..</option>
                @if($sub_district_id)
                    @foreach($subDistrict as $sd)
                        <option value="{{ $sd->id }}"
                            @selected(old('sub_district_id', $sub_district_id) == $sd->id)>
                            {{ $sd->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="mb-10" id="villageRow{{$id}}" style="{{ $sub_district_village_id ? '' : 'display: none;' }}">
        <label class="form-label fw-semibold">Village</label>
        <div>
            <select name="sub_district_village_id" aria-label="Select a Village"
                    data-control="select2" data-placeholder="Select a village.." data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    class="form-select form-select-solid form-select-lg" id="selectVillage{{$id}}">
                <option value="">Select a Village..</option>
                @if($sub_district_village_id)
                    @foreach($subDistrictVillage as $v)
                        <option value="{{ $v->id }}"
                            @selected(old('sub_district_village_id', $sub_district_village_id) == $v->id)>
                            {{ $v->name }} ({{$v->zip}})
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
@elseif($type=='row')
    <div class="row g-9 mb-8">
        <div class="col-md-6 fv-row">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Province</label>
            <select name="province_id" aria-label="Select a Province" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a province.."
                    class="form-select form-select-solid form-select-lg" id="selectProvince{{$id}}">
                <option value="">Select a Province..</option>
                @foreach($province as $p)
                    <option value="{{ $p->id }}"
                        @selected(old('province_id', $province_id) == $p->id)>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 fv-row" id="districtRow{{$id}}" style="{{ $district_id ? '' : 'display: none;' }}">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">District</label>
            <select name="district_id" aria-label="Select a District" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a district.."
                    class="form-select form-select-solid form-select-lg" id="selectDistrict{{$id}}">
                <option value="">Select a District..</option>
                @if($district_id)
                    @foreach($district as $d)
                        <option value="{{ $d->id }}"
                            @selected(old('district_id', $district_id) == $d->id)>
                            {{ $d->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-6 fv-row" id="subDistrictRow{{$id}}" style="{{ $sub_district_id ? '' : 'display: none;' }}">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Sub District</label>
            <select name="sub_district_id" aria-label="Select a Sub-District" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a sub-district.."
                    class="form-select form-select-solid form-select-lg" id="selectSubDistrict{{$id}}">
                <option value="">Select a Sub-District..</option>
                @if($sub_district_id)
                    @foreach($subDistrict as $sd)
                        <option value="{{ $sd->id }}"
                            @selected(old('sub_district_id', $sub_district_id) == $sd->id)>
                            {{ $sd->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md-6 fv-row" id="villageRow{{$id}}"
             style="{{ $sub_district_village_id ? '' : 'display: none;' }}">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Village</label>
            <select name="sub_district_village_id" aria-label="Select a Village" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a village.."
                    class="form-select form-select-solid form-select-lg" id="selectVillage{{$id}}">
                <option value="">Select a Village..</option>
                @if($sub_district_village_id)
                    @foreach($subDistrictVillage as $v)
                        <option value="{{ $v->id }}"
                            @selected(old('sub_district_village_id', $sub_district_village_id) == $v->id)>
                            {{ $v->name }} ({{$v->zip}})
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
@else
    <div class="row mb-6">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Province</label>
        <div class="col-lg-8 fv-row">
            <select name="province_id" aria-label="Select a Province" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a province.."
                    class="form-select form-select-solid form-select-lg" id="selectProvince{{$id}}">
                <option value="">Select a Province..</option>
                @foreach($province as $p)
                    <option value="{{ $p->id }}"
                        @selected(old('province_id', $province_id) == $p->id)>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-6" id="districtRow{{$id}}" style="{{ $district_id ? '' : 'display: none;' }}">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">District</label>
        <div class="col-lg-8 fv-row">
            <select name="district_id" aria-label="Select a District" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a district.."
                    class="form-select form-select-solid form-select-lg" id="selectDistrict{{$id}}">
                <option value="">Select a District..</option>
                @if($district_id)
                    @foreach($district as $d)
                        <option value="{{ $d->id }}"
                            @selected(old('district_id', $district_id) == $d->id)>
                            {{ $d->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="row mb-6" id="subDistrictRow{{$id}}" style="{{ $sub_district_id ? '' : 'display: none;' }}">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Sub District</label>
        <div class="col-lg-8 fv-row">
            <select name="sub_district_id" aria-label="Select a Sub-District" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a sub-district.."
                    class="form-select form-select-solid form-select-lg" id="selectSubDistrict{{$id}}">
                <option value="">Select a Sub-District..</option>
                @if($sub_district_id)
                    @foreach($subDistrict as $sd)
                        <option value="{{ $sd->id }}"
                            @selected(old('sub_district_id', $sub_district_id) == $sd->id)>
                            {{ $sd->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="row mb-6" id="villageRow{{$id}}" style="{{ $sub_district_village_id ? '' : 'display: none;' }}">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Village</label>
        <div class="col-lg-8 fv-row">
            <select name="sub_district_village_id" aria-label="Select a Village" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a village.."
                    class="form-select form-select-solid form-select-lg" id="selectVillage{{$id}}">
                <option value="">Select a Village..</option>
                @if($sub_district_village_id)
                    @foreach($subDistrictVillage as $v)
                        <option value="{{ $v->id }}"
                            @selected(old('sub_district_village_id', $sub_district_village_id) == $v->id)>
                            {{ $v->name }} ({{$v->zip}})
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
@endif

@push('script')
    <script>
        function loadOldData{{$id}}(display, oldProvinceId, oldDistrictId, oldSubDistrictId, oldVillageId) {
            if (oldProvinceId) {
                $('#districtRow{{$id}}').css('display', display);
                $.ajax({
                    url: `/geographic/district?province_id=${oldProvinceId}`,
                    type: 'GET',
                    success: function (data) {
                        const districtSelect = $('#selectDistrict{{$id}}');
                        districtSelect.empty().append('<option value="">Select a District..</option>');
                        data.result.forEach(function (district) {
                            districtSelect.append(
                                `<option value="${district.id}" ${district.id == oldDistrictId ? 'selected' : ''}>${district.type} ${district.name}</option>`
                            );
                        });

                        // If there is an old district, load sub-districts
                        if (oldDistrictId) {
                            $('#subDistrictRow{{$id}}').css('display', display);
                            $.ajax({
                                url: `/geographic/sub-district?district_id=${oldDistrictId}`,
                                type: 'GET',
                                success: function (data) {
                                    const subDistrictSelect = $('#selectSubDistrict{{$id}}');
                                    subDistrictSelect.empty().append('<option value="">Select a Sub-District..</option>');
                                    data.result.forEach(function (subDistrict) {
                                        subDistrictSelect.append(
                                            `<option value="${subDistrict.id}" ${subDistrict.id == oldSubDistrictId ? 'selected' : ''}>${subDistrict.name}</option>`
                                        );
                                    });

                                    // If there is an old sub-district, load villages
                                    if (oldSubDistrictId) {
                                        $('#villageRow{{$id}}').css('display', display);
                                        $.ajax({
                                            url: `/geographic/sub-district-village?sub_district_id=${oldSubDistrictId}`,
                                            type: 'GET',
                                            success: function (data) {
                                                const villageSelect = $('#selectVillage{{$id}}');
                                                villageSelect.empty().append('<option value="">Select a Village..</option>');
                                                data.result.forEach(function (village) {
                                                    villageSelect.append(
                                                        `<option value="${village.id}" ${village.id == oldVillageId ? 'selected' : ''}>${village.name} (${village.zip})</option>`
                                                    );
                                                });
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    }
                });
            }
        }

        function loadDistrict{{$id}}(display) {
            $('#selectProvince{{$id}}').on('change', function () {
                const provinceId = $(this).val();
                if (provinceId) {
                    let districtRow{{$id}} = $('#districtRow{{$id}}')
                    districtRow{{$id}}.css('display', display);
                    districtRow{{$id}}.find('select').val('');
                    $.ajax({
                        url: `/geographic/district?province_id=${provinceId}`,
                        type: 'GET',
                        success: function (data) {
                            const districtSelect = $('#selectDistrict{{$id}}');
                            districtSelect.empty().append('<option value="">Select a District..</option>');
                            data.result.forEach(function (district) {
                                districtSelect.append(`<option value="${district.id}">${district.type} ${district.name}</option>`);
                            });

                            let subDistrictRow{{$id}}AndVillageRow = $('#subDistrictRow{{$id}}, #villageRow{{$id}}')
                            subDistrictRow{{$id}}AndVillageRow.css('display', 'none');
                            subDistrictRow{{$id}}AndVillageRow.find('select').val('');
                        }
                    });
                } else {
                    let districtAndSubDistrictRowAndVillageRow = $('#districtRow{{$id}}, #subDistrictRow{{$id}}, #villageRow{{$id}}')
                    districtAndSubDistrictRowAndVillageRow.css('display', 'none');
                    districtAndSubDistrictRowAndVillageRow.find('select').val('');
                }
            });
        }

        function loadSubDistrict{{$id}}(display) {
            $('#selectDistrict{{$id}}').on('change', function () {
                const districtId = $(this).val();
                if (districtId) {
                    let subDistrictRow{{$id}} = $('#subDistrictRow{{$id}}')
                    subDistrictRow{{$id}}.css('display', display);
                    $.ajax({
                        url: `/geographic/sub-district?district_id=${districtId}`,
                        type: 'GET',
                        success: function (data) {
                            const subDistrictSelect = $('#selectSubDistrict{{$id}}');
                            subDistrictSelect.empty().append('<option value="">Select a Sub-District..</option>');
                            data.result.forEach(function (subDistrict) {
                                subDistrictSelect.append(`<option value="${subDistrict.id}">${subDistrict.name}</option>`);
                            });

                            let villageRow{{$id}} = $('#villageRow{{$id}}')
                            villageRow{{$id}}.css('display', 'none');
                            villageRow{{$id}}.find('select').val('');
                        }
                    });
                } else {
                    let subDistrictRow{{$id}}AndVillageRow = $('#subDistrictRow{{$id}}, #villageRow{{$id}}')
                    subDistrictRow{{$id}}AndVillageRow.css('display', 'none');
                    subDistrictRow{{$id}}AndVillageRow.find('select').val('');
                }
            });
        }

        function loadSubDistrictVillage{{$id}}(display) {
            $('#selectSubDistrict{{$id}}').on('change', function () {
                const subDistrictId = $(this).val();
                if (subDistrictId) {
                    let villageRow{{$id}} = $('#villageRow{{$id}}')
                    villageRow{{$id}}.css('display', display);
                    villageRow{{$id}}.find('select').val('');
                    $.ajax({
                        url: `/geographic/sub-district-village?sub_district_id=${subDistrictId}`,
                        type: 'GET',
                        success: function (data) {
                            const villageSelect = $('#selectVillage{{$id}}');
                            villageSelect.empty().append('<option value="">Select a Village..</option>');
                            data.result.forEach(function (village) {
                                villageSelect.append(`<option value="${village.id}">${village.name} (${village.zip})</option>`);
                            });
                        }
                    });
                } else {
                    let villageRow{{$id}} = $('#villageRow{{$id}}')
                    villageRow{{$id}}.css('display', 'none');
                    villageRow{{$id}}.find('select').val('');
                }
            });
        }

        $(document).ready(function () {
            let display = "{{$type=="vertical" ? 'block': ''}}"
            let oldProvinceId = null;
            let oldDistrictId = null;
            let oldSubDistrictId = null;
            let oldVillageId = null;
            if ("{{$formMethod}}" == "POST") {
                oldProvinceId = "{{ old('province_id', $province_id)}}"
                oldDistrictId = "{{old('district_id', $district_id)}}"
                oldSubDistrictId = "{{old('sub_district_id', $sub_district_id)}}"
                oldVillageId = "{{old('sub_district_village_id', $sub_district_village_id)}}"
            } else if ("{{$formMethod}}" == "GET") {
                oldProvinceId = "{{ request()->province_id}}"
                oldDistrictId = "{{request()->district_id}}"
                oldSubDistrictId = "{{request()->sub_district_id}}"
                oldVillageId = "{{request()->sub_district_village_id}}"
            }
            loadOldData{{$id}}(display, oldProvinceId, oldDistrictId, oldSubDistrictId, oldVillageId)
            loadDistrict{{$id}}(display);
            loadSubDistrict{{$id}}(display);
            loadSubDistrictVillage{{$id}}(display);
        })

    </script>
@endpush
