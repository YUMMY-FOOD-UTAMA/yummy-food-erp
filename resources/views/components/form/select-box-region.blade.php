@if($type=='vertical')
    <div class="mb-10">
        <label class="form-label fw-semibold">Region Name</label>
        <div>
            <select name="region_id" aria-label="Select a Region" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a Region.."
                    class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegion{{$id}}">
                <option value="">Select a Region..</option>
                @foreach($regions as $p)
                    <option value="{{ $p->id }}"
                        @selected(old('region_id', $regionID) == $p->id)>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-10">
        <label class="form-label fw-semibold">Region Covered</label>
        <div>
            <select name="region_covered" aria-label="Select a Region Covered" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a Region Covered.."
                    class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegionCovered{{$id}}">
                <option value="">Select a Region Covered..</option>
                @foreach($regions as $p)
                    <option value="{{ $p->id }}"
                        @selected(old('region_covered', $regionID) == $p->id)>
                        {{ $p->covered }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-10" id="subRegionRow{{$id}}" style="{{ $subRegionID ? '' : 'display: none;' }}">
        <label class="form-label fw-semibold">Sub Region Name</label>
        <div>
            <select name="sub_region_id" aria-label="Select a Sub Region" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a Sub Region.."
                    class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegionSubRegion{{$id}}">
                <option value="">Select a Sub Region..</option>
                @if($subRegionID)
                    @foreach($subRegions as $d)
                        <option value="{{ $d->id }}"
                            @selected(old('sub_region_id', $subRegionID) == $d->id)>
                            {{ $d->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="mb-10" id="areaRow{{$id}}" style="{{ $areaID ? '' : 'display: none;' }}">
        <label class="form-label fw-semibold">Sub Area Name</label>
        <div>
            <select name="area_id" aria-label="Select a Area Name" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a Area Name.."
                    class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegionArea{{$id}}">
                <option value="">Select a Area Name..</option>
                @if($areaID)
                    @foreach($areas as $sd)
                        <option value="{{ $sd->id }}"
                            @selected(old('area_id', $areaID) == $sd->id)>
                            {{ $sd->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
@elseif($type=='row')
    <div {{$attributes->merge(['class' => ''])}}>
        <label class="d-flex align-items-center fs-6 required fw-semibold mb-2">Region Name</label>
        <select name="region_id" aria-label="Select a Region" data-allow-clear="true"
                data-dropdown-parent="{{$dropDownParentID}}"
                data-control="select2" data-placeholder="Select a Region.."
                class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegion{{$id}}">
            <option value="">Select a Region..</option>
            @foreach($regions as $p)
                <option value="{{ $p->id }}"
                    @selected(old('region_id', $regionID) == $p->id)>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div {{$attributes->merge(['class' => ''])}}>
        <label class="d-flex align-items-center fs-6 required fw-semibold mb-2">Region Covered</label>
        <select name="region_covered" aria-label="Select a Region Covered" data-allow-clear="true"
                data-dropdown-parent="{{$dropDownParentID}}"
                data-control="select2" data-placeholder="Select a Region Covered.."
                class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegionCovered{{$id}}">
            <option value="">Select a Region Covered..</option>
            @foreach($regions as $p)
                <option value="{{ $p->id }}"
                    @selected(old('region_covered', $regionID) == $p->id)>
                    {{ $p->covered }}
                </option>
            @endforeach
        </select>
    </div>

    <div {{$attributes->merge(['class' => ''])}} id="subRegionRow{{$id}}"
         style="{{ $subRegionID ? '' : 'display: none;' }}">
        <label class="d-flex align-items-center fs-6 required fw-semibold mb-2">Sub Region Name</label>
        <select name="sub_region_id" aria-label="Select a Sub Region" data-allow-clear="true"
                data-dropdown-parent="{{$dropDownParentID}}"
                data-control="select2" data-placeholder="Select a Sub Region.."
                class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegionSubRegion{{$id}}">
            <option value="">Select a Sub Region..</option>
            @if($subRegionID)
                @foreach($subRegions as $d)
                    <option value="{{ $d->id }}"
                        @selected(old('sub_region_id', $subRegionID) == $d->id)>
                        {{ $d->name }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>

    <div {{$attributes->merge(['class' => ''])}} id="areaRow{{$id}}" style="{{ $areaID ? '' : 'display: none;' }}">
        <label class="d-flex align-items-center fs-6 required fw-semibold mb-2">Sub Area Name</label>
        <select name="area_id" aria-label="Select a Area Name" data-allow-clear="true"
                data-dropdown-parent="{{$dropDownParentID}}"
                data-control="select2" data-placeholder="Select a Area Name.."
                class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegionArea{{$id}}">
            <option value="">Select a Area Name..</option>
            @if($areaID)
                @foreach($areas as $sd)
                    <option value="{{ $sd->id }}"
                        @selected(old('area_id', $areaID) == $sd->id)>
                        {{ $sd->name }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
@else
    <div class="row mb-6">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Region Name</label>
        <div class="col-lg-8 fv-row">
            <select name="region_id" aria-label="Select a Region" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a Region.."
                    class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegion{{$id}}">
                <option value="">Select a Region..</option>
                @foreach($regions as $p)
                    <option value="{{ $p->id }}"
                        @selected(old('region_id', $regionID) == $p->id)>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-6">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Region Covered</label>
        <div class="col-lg-8 fv-row">
            <select name="region_covered" aria-label="Select a Region Covered" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a Region Covered.."
                    class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegionCovered{{$id}}">
                <option value="">Select a Region Covered..</option>
                @foreach($regions as $p)
                    <option value="{{ $p->id }}"
                        @selected(old('region_covered', $regionID) == $p->id)>
                        {{ $p->covered }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-6" id="subRegionRow{{$id}}"
         style="{{ $subRegionID ? '' : 'display: none;' }}">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Sub Region Name</label>
        <div class="col-lg-8 fv-row">
            <select name="sub_region_id" aria-label="Select a Sub Region" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a Sub Region.."
                    class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegionSubRegion{{$id}}">
                <option value="">Select a Sub Region..</option>
                @if($subRegionID)
                    @foreach($subRegions as $d)
                        <option value="{{ $d->id }}"
                            @selected(old('sub_region_id', $subRegionID) == $d->id)>
                            {{ $d->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="row mb-6" id="areaRow{{$id}}" style="{{ $areaID ? '' : 'display: none;' }}">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Sub Area Name</label>
        <div class="col-lg-8 fv-row">
            <select name="area_id" aria-label="Select a Area Name" data-allow-clear="true"
                    data-dropdown-parent="{{$dropDownParentID}}"
                    data-control="select2" data-placeholder="Select a Area Name.."
                    class="form-select form-select-solid form-select-{{$sizeForm}}" id="selectRegionArea{{$id}}">
                <option value="">Select a Area Name..</option>
                @if($areaID)
                    @foreach($areas as $sd)
                        <option value="{{ $sd->id }}"
                            @selected(old('area_id', $areaID) == $sd->id)>
                            {{ $sd->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
@endif

@push('script')
    <script>
        function loadOldData{{$id}}(display, oldRegionId, oldRegionCoveredId, oldSubRegionId, oldAreaId) {
            if (oldRegionId || oldRegionCoveredId) {
                $('#subRegionRow{{$id}}').css('display', display);
                $.ajax({
                    url: `/region/sub-region?region_id=${oldRegionCoveredId}`,
                    type: 'GET',
                    success: function (data) {
                        const subRegionSelect = $('#selectRegionSubRegion{{$id}}');
                        subRegionSelect.empty().append('<option value="">Select a Sub Region..</option>');
                        data.result.forEach(function (subRegion) {
                            subRegionSelect.append(
                                `<option value="${subRegion.id}" ${subRegion.id == oldSubRegionId ? 'selected' : ''}>${subRegion.name}</option>`
                            );
                        });

                        if (oldSubRegionId) {
                            $('#areaRow{{$id}}').css('display', display);
                            $.ajax({
                                url: `/region/sub-region/area?sub_region_id=${oldSubRegionId}`,
                                type: 'GET',
                                success: function (data) {
                                    const areaSelect = $('#selectRegionArea{{$id}}');
                                    areaSelect.empty().append('<option value="">Select an Area Name..</option>');
                                    data.result.forEach(function (area) {
                                        areaSelect.append(
                                            `<option value="${area.id}" ${area.id == oldAreaId ? 'selected' : ''}>${area.name}</option>`
                                        );
                                    });
                                }
                            });
                        }
                    }
                });
            }
        }
        $(document).ready(function () {
            let display = "{{$type=="vertical" ? 'block': ''}}";
            let oldRegionId = null;
            let oldRegionCoveredId = null;
            let oldSubRegionId = null;
            let oldAreaId = null;
            if ("{{$formMethod}}" == "POST") {
                oldRegionId = "{{ old('region_id', $regionID) }}";
                oldRegionCoveredId = "{{ old('region_covered', $regionID) }}";
                oldSubRegionId = "{{ old('sub_region_id', $subRegionID) }}";
                oldAreaId = "{{ old('area_id', $areaID) }}";
            } else if ("{{$formMethod}}" == "GET") {
                oldRegionId = "{{ request()->region_id }}";
                oldRegionCoveredId = "{{ request()->region_covered }}";
                oldSubRegionId = "{{ request()->sub_region_id }}";
                oldAreaId = "{{ request()->area_id }}";
            }
            loadOldData{{$id}}(display, oldRegionId, oldRegionCoveredId, oldSubRegionId, oldAreaId);

            $('#selectRegion{{$id}},#selectRegionCovered{{$id}}').on('change', function () {
                const regionId = $(this).val();
                if (regionId) {
                    $('#subRegionRow{{$id}}').css('display', display);
                    $.ajax({
                        url: `/region/sub-region?region_id=${regionId}`,
                        type: 'GET',
                        success: function (data) {
                            const subRegionSelect = $('#selectRegionSubRegion{{$id}}');
                            subRegionSelect.empty().append('<option value="">Select a Sub Region..</option>');
                            data.result.forEach(function (subRegion) {
                                subRegionSelect.append(`<option value="${subRegion.id}">${subRegion.name}</option>`);
                            });
                        }
                    });
                } else {
                    $('#subRegionRow{{$id}}, #areaRow{{$id}}').css('display', 'none').find('select').val('');
                }
            });

            $('#selectRegionSubRegion{{$id}}').on('change', function () {
                const subRegionId = $(this).val();
                if (subRegionId) {
                    $('#areaRow{{$id}}').css('display', display);
                    $.ajax({
                        url: `/region/sub-region/area?sub_region_id=${subRegionId}`,
                        type: 'GET',
                        success: function (data) {
                            const areaSelect = $('#selectRegionArea{{$id}}');
                            areaSelect.empty().append('<option value="">Select an Area Name..</option>');
                            data.result.forEach(function (area) {
                                areaSelect.append(`<option value="${area.id}">${area.name}</option>`);
                            });
                        }
                    });
                } else {
                    $('#areaRow{{$id}}').css('display', 'none').find('select').val('');
                }
            });
        });
    </script>

@endpush
