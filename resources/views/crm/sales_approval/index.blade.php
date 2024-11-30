@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar heading-name="Sales Approval"/>
        @endslot
        <div class="card">
            @include('crm.partials.general_filter_crm')
            <x-table.basic-filter-and-export name="Schedule Visit"/>
            @include('crm.sales_approval.schedule_visit_table')
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $scheduleVisits->links() !!}
        </div>
    </x-general-section-content>

@endsection
