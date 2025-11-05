@extends('layouts.master')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('breadcrumb-items')
    {{-- <li class="breadcrumb-item active">{{ __('Dashboard') }}</li> --}}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-6">
            @role(['admin', 'super-admin'])
                @include('dashboard.admin.index')
            @endrole
            @role(['parent'])
                @include('dashboard.parents.index')
            @endrole
            @role(['student'])
                @include('dashboard.students.index')
            @endrole
            @role(['teacher'])
                @include('dashboard.teachers.index')
            @endrole
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/app-academy-dashboard.js') }}"></script>
@endsection
