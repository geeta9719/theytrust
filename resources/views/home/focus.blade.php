@extends('layouts.home-master')
@section('content')
    <div id="app" class="focus-sec">
        <focus-main-component :categories="{{ $categories }}" :company-id="{{ $company }}"></focus-main-component>
    </div>
    <script src="{{ mix('public/js/app.js') }}"></script>
@endsection
