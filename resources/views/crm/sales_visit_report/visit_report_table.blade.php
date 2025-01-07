<x-table.general-table :data-table="$scheduleVisits">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Employee Name</th>
        <th style="vertical-align: middle; text-align: left;">Customer Name</th>
        <th style="vertical-align: middle; text-align: left;">Location Detection</th>
        <th style="vertical-align: middle; text-align: left;">Visit Date</th>
        <th style="vertical-align: middle; text-align: left;">Visit Status</th>
        <th style="vertical-align: middle; text-align: left;">Duration</th>
        <th style="vertical-align: middle; text-align: left;">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($scheduleVisits as $scheduleVisit)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$scheduleVisit->employee->user->name}}</td>
                <td>{{$scheduleVisit->customer->name}}</td>
                <td>{{$scheduleVisit->visit_location}}</td>
                <td>{{$scheduleVisit->updatedAtOnlyDate()}}</td>
                <td>
                    <span
                        class="{{VisitStatus::getSpanClass($scheduleVisit->status) }}">{{ $scheduleVisit->status }}</span>
                </td>
                <td>......%</td>
                <td>
                    @include('crm.partials.crm_modal_view_detail',['scheduleVisit'=>$scheduleVisit])
                </td>
            </tr>
        @endforeach
    @endslot
</x-table.general-table>
