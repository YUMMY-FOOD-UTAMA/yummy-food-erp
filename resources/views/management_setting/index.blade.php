@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Management Setting">
            </x-toolbar>
        @endslot
        <form action="{{route('management_setting.upsert')}}" method="POST">
            @csrf
            @method('PUT')
            <x-card title="Sales Visit Scheduling Configuration" id="sales_visit_scheduling_configuration">
                <div class="row g-9 mb-8">
                    <x-form.input class="col-md-6 fv-row"
                                  label="Maximum Range Visit"
                                  type="number"
                                  name="maximum_range_visit"
                                  :default-value="$settings?->maximum_range_visit?->scalar ?? ''"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Minimum Visit Per Day"
                                  name="minimum_visit_per_day"
                                  type="number"
                                  :default-value="$settings?->minimum_visit_per_day?->scalar ?? ''"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Maximum Visit Per Day"
                                  name="maximum_visit_per_day"
                                  type="number"
                                  :default-value="$settings?->maximum_visit_per_day?->scalar ?? ''"/>
                </div>
            </x-card>
            <x-card title="Sales Report Configuration" id="sales_report_configuration">
                <div class="row g-9 mb-8">
                    <x-form.input class="col-md-6 fv-row"
                                  label="Minimum Location Accuracy"
                                  type="number"
                                  name="minimum_location_accuracy"
                                  :default-value="$settings?->minimum_location_accuracy?->scalar ?? ''"/>
                </div>
            </x-card>
            <div class="d-flex gap-3">
                <a href="{{route('management_setting.index')}}" class="btn btn-danger">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Update</span>
                </button>
            </div>
        </form>
    </x-general-section-content>

@endsection
