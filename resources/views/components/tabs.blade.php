@props([
    'tabs' => [],
    'id' => null
])

<ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
    @foreach($tabs as $i =>$tab)
        <li class="nav-item">
            <a class="nav-link {{ $i == 0 ? 'active' : '' }}" data-bs-toggle="tab"
               href="#{{$tab['id']}}">{{$tab['title']}}</a>
        </li>
    @endforeach
</ul>

<div class="tab-content">
    @foreach ($tabs as $i => $tab)
        <div
            class="tab-pane fade {{ $i == 0 ? 'show active' : '' }}"
            id="{{ $tab['id'] }}"
            role="tabpanel"
        >
            @isset(${'slot' . $i})
                {{ ${'slot' . $i} }}
            @endisset
        </div>
    @endforeach
</div>
