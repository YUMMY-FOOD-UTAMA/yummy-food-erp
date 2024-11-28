<div class="card-header border-0">
    <div class="card-title">
        <div class="d-flex align-items-center position-relative my-1 me-5">
            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                          transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                    <path
                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                        fill="currentColor"/>
                </svg>
            </span>
            <form action="{{ url()->current() }}">
                <input type="text" data-kt-user-table-filter="search" name="search" value="{{ request()->search }}"
                       class="form-control form-control-solid w-250px ps-14" placeholder="Search {{ $name }}"/>
            </form>
        </div>
    </div>

    <div class="card-toolbar">
        @if ($exportRoute)
            <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                    data-bs-target="#kt_customers_export_modal">
                    <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1"
                                  transform="rotate(90 12.75 4.25)" fill="currentColor"/>
                            <path
                                d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z"
                                fill="currentColor"/>
                            <path opacity="0.3"
                                  d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z"
                                  fill="currentColor"/>
                        </svg>
                    </span>
                Export
            </button>
        @endif

        @if($withFilters)
            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end">
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                            fill="currentColor"/>
                    </svg>
                </span>
                Filter
            </button>
            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                <form action="{{ url()->current() }}">
                    <div class="px-7 py-5">
                        <div class="fs-4 text-dark fw-bold">Filter Options</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5">
                        {{ $slotFilterForm ?? '' }}
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true" id="resetButton" data-kt-customer-table-filter="reset">
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true"
                                    data-kt-customer-table-filter="filter">Apply
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
        <form action="{{url()->current()}}">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative me-3">
                    <select id="page-size" name="page_size" class="form-select form-select-solid w-auto"
                            onchange="this.form.submit()">
                        @foreach($pageSizes as $pageSize)
                            <option
                                value="{{$pageSize->id}}" @selected(old('page_size',$pageSize->id) == request()->page_size)>
                                {{$pageSize->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>
@if ($exportRoute)
    <div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold">Export {{ $name }}</h2>
                    <div id="kt_customers_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form class="form" id="kt_customers_export_form" action="{{ $exportRoute }}">
                        <div class="fv-row mb-10">
                            <label class="fs-5 fw-semibold form-label mb-5">Select Export
                                Format:</label>
                            <select data-control="select2" data-placeholder="Select a format" data-hide-search="true"
                                    name="format" class="form-select form-select-solid">
                                <option value="excel">Excel</option>
                                <option value="pdf">PDF</option>
                                <option value="cvs">CVS</option>
                            </select>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-5 fw-semibold form-label mb-5">Select Date Range:</label>
                            <input class="form-control form-control-solid" placeholder="Pick a date"
                                   name="date"/>
                        </div>
                        {{ $slotFilterExport ?? '' }}
                        <div class="text-center">
                            <button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">Discard
                            </button>
                            <button type="submit" id="kt_customers_export_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@push('script')
    <script src="{{ asset('assets/js/custom/apps/customers/list/export.js') }}"></script>
    <script>
        @if($withFilters)
        document.getElementById('resetButton').addEventListener('click', function () {
            const baseUrl = window.location.origin + window.location.pathname;
            window.location.href = baseUrl;
        });
        @endif
        $('#search_keyword').on('change', function () {
            $(this).closest('form').submit();
        })
        ;
    </script>
@endpush
