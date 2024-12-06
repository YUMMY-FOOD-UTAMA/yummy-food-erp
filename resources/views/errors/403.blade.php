@extends('layouts.app')

@section('content')
    <x-general-section-content>
        <div class="card mt-5">
            <div class="card-body">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-12 text-center">
                        <img src="{{ asset('assets/images/error/403.png') }}" alt="403 Forbidden" class="img-fluid mb-4" style="max-width: 250px;">
                        <h1 class="display-4">403 - Forbidden</h1>
                        <p class="lead">You do not have permission to access this page.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-general-section-content>
@endsection
