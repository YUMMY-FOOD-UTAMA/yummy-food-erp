@extends('layouts.app')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Hello {{Auth::user()->full_name}}</h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <div class="col-xxl-6">
                        @include('dashboard.partials.chart_transaction')
                    </div>
                    <div class="col-xxl-6">
                        @include('dashboard.partials.chart_schedule_visit')
                    </div>
                </div>
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <div class="col-xxl-6">
                        <div class="card card-flush overflow-hidden h-lg-100">
                            <div class="card-header border-0">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-dark">Sales Confirmation Visit</span>
                                </h3>
                                <div class="card-toolbar">
                                    <a href="{{route('receivable.crm.sales-confirm-visit.index')}}" class="ms-4 btn btn-primary btn-active-light-primary me-2">
                                        Detail
                                    </a>
                                </div>
                            </div>
                            @include('crm.sales_confirm_visit.schedule_confirm_visit_table',['isDashboard' => true])
                            <div class="d-flex p-5 justify-content-end">
                                {!! $scheduleVisits->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}">
@endpush
@push('script')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.data-table').DataTable({
                paging: true,
                pageLength: 10,
                lengthChange: false,
                info: false,
                searching: false,
                ordering: false,
                language: {
                    paginate: {
                        previous: '<i class="fa fa-chevron-left"></i>',
                        next: '<i class="fa fa-chevron-right"></i>'
                    }
                }
            });
        });

    </script>
@endpush
