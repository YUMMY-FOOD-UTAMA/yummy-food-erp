<div class="ms-8 mb-5 mt-1">
    <button class="btn btn-success btn-sm mx-1" onclick="processSelected('{{VisitStatus::APPROVED}}')">Approve</button>
    <button class="btn btn-danger btn-sm mx-1" onclick="processSelected('{{VisitStatus::REJECTED}}')">Reject</button>
</div>
<x-table.general-table :data-table="$scheduleVisits">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">
            <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
        </th>
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Company</th>
        <th style="vertical-align: middle; text-align: left;">Visit Category</th>
        <th style="vertical-align: middle; text-align: left;">Customer Status</th>
        <th style="vertical-align: middle; text-align: left;">Visit Range Date</th>
        <th style="vertical-align: middle; text-align: left;">Visit Status</th>
        <th style="vertical-align: middle; text-align: left;">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($scheduleVisits as $scheduleVisit)
            <tr>
                <td>
                    <input type="checkbox" {{$scheduleVisit->status != VisitStatus::WAITING_APPROVAL ? 'disabled' : ''}} class="select-item" value="{{ $scheduleVisit->id }}">
                </td>
                <td>{{ $loop->iteration }}</td>
                <td>{{$scheduleVisit->customer->company_name}}</td>
                <td>{{$scheduleVisit->category}}</td>
                <td>{{$scheduleVisit->customer->status}}</td>
                <td>{{$scheduleVisit->rangeDate()}}</td>
                <td style="color: {{ VisitStatus::getStatusColor($scheduleVisit->status) }};">
                    <strong>{{ $scheduleVisit->status }}</strong>
                </td>
                <td>
                    <div class="d-flex">
                        <form action="{{ route('receivable.crm.sales-approval.approval') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="schedule_visit_ids" value="{{ $scheduleVisit->id }}">
                            <input type="hidden" name="decision" value="">

                            <a href=""
                               onclick="event.preventDefault(); submitForm(this, '{{VisitStatus::APPROVED}}');"
                               class="btn btn-success btn-sm mx-1 edit-td-action-btn"
                               @if($scheduleVisit->status !== VisitStatus::WAITING_APPROVAL)
                                   disabled
                               style="pointer-events: none; opacity: 0.6;"
                                @endif>
                                Approve
                            </a>

                            <a href=""
                               onclick="event.preventDefault(); submitForm(this, '{{VisitStatus::REJECTED}}');"
                               class="btn btn-danger btn-sm mx-1 edit-td-action-btn"
                               @if($scheduleVisit->status !== VisitStatus::WAITING_APPROVAL)
                                   disabled
                               style="pointer-events: none; opacity: 0.6;"
                                @endif>
                                Reject
                            </a>
                        </form>
                        @include('crm.partials.crm_modal_view_detail',['scheduleVisit'=>$scheduleVisit])
                    </div>
                </td>
            </tr>
        @endforeach
    @endslot
</x-table.general-table>
<form id="bulkActionForm" action="{{ route('receivable.crm.sales-approval.approval') }}" method="POST" style="display: none;">
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
