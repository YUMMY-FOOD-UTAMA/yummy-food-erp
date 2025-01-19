<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            @if(!$withOutHeading)
                @if($headingName)
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{$headingName}}</h1>
                @elseif($routeTrashName)

                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{$name}}
                        List</h1>
                @elseif($routeListName)
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{$name}}
                        Trash</h1>
                @endif
            @endif
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            @if($routeCreateName)
                @can($routeCreateName)
                    @if($usingCreateModal)
                        <a href="#" class="btn btn-sm fw-bold btn-primary hover-scale" data-bs-toggle="modal"
                           data-bs-target="#modal_create{{$name}}">{{$createLabelName}}</a>
                    @else
                        <a href="{{route($routeCreateName)}}"
                           class="btn btn-sm fw-bold hover-scale btn-primary">Create {{$name}}</a>
                    @endif
                @endcan
            @endif
            @if($routeTrashName)
                @can($routeTrashName)
                    <a href="{{route($routeTrashName)}}" class="btn btn-sm fw-bold hover-scale btn-secondary">View
                        Trash</a>
                @endcan
            @endif
            @if($routeListName)
                @can($routeListName)
                    <a href="{{route($routeListName)}}" class="btn btn-sm fw-bold hover-scale btn-secondary">{{$name}}
                        List</a>
                @endcan
            @endif
        </div>
    </div>
</div>

@if($routeCreateName && $usingCreateModal)
    @can($routeCreateName)
        <div class="modal fade" id="modal_create{{$name}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-{{$modalSize}}px">
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
                        <form class="form" action="{{route($routeCreateName)}}" enctype="multipart/form-data"
                              method="POST">
                            @csrf
                            <div class="mb-13 text-center">
                                <h1 class="mb-3">{{$createLabelName}} {{$name}}</h1>
                            </div>
                            {{$slotModalForm ?? ''}}

                            {{--                    <div class="d-flex flex-stack mb-8">--}}
                            {{--                        <div class="me-5">--}}
                            {{--                            <label class="fs-6 fw-semibold">Adding Users by Team Members</label>--}}
                            {{--                            <div class="fs-7 fw-semibold text-muted">If you need more info, please check budget--}}
                            {{--                                planning--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            {{--                        <label class="form-check form-switch form-check-custom form-check-solid">--}}
                            {{--                            <input class="form-check-input" type="checkbox" value="1" checked="checked"/>--}}
                            {{--                            <span class="form-check-label fw-semibold text-muted">Allowed</span>--}}
                            {{--                        </label>--}}
                            {{--                    </div>--}}
                            {{--                    <div class="mb-15 fv-row">--}}
                            {{--                        <div class="d-flex flex-stack">--}}
                            {{--                            <div class="fw-semibold me-5">--}}
                            {{--                                <label class="fs-6">Notifications</label>--}}
                            {{--                                <div class="fs-7 text-muted">Allow Notifications by Phone or Email</div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="d-flex align-items-center">--}}
                            {{--                                <label class="form-check form-check-custom form-check-solid me-10">--}}
                            {{--                                    <input class="form-check-input h-20px w-20px" type="checkbox"--}}
                            {{--                                           name="communication[]"--}}
                            {{--                                           value="email" checked="checked"/>--}}
                            {{--                                    <span class="form-check-label fw-semibold">Email</span>--}}
                            {{--                                </label>--}}
                            {{--                                <label class="form-check form-check-custom form-check-solid">--}}
                            {{--                                    <input class="form-check-input h-20px w-20px" type="checkbox"--}}
                            {{--                                           name="communication[]"--}}
                            {{--                                           value="phone"/>--}}
                            {{--                                    <span class="form-check-label fw-semibold">Phone</span>--}}
                            {{--                                </label>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            {{--                    </div>--}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary hover-scale">
                                    <span class="indicator-label">Submit</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @push('script')
            <script>
                @if($errors->any() || session('status') == 'error')
                let myModal = new bootstrap.Modal(document.getElementById('modal_create{{$name}}'), {});
                myModal.show();
                @endif
            </script>
        @endpush
    @endcan
@endif
