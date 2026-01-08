@extends('layouts.home-master')
@section('content')
    <focus-main-component class="focus-sec" :categories="{{ $categories }}" :company-id="{{ $company }}"></focus-main-component>
@endsection
