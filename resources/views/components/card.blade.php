@props([
    'id' => null,
    'title'=> null,
    'shadow'=>'lg',
    'withFooter'=>false,
])

<div class="card shadow-{{$shadow}} mb-5">
    <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
         data-bs-target="#{{$id}}">
        <h3 class="card-title">{{$title}}</h3>
        <div class="card-toolbar rotate-180">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-chevron-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
            </svg>
        </div>
    </div>
    <div id="{{$id}}" class="collapse show">
        <div class="card-body">
            {{$slot}}
        </div>
        @if($withFooter)
            <div class="card-footer">
                {{$footer ?? ''}}
            </div>
        @endif
    </div>
</div>
