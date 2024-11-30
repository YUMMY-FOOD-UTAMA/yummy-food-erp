@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar heading-name="Confirm Visit" route-create-name="receivable.crm.schedule-visit.create"
                       name="Confirm Visit">
            </x-toolbar>
        @endslot
        <div class="card">
            @include('crm.partials.general_filter_crm')
            <x-table.basic-filter-and-export name="Schedule Visit"/>
            @include('crm.sales_confirm_visit.schedule_confirm_visit_table')
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $scheduleVisits->links() !!}
        </div>
    </x-general-section-content>

@endsection
