@extends('layouts.home-master')

@section('content')
    <industry-client-form
        :industries="{{ json_encode($industry) }}"
        :client-sizes="{{ json_encode($clientSize) }}"
        :company-id="{{ $company->id }}"
    ></industry-client-form>
@endsection
