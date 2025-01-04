<td class="text-end">
    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" style="height: 24px; display: inline-flex; align-items: center;"
       data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
        <span class="svg-icon svg-icon-5 m-0">
            <svg width="24"
                 height="24"
                 viewBox="0 0 24 24"
                 fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                    fill="currentColor"/>
            </svg>
        </span>
    </a>
    <div
        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
        data-kt-menu="true">
        @if($viewRoute)
            <div class="menu-item px-3">
                <a href="{{$viewRoute}}"
                   class="menu-link px-3">View</a>
            </div>
        @endif
        @if($editRouteName)
            @can($editRouteName)
                <div class="menu-item px-3">
                    <a href="{{$editRoute}}"
                       class="menu-link px-3">Edit</a>
                </div>
            @endcan
        @endif
        @if($modalViewID)
            <div class="menu-item px-3">
                <a class="menu-link px-3" data-bs-toggle="modal"
                   data-bs-target="#{{$modalViewID}}">View</a>
            </div>
        @endif
        @if($restoreRoute)
            @can($restoreRouteName)
                <form action="{{ $restoreRoute }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="menu-item px-3">
                        <a class="menu-link px-3" href="javascript:void(0);"
                           onclick="event.preventDefault();this.closest('form').submit();"
                           data-kt-customer-table-filter="delete_row">Restore</a>
                    </div>
                </form>
            @endcan
        @endif
        @if($softDeleteRoute && $deletePreview)
            @can($softDeleteRouteName)
                <form action="{{ $softDeleteRoute }}" method="POST" id="soft-delete-form-{{ $id }}">
                    @csrf
                    @method('DELETE')
                    <div class="menu-item px-3">
                        <a class="menu-link px-3" href="javascript:void(0);"
                           onclick="confirmSoftDelete{{$id}}(event, '{{ $deletePreview }}','{{$id}}')"
                           data-kt-customer-table-filter="delete_row">Soft Delete</a>
                    </div>
                </form>
            @endcan
        @endif
        @if($hardDeleteRoute && $deletePreview)
            @can($hardDeleteRouteName)
                <form action="{{ $hardDeleteRoute }}" method="POST" id="hard-delete-form-{{ $id }}">
                    @csrf
                    @method('DELETE')
                    <div class="menu-item px-3">
                        <a class="menu-link px-3" href="javascript:void(0);"
                           onclick="confirmHardDelete{{$id}}(event, '{{ $deletePreview }}','{{$id}}')"
                           data-kt-customer-table-filter="delete_row">Delete</a>
                    </div>
                </form>
            @endcan
        @endif
        {{$slotMenutItem ?? ''}}
    </div>
</td>

@push('script')
    <script>
        function confirmSoftDelete{{$id}}(event, deletePreview, formID) {
            event.preventDefault();
            Swal.fire({
                title: `are you sure you deleted the data ${deletePreview}!?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('soft-delete-form-' + formID).submit();
                }
            });
        }

        function confirmHardDelete{{$id}}(event, deletePreview, formID) {
            event.preventDefault();
            Swal.fire({
                title: `Are you sure you want to permanently delete the data "${deletePreview}"?`,
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('hard-delete-form-' + formID).submit();
                }
            });
        }

    </script>
@endpush
