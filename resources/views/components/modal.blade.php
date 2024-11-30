<div class="modal fade" id="{{$id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-{{$size}}px">
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
                <div class="mb-13 text-center">
                    <h1 class="mb-3">{{$title}}</h1>
                    @if($description)
                        <div class="text-muted fw-semibold fs-5">{{$description}}</div>
                    @endif
                </div>
                {{$slot ?? ''}}
                @if($routeViewData)
                    <div class="text-start">
                        <a class="btn btn-primary hover-scale" href="{{$routeViewData}}">Edit</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
