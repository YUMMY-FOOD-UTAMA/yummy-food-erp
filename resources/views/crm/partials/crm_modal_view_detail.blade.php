<a data-bs-toggle="modal"
   data-bs-target="#modal_view{{$scheduleVisit->id}}"
   class="btn btn-info btn-sm mx-1 edit-td-action-btn">
    View
</a>
<x-modal id="modal_view{{$scheduleVisit->id}}"
         title="Data Schedule Visit" size="1000">
    <x-card title="Schedule Visit Data" id="schedule_visit_data">
        <div class="row g-9 mb-8">
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$scheduleVisit->created_at"
                          label="Entry Date"
                          name="entry_date"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$scheduleVisit->rangeDate()"
                          label="Visit Range Date"
                          name="visit_range_date"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$scheduleVisit->status"
                          label="Visit Status"
                          name="visit_status"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$scheduleVisit->expiredAtTheDay()"
                          label="Expired"
                          name="expired"/>
            @if($scheduleVisit->status === VisitStatus::VISITED)
                <x-form.input class="col-md-6 fv-row" view-only="true"
                              :default-value="$scheduleVisit->customer_request_product_new"
                              label="Request Product New"
                              name="customer_request_product_new"/>
            @endif
        </div>
        @if($scheduleVisit->status === VisitStatus::VISITED)
            <x-form.input class="fv-row mb-10" view-only="true"
                          :default-value="$scheduleVisit->visit_location"
                          label="Visit Location"
                          name="visit_location"/>
            <x-form.text-area class="fv-row mb-10" view-only="true"
                              :default-value="$scheduleVisit->customer_feedback"
                              label="Customer Feedback"
                              name="feedback"/>
        @endif
    </x-card>
    <x-card title="Customer Data" id="customer_data_card">
        @include('customer.partials.customer_tabs_detail',['customer'=>$scheduleVisit->customer])
    </x-card>
    <x-card title="Employee Data" id="employee_data_card">
        @include('user_management.partials.employee_detail_modal',['employee' => $scheduleVisit->employee])
    </x-card>
</x-modal>
