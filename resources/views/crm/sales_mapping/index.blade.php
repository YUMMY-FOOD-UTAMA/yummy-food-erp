@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar heading-name="Sales Mapping">
            </x-toolbar>
        @endslot
        <div class="card">
            <div class="card-body">
                <img src="{{asset('assets/images/coming-soon.png')}}">
            </div>
        </div>
    </x-general-section-content>

@endsection
