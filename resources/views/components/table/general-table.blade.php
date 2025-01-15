@if(!$withOutCardBody)
    <div class="card-body pt-0">
        @endif
        <div class="table-responsive">
            @if($type == 'not-bordered')
                <table class="table align-middle table-row-dashed fs-6 gy-3">
                    @else
                        <table class="table table-rounded table-bordered gy-7 gs-7">
                            @endif
                            <thead>
                            <tr style="height: 45px;padding: 10px 0;">
                                @if(isset($nameSlotTh) && isset(${$nameSlotTh}))
                                    {{ ${$nameSlotTh} }}
                                @else
                                    {{$nameSlotTh ?? ''}}
                                @endif
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-800">
                            @if($dataTable && $dataTable->total() == 0)
                                <tr>
                                    <td class="no-data-row text-center">
                                        <div style="display: grid;place-items: center" class="my-5">
                                            <i class="bi bi-window-x mb-3" style="font-size: 48px"></i>
                                            <div class="text-center fs-3">Data Not Found</div>
                                            <a href="{{ url()->current() }}" class="btn btn-sm btn-secondary me-3 my-3">
                                                Refresh
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @if(isset($nameSlotTr) && isset(${$nameSlotTr}))
                                    {{ ${$nameSlotTr} }}
                                @else
                                    {{$nameSlotTr ?? ''}}
                                @endif
                            @endif
                            </tbody>
                        </table>
        </div>
        @if(!$withOutCardBody)
    </div>
@endif

@push('script')
    <script>
        window.onload = function () {
            const theadColumns = document.querySelectorAll('table thead tr th').length;
            const noDataRow = document.querySelector('.no-data-row');

            if (noDataRow) {
                noDataRow.setAttribute('colspan', theadColumns);
            }
        }
    </script>
@endpush
