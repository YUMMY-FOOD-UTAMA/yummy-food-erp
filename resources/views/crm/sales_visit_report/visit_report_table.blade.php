<x-table.general-table :data-table="$scheduleVisits">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Customer Name</th>
        <th style="vertical-align: middle; text-align: left;">Customer Address</th>
        <th style="vertical-align: middle; text-align: left;">Visit Range Date</th>
        <th style="vertical-align: middle; text-align: left;">Visit Status</th>
        <th style="vertical-align: middle; text-align: left;">Expired</th>
        <th style="vertical-align: middle; text-align: left;">Location Accuration</th>
        <th style="vertical-align: middle; text-align: left;">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($scheduleVisits as $scheduleVisit)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$scheduleVisit->customer->name}}</td>
                <td>{{$scheduleVisit->customer->address}}</td>
                <td>{{$scheduleVisit->rangeDate()}}</td>
                <td style="color: {{ VisitStatus::getStatusColor($scheduleVisit->status) }};">
                    <strong>{{ $scheduleVisit->status }}</strong>
                </td>
                <td>{{$scheduleVisit->expiredAtTheDay()}}</td>
                <td>......%</td>
                <td>
                    @include('crm.partials.crm_modal_view_detail',['scheduleVisit'=>$scheduleVisit])
                </td>
            </tr>
        @endforeach
    @endslot
</x-table.general-table>
