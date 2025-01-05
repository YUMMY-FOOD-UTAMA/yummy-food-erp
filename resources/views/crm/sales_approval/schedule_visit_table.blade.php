@can('receivable.crm.sales-approval.approval')
    <div class="ms-8 mb-5 mt-1">
        <button class="btn btn-success btn-sm mx-1" onclick="processSelected('{{VisitStatus::APPROVED}}')">Approve
        </button>
        <button class="btn btn-danger btn-sm mx-1" onclick="processSelected('{{VisitStatus::REJECTED}}')">Reject
        </button>
    </div>
@endcan
<x-table.general-table :data-table="$scheduleVisits">
    @slot('slotTheadTh')
        @can('receivable.crm.sales-approval.approval')
            <th style="width: 20px; vertical-align: middle; text-align: left;">
                <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
            </th>
        @endcan
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Company</th>
        <th style="vertical-align: middle; text-align: left;">Employee Name</th>
        <th style="vertical-align: middle; text-align: left;">Visit Category</th>
        <th style="vertical-align: middle; text-align: left;">Customer Status</th>
        <th style="vertical-align: middle; text-align: left;">Visit Range Date</th>
        <th style="vertical-align: middle; text-align: left;">Visit Status</th>
        <th style="vertical-align: middle; text-align: left;">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($scheduleVisits as $scheduleVisit)
            <tr>
                @can('receivable.crm.sales-approval.approval')
                    <td>
                        <input type="checkbox"
                               {{$scheduleVisit->status != VisitStatus::WAITING_APPROVAL ? 'disabled' : ''}} class="select-item"
                               value="{{ $scheduleVisit->id }}">
                    </td>
                @endcan
                <td>{{ $loop->iteration }}</td>
                <td>{{$scheduleVisit->customer->company_name}}</td>
                <td>{{$scheduleVisit->employee->user->name}}</td>
                <td>{{$scheduleVisit->category}}</td>
                <td>{{$scheduleVisit->customer->status}}</td>
                <td>{{$scheduleVisit->rangeDate()}}</td>
                <td>
                    <span
                        class="{{VisitStatus::getSpanClass($scheduleVisit->status) }}">{{ $scheduleVisit->status }}</span>
                </td>
                <td>
                    @can('receivable.crm.sales-approval.approval')
                        <form action="{{ route('receivable.crm.sales-approval.approval') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="schedule_visit_ids" value="{{ $scheduleVisit->id }}">
                            <input type="hidden" name="decision" value="">

                            @if($scheduleVisit->status === VisitStatus::WAITING_APPROVAL)
                                <a href=""
                                   onclick="event.preventDefault(); submitForm(this, '{{VisitStatus::APPROVED}}');"
                                   class="btn btn-success btn-sm mx-1 edit-td-action-btn mb-2">
                                    Approve
                                </a>
                                <a href=""
                                   onclick="event.preventDefault(); submitForm(this, '{{VisitStatus::REJECTED}}');"
                                   class="btn btn-danger btn-sm mx-1 edit-td-action-btn mb-2">
                                    Reject
                                </a>
                            @endif

                        </form>
                    @endcan
                    @include('crm.partials.crm_modal_view_detail',['scheduleVisit'=>$scheduleVisit])
                </td>
            </tr>
        @endforeach
    @endslot
</x-table.general-table>
<form id="bulkActionForm" action="{{ route('receivable.crm.sales-approval.approval') }}" method="POST"
      style="display: none;">
    @csrf
    @method('PUT')
    <input type="hidden" name="decision" id="bulkDecision">
    <input type="hidden" name="schedule_visit_ids" id="selectedIds">
</form>

@push('script')
    <script>
        function toggleSelectAll(checkbox) {
            const checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(cb => {
                if (!cb.disabled) {
                    cb.checked = checkbox.checked;
                }
            });
        }

        function processSelected(decision) {
            const selectedIds = Array.from(document.querySelectorAll('.select-item:checked'))
                .map(cb => cb.value);

            if (selectedIds.length === 0) {
                toastr.warning('No items selected.')
                return;
            }

            document.getElementById('bulkDecision').value = decision;
            document.getElementById('selectedIds').value = selectedIds.join(',');

            document.getElementById('bulkActionForm').submit();
        }

        function submitForm(button, decision) {
            const form = button.closest('form');

            const inputDecision = form.querySelector('input[name="decision"]');
            if (inputDecision) {
                inputDecision.value = decision;
            }

            form.submit();
        }
    </script>
@endpush
