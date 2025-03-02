@props([
    'type'=>'inline',
    'required'=>false,
    'id'=>'role_select2',
    'sizeForm'=>"lg",
    'name'=>'role_id',
    'dataDropdownParent'=>null,
])

<div {{$attributes->merge(['class' => ''])}}>
    @if($type == "inline")
        <label class="col-lg-4 col-form-label {{$required ? 'required':''}} fw-semibold fs-6">Role</label>
        <div class="col-lg-8 fv-row">
            <select name="{{$name}}" aria-label="Select a Role" id="{{$id}}"
                    {!! $dataDropdownParent ? 'data-dropdown-parent="#' . $dataDropdownParent . '"' : '' !!}

                    class="form-select form-select-solid form-select-{{$sizeForm}}">
            </select>
        </div>
    @elseif($type=="row")
        <label class="d-flex align-items-center fs-6 {{$required?'required':''}} fw-semibold mb-2">Role</label>
        <select name="{{$name}}" aria-label="Select a Role" id="{{$id}}"
                {!! $dataDropdownParent ? 'data-dropdown-parent="#' . $dataDropdownParent . '"' : '' !!}
                class="form-select form-select-solid form-select-{{$sizeForm}}">
        </select>
    @endif
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#{{$id}}').select2({
                ajax: {
                    url: "{{config('app.urlapi')}}/api/v1/rbac/roles",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                            page_size: 25,
                            sort_field: "name",
                            sort_direction: "asc",
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        console.log(data.data)
                        return {
                            results: data.data.map(function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }),
                            pagination: {
                                more: (params.page * 25) < data.metadata.pagination.total
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                placeholder: 'Select A Roles',
                allowClear: true
            });
        });
    </script>
@endpush
