@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar heading-name="Visit Report"/>
        @endslot
        <x-card class="mb-5" title="Statistic Visit Report" :hide="true" id="card_statistic_visit_report">
            @include('crm.sales_visit_report.statistic')
        </x-card>
        <div class="card">
            <x-table.advance-filter using-apply-button="true" class="mt-5 ms-6 me-6">
                <x-form.select-box-employee class="col-12 col-md-3 mb-5" type="row" :only-sales="true"
                                            size-form="sm"
                                            :employee-i-d="request()->employee_id"></x-form.select-box-employee>
                <x-form.select-box-customer class="col-12 col-md-3 mb-5" type="row" :only-sales="true"
                                            size-form="sm"
                                            :customer-i-d="request()->customer_id"></x-form.select-box-customer>
                <x-form.select-box name="customer_status" label="Customer Status" form-method="GET"
                                   class="col-12 col-md-3 mb-5" type="row" placeholder="Select Customer Status..."
                                   size-form="sm" :items="CustomerStatus::valuesObject()"
                                   :default-value="request()->customer_status"/>
                <x-form.input-daterange label="Visit Range Date" size-form="sm" placeholder="Input Visit Range Date..."
                                        class="col-12 col-md-3 mb-5" :maximum_range_date="90" :minimum_range_date="3"
                                        :default-value-start-date="request()->start_date"
                                        :default-value-end-date="request()->end_date"
                                        :with-range="true"></x-form.input-daterange>
            </x-table.advance-filter>

            <x-table.basic-filter-and-export name="Visit Report"/>
            @include('crm.sales_visit_report.visit_report_table')
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $scheduleVisits->links() !!}
        </div>
    </x-general-section-content>

@endsection
