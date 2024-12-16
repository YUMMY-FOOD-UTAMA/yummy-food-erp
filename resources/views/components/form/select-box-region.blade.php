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

    <div class="mb-10" id="areaRow{{$id}}" style="{{ $areaID ? '' : 'display: none;' }}">
        <label class="form-label fw-semibold">Area Name</label>
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

    <div {{$attributes->merge(['class' => ''])}} id="areaRow{{$id}}" style="{{ $areaID ? '' : 'display: none;' }}">
        <label class="d-flex align-items-center fs-6 required fw-semibold mb-2">Area Name</label>
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

    <div class="row mb-6" id="areaRow{{$id}}" style="{{ $areaID ? '' : 'display: none;' }}">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Area Name</label>
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
        function loadOldData{{$id}}(display, oldRegionId, oldAreaId) {
            if (oldRegionId) {
                $('#areaRow{{$id}}').css('display', display);
                $.ajax({
                    url: `/region/area?region_id=${oldRegionId}`,
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

        $(document).ready(function () {
            let display = "{{$type=="vertical" ? 'block': ''}}";
            let oldRegionId = null;
            let oldAreaId = null;
            if ("{{$formMethod}}" == "POST") {
                oldRegionId = "{{ old('region_id', $regionID) }}";
                oldAreaId = "{{ old('area_id', $areaID) }}";
            } else if ("{{$formMethod}}" == "GET") {
                oldRegionId = "{{ request()->region_id }}";
                oldAreaId = "{{ request()->area_id }}";
            }
            loadOldData{{$id}}(display, oldRegionId, oldAreaId);

            $('#selectRegion{{$id}}').on('change', function () {
                const regionId = $(this).val();
                if (regionId) {
                    $('#areaRow{{$id}}').css('display', display);
                    $.ajax({
                        url: `/region/area?region_id=${regionId}`,
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
