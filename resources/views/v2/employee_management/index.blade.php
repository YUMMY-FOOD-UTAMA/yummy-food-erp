@extends('layouts.app')

@section('content')
    <x-v2.section-content>
        @slot('TopBar')
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            List Data Employees</h1>
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-sm fw-bold btn-primary hover-scale"
                           data-bs-toggle="modal"
                           data-bs-target="#modal_create_employee">Create</a>
                        <a href="" class="btn btn-sm fw-bold hover-scale btn-secondary">View
                            Trash</a>
                    </div>
                </div>
            </div>
        @endslot

        @slot('BottomBar')
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-sm fw-bold btn-primary hover-scale"
                           data-bs-toggle="modal"
                           data-bs-target="#modal_create_employee">Create</a>
                        <a href="" class="btn btn-sm fw-bold hover-scale btn-secondary">View
                            Trash</a>
                    </div>
                </div>
            </div>
        @endslot

        <div class="card">
            <x-v2.table.filter-section using-apply-button="true" class="mt-5 ms-6 me-6" with-search="true"
                                       search-name="search" search-id="filter_search_id"
                                       search-placeholder="Search Employee">
                <x-v2.master-data.sub-department.select2 class="col-12 col-md-3 mb-5" type="row"
                                                         size-form="sm"
                                                         id="filter_sub_department_id"
                                                         name="sub_department_id"/>
                <x-v2.master-data.level-grade.select2 class="col-12 col-md-3 mb-5" type="row" size-form="sm"
                                                      id="filter_level_grade_id"
                                                      name="level_grade_id"/>
                <x-v2.rbac.select2-roles class="col-12 col-md-3 mb-5" type="row"
                                         id="filter_role_id" size-form="sm"
                                         name="role_id"/>
            </x-v2.table.filter-section>
            <div class="card-body pt-0">
                <x-v2.employee.datatable/>
            </div>
        </div>
    </x-v2.section-content>
    <div class="modal fade" id="modal_create_employee" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-1000px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                      transform="rotate(45 7.41422 6)" fill="currentColor"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <x-v2.employee.form-create/>
                </div>
            </div>
        </div>
    </div>
@endsection

