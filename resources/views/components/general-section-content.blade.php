<div class="d-flex flex-column flex-column-fluid">
    {{$slotToolbar ?? ''}}

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            {{$slot ?? ''}}
        </div>
    </div>
</div>
