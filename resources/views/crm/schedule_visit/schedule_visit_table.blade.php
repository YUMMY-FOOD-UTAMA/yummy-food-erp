<x-table.general-table :data-table="$scheduleVisits">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Entry Date</th>
        <th style="vertical-align: middle; text-align: left;">Sales Name</th>
        <th style="vertical-align: middle; text-align: left;">Region Name</th>
        <th style="vertical-align: middle; text-align: left;">Area</th>
        <th style="vertical-align: middle; text-align: left;">Customer Category</th>
        <th style="vertical-align: middle; text-align: left;">Customer Name</th>
        <th style="vertical-align: middle; text-align: left;">Customer Status</th>
        <th style="vertical-align: middle; text-align: left;">Visit Range Date</th>
        <th style="vertical-align: middle; text-align: left;">Visit Status</th>
        <th style="vertical-align: middle; text-align: left;">Expired</th>
        <th style="vertical-align: middle; text-align: left;">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($scheduleVisits as $scheduleVisit)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$scheduleVisit->createdAt()}}</td>
                <td>{{ $scheduleVisit->employee->user->name }}</td>
                <td>{{$scheduleVisit->customer->area->region->name}}</td>
                <td>{{$scheduleVisit->customer->area->name}}</td>
                <td>{{$scheduleVisit->customer->customerCategory->name}}</td>
                <td>{{$scheduleVisit->customer->name}}</td>
                <td>{{$scheduleVisit->customer->status}}</td>
                <td>{{$scheduleVisit->rangeDate()}}</td>
                <td>
                    <span class="{{VisitStatus::getSpanClass($scheduleVisit->status) }}">{{ $scheduleVisit->status }}</span>
                </td>
                <td>{{$scheduleVisit->expiredAtTheDay()}}</td>
                <td>
                    @can('receivable.crm.schedule-visit.cancel')
                        <form action="{{ route('receivable.crm.schedule-visit.cancel', $scheduleVisit->id) }}"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <a href="" onclick="event.preventDefault();this.closest('form').submit();"
                               class="btn btn-danger btn-sm mx-1 edit-td-action-btn mb-2"
                               @if($scheduleVisit->status !== VisitStatus::WAITING_APPROVAL)
                                   disabled
                               style="pointer-events: none; opacity: 0.6;"
                                @endif>
                                Cancelled
                            </a>
                        </form>
                    @endcan
                    @include('crm.partials.crm_modal_view_detail',['scheduleVisit'=>$scheduleVisit])
                </td>
            </tr>
        @endforeach
    @endslot
</x-table.general-table>
