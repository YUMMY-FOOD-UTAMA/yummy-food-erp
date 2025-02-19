@props([
    'label' => '',
    'tooltip' => null,
    'required' => false,
    'sizeForm' => 'md',
    'placeholder' => '',
    'defaultValueStartDate' => null,
    'defaultValueEndDate' => null,
    'id' => 'input',
    'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
    'withRange'=>false,
    'maximum_range_date' =>null,
    'minimum_range_date'=>null,
    'nameStartDate'=>'start_date',
    'nameEndDate'=>'end_date'
])

<div {{$attributes->merge(['class' => ''])}}>
    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
        <span class="{{$required ? 'required' : ''}}">{{$label}}</span>
        @if($tooltip)
            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
               title="{{$tooltip}}"></i>
        @endif
    </label>
    <input type="date" name="{{$nameStartDate}}" id="start_date{{$uuid}}" hidden=""
           value="{{old($nameStartDate,$defaultValueStartDate)}}">
    <input type="date" name="{{$nameEndDate}}" id="end_date{{$uuid}}" hidden=""
           value="{{old($nameEndDate,$defaultValueEndDate)}}">
    <input class="form-control form-control-solid form-control-{{$sizeForm}}"
           placeholder="{{$placeholder}}" id="{{$id.$uuid}}"/>
    <x-input-error :messages="$errors->get($nameStartDate)" class="mt-2"></x-input-error>
    <x-input-error :messages="$errors->get($nameEndDate)" class="mt-2"></x-input-error>
</div>
@push('script')
    <script>

        $(document).ready(function () {
            let startDate = $('#start_date{{$uuid}}').val();
            let endDate = $('#end_date{{$uuid}}').val()

            if (startDate && endDate) {
                $("#{{$id.$uuid}}").val(moment(startDate).format("MMMM D, YYYY") + " - " + moment(endDate).format("MMMM D, YYYY"));
            }

            @if($withRange)
            $("#{{$id.$uuid}}").daterangepicker({
                autoUpdateInput: false,
                startDate: startDate ? moment(startDate) : moment().format('YYYY-MM-DD'),
                endDate: endDate ? moment(endDate) : moment().format('YYYY-MM-DD'),
                locale: {
                    format: 'YYYY-MM-DD'
                },
                ranges: {
                    "Today": [moment(), moment()],
                    "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "Last 7 Days": [moment().subtract(6, "days"), moment()],
                    "Last 30 Days": [moment().subtract(29, "days"), moment()],
                    "This Month": [moment().startOf("month"), moment().endOf("month")],
                    "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            });
            @else
            $("#{{$id.$uuid}}").daterangepicker({
                autoUpdateInput: false,
                startDate: startDate ? moment(startDate) : moment().format('YYYY-MM-DD'),
                endDate: endDate ? moment(endDate) : moment().format('YYYY-MM-DD'),
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
            @endif

        });

        $('#{{$id.$uuid}}').on('apply.daterangepicker', function (ev, picker) {
            const startDate = picker.startDate;
            const endDate = picker.endDate;

            const formattedStartDate = startDate.format('YYYY-MM-DD');
            const formattedEndDate = endDate.format('YYYY-MM-DD');

            const rangeInDays = endDate.diff(startDate, 'days') + 1;
            @if($maximum_range_date)
            const maxRange = {{$maximum_range_date}};

            if (rangeInDays > maxRange) {
                toastr.error(`The date range cannot be more than ${maxRange} days.`);
                $('#{{$id.$uuid}}').val('');
                $('#start_date{{$uuid}}').val('');
                $('#end_date{{$uuid}}').val('');
                return;
            }
            @endif
            @if($minimum_range_date)
            const minRange = {{$minimum_range_date}};
            if (rangeInDays < minRange) {
                toastr.error(`The date range cannot be less than ${minRange} days.`);
                $('#{{$id.$uuid}}').val('');
                $('#start_date{{$uuid}}').val('');
                $('#end_date{{$uuid}}').val('');
                return;
            }
            @endif

            $('#{{$id.$uuid}}').val(startDate.format("MMMM D, YYYY") + ' - ' + endDate.format("MMMM D, YYYY"))
            ;
            $('#start_date{{$uuid}}').val(formattedStartDate);
            $('#end_date{{$uuid}}').val(formattedEndDate);

        });
    </script>
@endpush
